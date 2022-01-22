<?php namespace KitSoft\Digest\Components;

use ApplicationException;
use Cms\Classes\ComponentBase;
use Db;
use Exception;
use KitSoft\Core\Classes\CacheHelpers;
use KitSoft\Digest\Models\ListSync;
use KitSoft\Digest\Models\Settings as SettingsModel;
use KitSoft\Digest\Models\Subscriber;
use KitSoft\TagsManager\Models\Tag;
use ValidationException;
use Validator;

class Settings extends ComponentBase
{
    public $subscriber;
    public $types;
    public $tags;
    public $lists;

    public function componentDetails()
    {
        return [
            'name'        => 'Settings',
            'description' => 'Subscriber settings component. Select list, content types and tags.'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        if (!$this->subscriber = Subscriber::getByUniqueId($this->param('uuid'))) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        $this->lists = $this->loadLists();
        
        if (SettingsModel::get('tags')) {
            $this->tags = $this->loadTags();
        }
        
        if (SettingsModel::get('typesEnabled')) {
            $this->types = $this->loadTypes();
        }
    }

    /**
     * onRender
     */
    public function onRender()
    {
        CacheHelpers::setNoCacheHeaders();
    }

    /**
     * loadTags
     */
    protected function loadTags()
    {
        return Tag::whereHas('entities')
            ->orderBy('name')
            ->get();
    }

    /**
     * loadTypes
     */
    protected function loadTypes()
    {
        return SettingsModel::instance()
            ->getTypesConfigAttribute();
    }

    /**
     * loadLists
     */
    protected function loadLists()
    {
        return ListSync::get();
    }

    /**
     * onDigestSettings
     */
    public function onDigestSettings()
    {
        $data = request()->all();

        $validator = Validator::make($data, [
            'list' => '',
            'tags' => 'array',
            'types' => 'array' . (SettingsModel::get('typesEnabled') ? '|required' : '')
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        if (!$subscriber = Subscriber::getByUniqueId($this->param('uuid'))) {
            throw new ValidationException(['uuid' => 'Invalid uuid']);
        }

        Db::beginTransaction();
        try {
            $subscriber->lists = $data['list'] ? [$data['list']] : null;
            $subscriber->tags = $data['tags'] ?? [];
            $subscriber->content_types = $data['types'] ?? [];
            $subscriber->confirmed = true;
            $subscriber->save();
        } catch (Exception $e) {
            Db::rollback();
            trace_log($e);
            throw new ApplicationException('Error');
        }

        Db::commit();
    }
}
