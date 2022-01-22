<?php namespace KitSoft\Core\Behaviors;

use ApplicationException;
use Backend\Classes\ControllerBehavior;
use League\Csv\Reader;
use Backend\Behaviors\ImportExportController\TranscodeFilter;
use Exception;
use ZipArchive;

class ImportController extends ControllerBehavior
{
    protected $controller;
    protected $importOptionsFormWidget;

    /**
     * __construct
     */
    public function __construct($controller)
    {
        $this->controller = $controller;

        parent::__construct($controller);

        $this->config = $this->makeConfig($controller->importConfig);

        if ($this->importOptionsFormWidget = $this->makeImportOptionsFormWidget()) {
            $this->importOptionsFormWidget->bindToController();
        }
    }

    /**
     * import
     */
    public function import()
    {
        $this->controller->pageTitle = $this->getConfig('title');

        $this->prepareImportVars();

        return $this->makePartial('import');
    }

    /**
     * getMapping
     */
    public function getMapping()
    {
        return $this->config->mapping ?? [];
    }

    /**
     * makeImportOptionsFormWidget
     */
    protected function makeImportOptionsFormWidget()
    {
        if ($fieldConfig = $this->getConfig('form')) {
            $widgetConfig = $this->makeConfig($fieldConfig);
            $widgetConfig->model = $this->importGetModel();
            $widgetConfig->alias = 'importForm';

            $widget = $this->makeWidget('Backend\Widgets\Form', $widgetConfig);
            return $widget;
        }

        return null;
    }

    /**
     * prepareImportVars
     */
    protected function prepareImportVars()
    {
        $this->vars['importOptionsFormWidget'] = $this->importOptionsFormWidget;
        $this->controller->vars += $this->vars;
    }

    /**
     * getImportFile
     */
    public function getImportFile()
    {
        return $this
            ->importGetModel()
            ->import_file()
            ->withDeferred($this->importOptionsFormWidget->getSessionKey())
            ->orderBy('id', 'desc')
            ->first()
        ;
    }

    /**
     * getImportFilePath
     */
    public function getImportFilePath()
    {
        return ($file = $this->getImportFile())
            ? $file->getLocalPath()
            : null;
    }

    /**
     * importGetModel
     */
    protected function importGetModel()
    {
        $modelClass = $this->getConfig('modelClass');
        
        return new $modelClass();
    }

    /**
     * getReaderObject
     */
    protected function getReaderObject()
    {
        if (!$filepath = $this->getImportFilePath()) {
            throw new ApplicationException('Файл не завантажено.');
        }

        if (in_array(pathinfo($filepath, PATHINFO_EXTENSION), ['zip'])) {
            $filepath = storage_path($this->unzipFile($filepath));
        }

        $filecontent = file_get_contents($filepath);

        if (isset($this->controller->csvEncoding)) {
            $filecontent = mb_convert_encoding($filecontent, 'UTF-8', $this->controller->csvEncoding);
        }
        
        $reader = Reader::createFromString($filecontent);

        // Filter out empty rows
        $reader->addFilter(function (array $row) {
            return count($row) > 1 || reset($row) !== null;
        });

        if (isset($this->controller->csvDelimiter)) {
            $reader->setDelimiter($this->controller->csvDelimiter);
        }

        if (isset($this->controller->csvEnclosure)) {
            $reader->setEnclosure($this->controller->csvEnclosure);
        }

        if (isset($this->controller->csvEscape)) {
            $reader->setEscape($this->controller->csvEscape);
        }

        return $reader;
    }

    /**
     * getDataFromCsvFile
     */
    public function getDataFromCsvFile()
    {
        $reader = $this->getReaderObject();

        $matches = $reader->fetchOne();

        $reader->setOffset(1);

        $result = [];
        $contents = $reader->fetchAll();
        foreach ($contents as $row) {
            $result[] = $this->processImportRow($row, $matches);
        }
        
        return $result;
    }

    /**
     * importStream
     */
    public function importStream()
    {
        $reader = $this->getReaderObject();
        $matches = $reader->fetchOne();

        if (!method_exists($this->controller, 'importStreamRow')) {
            throw new ApplicationException('Controller має містити функцію [importStreamRow].');
        }

        $reader->setOffset(1)->each(function ($item) use ($matches) {
            $this->controller->importStreamRow($item, $matches);
            return true;
        });  
    }

    /**
     * Converts a single row of CSV data to the column map.
     * @return array
     */
    protected function processImportRow($rowData, $matches)
    {
        $newRow = [];

        foreach ($matches as $columnIndex => $dbNames) {
            $value = array_get($rowData, $columnIndex);
            foreach ((array) $dbNames as $dbName) {
                $newRow[$dbName] = $value;
            }
        }

        return $newRow;
    }

    /**
     * unzipFile
     */
    protected function unzipFile($filepath)
    {
        $zip = new ZipArchive();

        $file = $zip->open($filepath);

        if ($file !== true) {
            throw new Exception('File open error.');
        }
        
        $temporaryFolder = "app/tmp/unzip_" . uniqid();
        $zip->extractTo(storage_path("{$temporaryFolder}"));

        return $temporaryFolder . '/' . $zip->getNameIndex(0);
    }
}
