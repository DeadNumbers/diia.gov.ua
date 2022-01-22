<?php namespace KitSoft\MultiLanguage;

use App;
use Backend;
use Exception;
use KitSoft\MultiLanguage\Models\Message;
use Lang;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /**
     * pluginDetails
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'kitsoft.multilanguage::lang.plugin.name',
            'description' => 'kitsoft.multilanguage::lang.plugin.description',
            'author'      => 'Maksym Nozhkin',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * register
     */
    public function register()
    {
        // Artisan Commands
        $this->registerConsoleCommand(
            'multilanguage.makeentities',
            'KitSoft\MultiLanguage\Console\MakeEntities'
        );

        $this->registerConsoleCommand(
            'multilanguage:importmessages',
            'KitSoft\MultiLanguage\Console\ImportMessages'
        );

        $this->registerConsoleCommand(
            'multilanguage:clearentities',
            'KitSoft\MultiLanguage\Console\ClearEntities'
        );
    }

    /**
     * boot
     */
    public function boot()
    {
        App::make('KitSoft\MultiLanguage\Extensions\ValidatorExtension');
        App::make('KitSoft\MultiLanguage\Extensions\BackendMlExtension');
        App::make('KitSoft\MultiLanguage\Extensions\BlogMlExtension');
        App::make('KitSoft\MultiLanguage\Extensions\BlogViewExtension');
        App::make('KitSoft\Multilanguage\Extensions\MailMlExtension');
        App::make('KitSoft\Multilanguage\Extensions\RelationFinderExtension');
        App::make('KitSoft\Multilanguage\Extensions\PagesInstallerExtension');
        App::make('KitSoft\Multilanguage\Extensions\TranslateFieldsExtension');
        App::make('KitSoft\Multilanguage\Extensions\MultiSiteExtension');
    }

    /**
     * registerComponents
     */
    public function registerComponents()
    {
        return [
           'KitSoft\MultiLanguage\Components\MultiLanguage' => 'multiLanguage'
        ];
    }

    /**
     * registerPermissions
     */
    public function registerPermissions()
    {
        return [
            'kitsoft.multilanguage.manage_locales'  => [
                'tab'   => 'kitsoft.multilanguage::lang.plugin.name',
                'label' => 'kitsoft.multilanguage::lang.plugin.manage_locales'
            ],
            'kitsoft.multilanguage.manage_messages'  => [
                'tab'   => 'kitsoft.multilanguage::lang.plugin.name',
                'label' => 'kitsoft.multilanguage::lang.plugin.manage_messages'
            ]
        ];
    }

    /**
     * registerSettings
     */
    public function registerSettings()
    {
        return [
            'locales' => [
                'label'       => 'kitsoft.multilanguage::lang.locales.label',
                'description' => '',
                'icon'        => 'icon-language',
                'url'         => Backend::url('kitsoft/multilanguage/locales'),
                'order'       => 550,
                'category'    => 'kitsoft.multilanguage::lang.plugin.name',
                'permissions' => ['kitsoft.multilanguage.manage_locales']
            ],
            'messages' => [
                'label'       => 'kitsoft.multilanguage::lang.messages.label',
                'description' => '',
                'icon'        => 'icon-language',
                'url'         => Backend::url('kitsoft/multilanguage/messages'),
                'order'       => 550,
                'category'    => 'kitsoft.multilanguage::lang.plugin.name',
                'permissions' => ['kitsoft.multilanguage.manage_messages']
            ]
        ];
    }

    /**
     * Register new Twig variables
     */
    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'getActiveLocale' => ['KitSoft\MultiLanguage\Twig\Functions', 'getActiveLocale'],
                'getDefaultLocale' => ['KitSoft\MultiLanguage\Twig\Functions', 'getDefaultLocale'],
                'renderCanonicalUrl' => ['KitSoft\MultiLanguage\Twig\Functions', 'renderCanonicalUrl']
            ],
            'filters' => [
                '_'  => [$this, 'translateString'],
                '__' => [$this, 'translatePlural']
            ]
        ];
    }

    /**
     * registerFormWidgets
     */
    public function registerFormWidgets()
    {
        return [
            'KitSoft\MultiLanguage\FormWidgets\MLText' => 'mltext',
            'KitSoft\MultiLanguage\FormWidgets\LanguageSwitcher' => 'languageswitcher',
        ];
    }

    /**
     * translateString
     */
    public function translateString($string, $params = [])
    {
        return Message::trans($string, $params);
    }

    /**
     * translatePlural
     */
    public function translatePlural($string, $count = 0, $params = [])
    {
        try {
            $locale = App::getLocale();
            $message = Message::trans($string, $params, null, true);
            $result = Lang::choice($message, $count, $params, $locale);
        } catch (Exception $e) {
            trace_log($e);
        }

        return $result ?? $string;
    }
}
