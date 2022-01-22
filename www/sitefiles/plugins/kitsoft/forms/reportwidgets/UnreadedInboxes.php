<?php namespace KitSoft\Forms\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use KitSoft\Forms\Models\Inbox;

class UnreadedInboxes extends ReportWidgetBase
{
    /**
     * render
     */
    public function render()
    {
    	$this->vars['count'] = Inbox::getUnreadedInboxCount();

    	return $this->makePartial('widget');
    }
}