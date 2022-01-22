<?php namespace KitSoft\Pages\Install;

use Db;
use Exception;
use KitSoft\Pages\Install\Helpers;

class Install
{
    protected $themeConfig;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->themeConfig = Helpers::getConfig();

        if (!$this->themeConfig->count()) {
            dd('Theme installer is not configurate.');
        }
    }

    /**
     * install
     */
    public function install()
    {
        Db::beginTransaction();
        try {
            $this->themeConfig->each(function ($item, $key) {
                if (isset($item['multisiteInstaller']) && $item['multisiteInstaller']) {
                    return;
                }
                $className = "\KitSoft\Pages\Install\Items\\" . ucfirst($key) . "Installer";
                if (!class_exists($className)) {
                    throw new Exception("Class [{$className}] does not exist.");
                }
                $class = new $className($item);
                $class->install();
            });
        } catch (Exception $e) {
            Db::rollback();
            trace_log($e);
            dd($e->getMessage());
        }
        Db::commit();
    }
}
