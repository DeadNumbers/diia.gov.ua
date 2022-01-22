<?php 
class Cms61ca49f48d9ff017840993_b28416c78aacb857c9c8b0650566becaClass extends Cms\Classes\PageCode
{
public function onEnd()
{
    $this->page->title = $this->serviceCategorySubcategory->subcategory->name;
}
}
