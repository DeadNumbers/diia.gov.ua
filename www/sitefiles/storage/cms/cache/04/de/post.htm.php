<?php 
class Cms61ca49d08d8d8750610382_d2125c35d1f92dbd962edac6df229557Class extends Cms\Classes\PageCode
{
public function onEnd()
{
    $this->page->title = $this->blogPost->post->title;
}
}
