<?php namespace KitSoft\Digest\Models;

use Backend\Models\ExportModel;
use KitSoft\Digest\Models\Subscriber;
use Config;

/**
 * SubscriberExport Model
 */
class SubscriberExport extends ExportModel
{
    /**
     * exportData
     */
    public function exportData($columns, $sessionKey = null) {
        return Subscriber::make()
            ->get()
            ->transform (function ($item) {
                $item->listsString = $item->listsString;
                $item->tagsString = $item->tagsString;
                if ($item->content_types) {
                    $item->contentLabels = implode(', ', $this->contentTypes($item->content_types));
                }
                return $item;
            })
            ->toArray();
    }

    /**
     * contentTypes
     */
    public function contentTypes($content_types) {
        $content_types_arr = [];

        foreach ($content_types as $content_type) {
            $content_types_arr[] = Config::get("kitsoft.digest::config.types.{$content_type}.title");
        }

        return $content_types_arr;
    }

}
