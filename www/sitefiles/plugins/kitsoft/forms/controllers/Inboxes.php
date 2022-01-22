<?php namespace KitSoft\Forms\Controllers;

use ApplicationException;
use BackendMenu;
use Backend\Classes\Controller;
use KitSoft\Forms\Models\Inbox;
use System\Classes\SettingsManager;
use Validator;
use ValidationException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Request;

/**
 * Inboxes Back-end Controller
 */
class Inboxes extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['kitsoft.forms.manage_inbox'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('KitSoft.Forms', 'inbox');
    }

    /**
     * export
     */
    public function export($context = null)
    {
        $config = $this->makeConfig('$/kitsoft/forms/models/inbox/export.yaml');
        $config->model = new Inbox();

        $this->vars['formWidget'] = $this->makeWidget('Backend\Widgets\Form', $config);
    }

    /**
     * preview
     */
    public function preview($id)
    {
        $inbox = Inbox::find($id);

        if ($inbox && $inbox->status == 'new') {
            $inbox->status = 'process';
            $inbox->save();
        }

        parent::preview($id);

        $this->vars['statuses'] = Inbox::make()->getStatusOptions();
    }

    /**
     * listExtendQuery
     */
    public function listExtendQuery($query)
    {
        if ($formCode = request()->get('form')) {
            $query->whereHas('form', function ($query) use ($formCode) {
                return $query->where('code', $formCode);
            });
        }

        if ($status = request()->get('status')) {
            $query->where('status', 'new');
        }
    }

    /**
     * onChangeStatus
     */
    public function onChangeStatus($id)
    {
        $validator = Validator::make(request()->all(), [
            'status' => [
                'required',
                'in' => Inbox::make()->getStatusOptions()
            ]
        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            $inbox = Inbox::find($id);
            $inbox->status = post('status');
            $inbox->save();
        } catch (Exception $e) {
            throw new ApplicationException($e->getMessage());
            trace_log($e);
            return;
        }

        return redirect()->back();
    }

    /**
     * downloadItem
     */
    public function downloadItem()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'date_to' => 'date',
            'date_from' => 'date'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $inboxes = Inbox::filterDates($data['date_from'], $data['date_to'])->get();

        $spreadsheet = new Spreadsheet();
        $writer = new Xls($spreadsheet);

        try {
            $spreadsheet->setActiveSheetIndex( 0);

            $activeSheet = $spreadsheet->getActiveSheet();

            $activeSheet->setCellValue("A1", 1);
            $activeSheet->setCellValue("A2", 'id');
            $activeSheet->setCellValue("B1", 2);
            $activeSheet->setCellValue("B2", 'Форма');
            $activeSheet->setCellValue("C1", 3);
            $activeSheet->setCellValue("C2", 'Поля');
            $activeSheet->setCellValue("D1", 4);
            $activeSheet->setCellValue("D2", 'Дата створення');
            $activeSheet->setCellValue("E1", 5);
            $activeSheet->setCellValue("E2", 'Статус');

            $startCell = $endCell = 2;

            $inboxes->each(function ($item) use ($activeSheet, &$startCell, &$endCell) {
                $startCell = $endCell + 1;
                $endCell = $startCell;
                $activeSheet->setCellValue("A{$startCell}", $item->id);
                $activeSheet->setCellValue("B{$startCell}", $item->form ? $item->form->name : '-');
                $activeSheet->setCellValue("C{$startCell}", $item->fields_string);
                $activeSheet->setCellValue("D{$startCell}", $item->created_at);
                $activeSheet->setCellValue("E{$startCell}", $item->getStatusOptions()[$item->status]);
            });
        } catch (Exception $e) {
            trace_log($e);
            die($e->getMessage());
        }

        $filename = 'Запити.xls';
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename={$filename}");
        header('Cache-Control: max-age=0');
        die($writer->save("php://output"));
    }
}
