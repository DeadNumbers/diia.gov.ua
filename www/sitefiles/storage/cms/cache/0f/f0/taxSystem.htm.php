<?php 
class Cms61ca47bfafd25151489526_da561c7e63a5ab8e7299f2d846abc363Class extends Cms\Classes\PageCode
{
public function onEnd()
{
    $this->page->title = $this->taxSystem->item->title;
}
}
