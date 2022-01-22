<?php namespace KitSoft\Polls\Controllers;

use ApplicationException;
use Backend;
use BackendMenu;
use Backend\Classes\Controller;
use Db;
use Flash;
use KitSoft\Polls\Import\ImportDepartments;

/**
 * Departments Back-end Controller
 */
class Departments extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController',
        '@KitSoft.MultiSite.Behaviors.MultiSiteController',
        '@KitSoft.Core.Behaviors.ImportController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $importConfig = 'config_import.yaml';

    public $csvEncoding;
    public $csvDelimiter = ',';
    public $csvEnclosure = '"';
    public $csvEscape = '\\';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Polls', 'polls', 'departments');
    }

    /**
     * onImportForm
     */
    public function onImportForm()
    {
        return $this->asExtension('ImportController')->import();
    }

    /**
     * onImport
     */
    public function onImport()
    {
        $this->csvEncoding = post('encoding');

        Db::beginTransaction();
        try {
            // remove all childs data, before import
            if (post('truncate')) {
                ImportDepartments::removeData();
            }

            $this->asExtension('ImportController')->importStream();

        } catch (Exception $e) {
            Db::rollback();
            trace_log($e);
            throw new ApplicationException($e->getMessage());
        }

        Db::commit();
        Flash::success("Успішно імпортовано.");

        return redirect(Backend::url('kitsoft/polls/departments'));
    }

    /**
     * importStreamRow
     */
    public function importStreamRow($item, $matches)
    {
        ImportDepartments::importRow($item, $matches);
    }
}
