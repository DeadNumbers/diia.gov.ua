<?php namespace KitSoft\Pages\Extensions;

use Config;
use Cms\Classes\Theme;

/*
 * Apply config from themes/THEME_NAME/theme.yaml for all plugins (configPlugins array)
 *
 * Example.
 *
 * configPlugins:
 *   kitsoft: (author name)
 *     pages: (plugin name)
 *       config: (config filename)
 *         routingByPages: true (params)
 *
 */
class ConfigExtension
{
    protected $theme;

    /*
     * Construct
     */
    public function __construct()
    {
        if ($this->theme = Theme::getActiveTheme()) {
            $this->setPluginsConfigFromTheme();
        }
    }

    /**
     * setPluginsConfigFromTheme
     */
    protected function setPluginsConfigFromTheme()
    {
        $config = $this->theme->getConfig();

        if (!isset($config['configPlugins'])) {
            return;
        }

        foreach ($config['configPlugins'] as $author => $plugins) {
            foreach ($plugins as $plugin => $files) {
                foreach ($files as $file => $config) {
                    foreach ($config as $name => $value) {
                        Config::set("{$author}.{$plugin}::{$file}.{$name}", $value);
                    }
                }
            }
        }
    }
}