<?php namespace KitSoft\Pages\FormWidgets;

use Str;
use Input;
use Event;
use Config;
use Request;
use Response;
use Validator;
use Backend\Classes\FormField;
use Backend\Classes\FormWidgetBase;
use Backend\Controllers\Files as FilesController;
use October\Rain\Filesystem\Definitions as FileDefinitions;
use ApplicationException;
use ValidationException;
use Exception;
use System\Models\File;


/**
 * File upload field
 * Renders a form file uploader field.
 *
 * Supported options:
 * - mode: image-single, image-multi, file-single, file-multi
 * - upload-label: Add file
 * - empty-label: No file uploaded
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 */
class FileUpload extends FormWidgetBase
{
    use \Backend\Traits\FormModelWidget;

    //
    // Configurable properties
    //

    /**
     * @var string Prompt text to display for the upload button.
     */
    public $prompt = null;

    /**
     * @var boolean Allow the user to set a caption.
     */
    public $useCaption = true;

    //
    // Object properties
    //

    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'multimediafinder';

    protected $assetsUrl = '/plugins/kitsoft/pages/formwidgets/fileupload/assets';

    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->fillFromConfig([
            'prompt',
            'useCaption'
        ]);

        if ($this->formField->disabled) {
            $this->previewMode = true;
        }

    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('fileupload');
    }

    /**
     * Prepares the view data
     */
    protected function prepareVars()
    {
        if ($this->previewMode) {
            $this->useCaption = false;
        }

        $this->vars['fileList'] = $fileList = $this->getFileList();
        $this->vars['singleFile'] = $fileList->first();
        $this->vars['useCaption'] = $this->useCaption;
        $this->vars['prompt'] = 'multimediafinder';
    }

    protected function getFileList()
    {
        return $this
            ->getRelationObject()
            ->withDeferred($this->sessionKey)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Removes a file attachment.
     */
    public function onRemoveAttachment()
    {
        if (($fileId = post('file_id')) && ($file = File::find($fileId))) {
            $file->delete();
        }
    }

    /**
     * Sorts file attachments.
     */
    public function onSortAttachments()
    {
        if ($sortData = post('sortOrder')) {
            $ids = array_keys($sortData);
            $orders = array_values($sortData);

            $fileModel = $this->getRelationModel();
            $fileModel->setSortableOrder($ids, $orders);
        }
    }

    /**
     * Loads the configuration form for an attachment, allowing title and description to be set.
     */
    public function onLoadAttachmentConfig()
    {
        $fileModel = $this->getRelationModel();
        if (($fileId = post('file_id')) && ($file = $fileModel::find($fileId))) {
            $this->vars['file'] = $file;
            $this->vars['relationManageId'] = post('manage_id');
            $this->vars['relationField'] = post('_relation_field');

            return $this->makePartial('config_form');
        }

        throw new ApplicationException('Unable to find file, it may no longer exist');
    }

    /**
     * Commit the changes of the attachment configuration form.
     */
    public function onSaveAttachmentConfig()
    {
        try {
            $fileModel = $this->getRelationModel();
            if (($fileId = post('file_id')) && ($file = $fileModel::find($fileId))) {
                $file->title = post('title');
                $file->description = post('description');
                $file->save();

                return ['displayName' => $file->title ?: $file->file_name];
            }

            throw new ApplicationException('Unable to find file, it may no longer exist');
        }
        catch (Exception $ex) {
            return json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * @inheritDoc
     */
    protected function loadAssets()
    {
        $this->addCss($this->assetsUrl . '/css/fileupload.css', 'core');
        $this->addJs($this->assetsUrl . '/js/fileupload.js', 'core');
        $this->addJs($this->assetsUrl . '/js/multimediafinder.js', 'core');
    }

    /**
     * @inheritDoc
     */
    public function getSaveValue($value)
    {
        return FormField::NO_SAVE_DATA;
    }

    /**
     * @onMultiFileUpload
     */
    public function onMultiFileUpload()
    {
        try {
            if (!Input::has('value')) {
                throw new ApplicationException('File missing from request');
            }

            $systemFile = new File;
            $systemFile->disk_name = $systemFile->file_name = Input::get('value');

            $filepath = base_path(Config::get('cms.storage.media.path') . $systemFile->disk_name);

            $systemFile->field = $this->formField->fieldName;
            $systemFile->attachment_id = $this->model->id ?: null;
            $systemFile->attachment_type = get_class($this->model);
            $systemFile->is_public = 1;
            $systemFile->file_size = filesize($filepath);
            $systemFile->content_type = mime_content_type($filepath);
            $systemFile->created_at = date('Y-m-d H:i:s');
            $systemFile->field_type = 'mediafinder';

            Event::fire('multimediafinder.saveBefore', [&$systemFile]);

            $systemFile->save();

            $result = [
                'id' => $systemFile->id,
                'thumb' => FilesController::getDownloadUrl($systemFile),
                'path' => $systemFile->file_name
            ];

            Response::json($result, 200)->send();

        }
        catch (Exception $ex) {
            Response::json($ex->getMessage(), 400)->send();
        }

        exit;
    }
}
