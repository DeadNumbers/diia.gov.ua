<?php 
class Cms61ca49ba216ad897338834_2f8d9ac1a46a27b006314cee2abdcfa3Class extends Cms\Classes\PageCode
{
public function onEnd()
{
    $this->page->title = $this->serviceCategory->item->name;
}
}
