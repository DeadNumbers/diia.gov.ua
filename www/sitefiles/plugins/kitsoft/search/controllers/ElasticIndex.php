<?php namespace KitSoft\Search\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Config;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Exception;
use Flash;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use KitSoft\Core\Classes\MultiLanguageHelpers;
use KitSoft\Core\Classes\MultiSiteHelpers;
use KitSoft\Search\Classes\ElasticClient;
use KitSoft\Search\Classes\Helpers;
use KitSoft\Search\Models\Settings;
use Queue;
use Redirect;
use System\Classes\SettingsManager;

/**
 * Elastic Index Back-end Controller
 */
class ElasticIndex extends Controller
{
    protected $clientTimeout = 5;

    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('KitSoft.Search', 'elasticindex');
    }

    /**
     * index
     */
    public function index()
    {
        $this->pageTitle = class_basename($this);
        $settings = $this->vars['settings'] = Settings::instance();

        if (!Settings::get('elastic_host')) {
            die('Elastic is not configurate.');
        }

        $this->vars['providers'] = Helpers::getProviders();
        foreach ($this->vars['providers'] as $key => &$row) {
            $row['indexExist'] = false;
            $row['hideSettings'] = isset($row['index'], $row['template']);
            $row['hideReindex'] = isset($row['hideReindex']) && $row['hideReindex'];
            $row['template'] = Helpers::getElasticTemplate($key);
        }

        try {
            $client = new ElasticClient();
            
            foreach ($this->vars['providers'] as $key => &$row) {
                if (!$index = Helpers::getElasticIndex($key)) {
                    continue;
                }
                $row['index'] = $index;
                $row['indexExist'] = $client->checkIndexExist([
                    'index' => $index,
                    'client' => ['timeout' => $this->clientTimeout]
                ]);
                $row['count']['elastic'] = $row['indexExist']
                    ? $client->count([
                        'index' => $index,
                        'client' => ['timeout' => $this->clientTimeout]
                    ])
                    : null;
                
                if (isset($row['model'])) {
                    $row['count']['db'] = $row['model']::withoutGlobalScope('multisite')->withoutGlobalScope(new SoftDeletingScope())->count();
                }
            }
        } catch (Exception $e) {
            Flash::error($e->getMessage());
        }
    }

    /**
     * onUpdateForm
     */
    public function onUpdateForm()
    {
        $type = post('type');
        $settings = Settings::instance();

        $this->vars['type'] = $type;
        $this->vars['index'] = $settings->{"{$type}_index"};
        $this->vars['template'] = $settings->{"{$type}_template"};
        $this->vars['mapping'] = array_get(Helpers::getProviders(), "{$type}.mappings");

        return $this->makePartial('update_form');
    }

    /**
     * onReindex
     */
    public function onReindex()
    {
        $type = request()->post('type');
        $config = array_get(Helpers::getProviders(), $type);
        $index = Helpers::getElasticIndex($type);

        Queue::push(
            'KitSoft\Search\Jobs\ElasticRebuild@fire',
            [
                'type' => $type,
                'mappings' => $config['mappings'],
                'settings' => $config['settings'],
                'files' => $config['files'] ?? [],
                'dynamicAttributes' => $config['dynamicAttributes'] ?? [],
                'index_name' => $index,
                'lang' => MultiLanguageHelpers::lang(),
                'site' => MultiSiteHelpers::site()
            ]
        );

        Flash::success(ucfirst($type) . " додано в чергу.");
    }

    /**
     * onUpdate
     */
    public function onUpdate()
    {
        $type = request()->post('type');
        $data = request()->post('Settings');

        $settings = Settings::instance();
        $settings->{"{$type}_index"} = $data['index'] ?? null;
        $settings->{"{$type}_template"} = $data['template'] ?? null;
        $settings->save();

        Flash::success("Збережено");
    }

    /**
     * onDelete
     */
    public function onDelete()
    {
        try {
            $type = request()->post('type');
            $index = Helpers::getElasticIndex($type);

            $client = new ElasticClient();
            $client->deleteIndex(['index' => $index]);
        } catch (Ecxeption $e) {
            Flash::error($e->getMessage());
            return;
        } catch (Missing404Exception $e) {
            Flash::error("Такого індексу не існує.");
            return;
        }

        Flash::success("Індекс успішно видалений.");
    }
}
