<?php namespace KitSoft\Core\Extensions;

use Backend\FormWidgets\RichEditor;

class RichEditorExtension
{
    /**
     * __construct
     */
    public function __construct()
    {
        $this->extendRichEditor();
    }

    /**
     * extendRichEditor
     */
    protected function extendRichEditor()
    {
        RichEditor::extend(function ($widget) {

        });
    }
}