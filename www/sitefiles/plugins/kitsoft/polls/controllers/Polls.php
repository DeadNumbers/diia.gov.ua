<?php namespace KitSoft\Polls\Controllers;

use ApplicationException;
use Backend;
use BackendMenu;
use Backend\Classes\Controller;
use Db;
use Exception;
use Flash;
use Model;
use KitSoft\Polls\Classes\ImportHelpers;
use KitSoft\Polls\Classes\Statistic;
use KitSoft\Polls\Models\Poll;
use ValidationException;
use Validator;

/**
 * Polls Back-end Controller
 */
class Polls extends Controller
{
    use \Backend\Traits\WidgetMaker;
    use \System\Traits\ConfigMaker;
    use \System\Traits\ViewMaker;

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController',
        '@KitSoft.MultiSite.Behaviors.MultiSiteController',
        '@KitSoft.Core.Behaviors.ImportController'
    ];

    public $requiredPermissions = ['kitsoft.polls.polls.index'];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $importConfig = 'config_import.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $csvEncoding;
    public $csvDelimiter = ',';
    public $csvEnclosure = '"';
    public $csvEscape = '\\';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Polls', 'polls', 'polls');

        $this->addCss('/plugins/kitsoft/polls/assets/css/tree.css');
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
        $validator = Validator::make(request()->all(), ['poll_id' => 'required']);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $this->csvEncoding = post('encoding');

        Db::beginTransaction();
        try {
            // remove all childs data, before import
            ImportHelpers::removeData(post('poll_id'), post('option_id'));

            $this->asExtension('ImportController')->importStream();

        } catch (Exception $e) {
            Db::rollback();
            trace_log($e);
            throw new ApplicationException($e->getMessage());
        }

        Db::commit();
        Flash::success("Успішно імпортовано.");

        return redirect(Backend::url('kitsoft/polls/polls'));
    }

    /**
     * downloadStatistic
     */
    public function downloadStatistic(int $id)
    {
        $data = request()->all();

        $validator = Validator::make($data, [
            'from' => 'required|date|before_or_equal:to',
            'to' => 'required|date|after_or_equal:from',
        ]);

        if ($validator->fails()) {
            Flash::error($validator->errors()->first());
            return redirect()->back();
        }

        try {
            $poll = Poll::findOrFail($id);

            $statistic = new Statistic($poll);

            $statistic->setFromDate(array_get($data, 'from'));
            $statistic->setToDate(array_get($data, 'to'));
            $statistic->addVotesList();
            $statistic->addCommentsList();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }

        return $statistic->download();
    }

    /**
     * importStreamRow
     */
    public function importStreamRow($item, $matches)
    {
        ImportHelpers::importRow($item, $matches);
    }

    /**
     * onStatisticForm
     */
    public function onStatisticForm(int $id)
    {
        $config = $this->makeConfig('$/kitsoft/polls/classes/statistic/fields.yaml');
        $config->model = Model::make();
        $config->alias = 'statisticForm';

        $this->vars = [
            'id' => $id,
            'widget' => $this->makeFormWidget('Backend\Widgets\Form', $config)
        ];

        return $this->makePartial('$/kitsoft/polls/classes/statistic/_popup.htm');
    }
}
