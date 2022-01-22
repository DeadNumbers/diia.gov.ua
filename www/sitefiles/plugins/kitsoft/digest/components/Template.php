<?php namespace KitSoft\Digest\Components;

use Cms\Classes\ComponentBase;
use Config;
use Event;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use KitSoft\Core\Classes\CacheHelpers;
use KitSoft\Digest\Models\Settings;
use KitSoft\Digest\Models\Subscriber;
use KitSoft\Pages\Classes\PagesHelper;
use October\Rain\Argon\Argon;
use ValidationException;

class Template extends ComponentBase
{
    public $subscriber;
    public $content;
    public $totalItems;
    public $emptyContent;

    protected $limit;
    
    public function componentDetails()
    {
        return [
            'name'        => 'Template',
            'description' => 'Render personal content for subscriber by sync_uuid & minutes period params'
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
        Event::fire('kitsoft.digest::template.beforeOnRun');

        try {
            $uuid = request()->get('uuid');
            $this->emptyContent = Settings::get('emptyContent');

            if (!$this->subscriber = Subscriber::getByUniqueId($uuid)) {
                throw new ValidationException(['uuid' => 'Subscriber not found. uuid: ' . $uuid]);
            }
            
            $this->limit = Settings::get('limit') ?? 5;

            foreach ($this->subscriber->content_types as $content_type) {
                $items = $this->loadItemsByContentType($content_type);
                $this->content[] = [
                    'title' => Config::get("kitsoft.digest::types.{$content_type}.title"),
                    'type' => $content_type,
                    'items' => $items
                ];
                $this->totalItems += $items->count();
            }

            if (!$this->totalItems) {
                throw new ValidationException(['items' => 'Is empty']);
            }
        } catch (ValidationException $e) {
 
        } catch (Exception $e) {
            trace_log($e);
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
     * loadItemsByContentType
     */
    protected function loadItemsByContentType($content_type)
    {
        if (!$config = Config::get('kitsoft.digest::types.' . $content_type)) {
            return;
        }

        if (!isset($config['model']) || !class_exists($config['model'])) {
            return;
        }

        $query = $config['model']::make();

        $this->queryApplyScopes($query, $config);
        $this->queryApplyOrders($query, $config);
        $this->queryApplyTags($query, $this->subscriber->tags);
        $this->queryApplyPeriod($query, request()->get('period'));

        Event::fire('kitsoft.digest::template.extendQuery', [$this->subscriber, &$query]);

        return $query->limit($this->limit)
            ->get();
    }

    /**
     * queryApplyScopes
     */
    protected function queryApplyScopes(&$query, array $config): void
    {
        if (!isset($config['scopes'])) {
            return;
        }

        foreach ($config['scopes'] as $scope) {
            $query = $query->{$scope}();
        }
    }

    /**
     * queryApplyOrders
     */
    protected function queryApplyOrders(&$query, array $config): void
    {
        if (!isset($config['order'])) {
            return;
        }

        foreach ($config['order'] as $column => $desc) {
            $query = $query->orderBy($column, $desc);
        }
    }

    /**
     * queryApplyTags
     */
    protected function queryApplyTags(&$query, $tags): void
    {
        if ($tags->count()) {
            $query = $query->filterTags($tags->lists('id'));
        }
    }

    /**
     * queryApplyPeriod
     */
    protected function queryApplyPeriod(&$query, int $period = null): void
    {
        if (!$period) {
            return;
        }

        $dateAfter = Argon::now()->subMinutes((int)$period);
        $query = $query->where('published_at', '>=', $dateAfter);
    }
}
