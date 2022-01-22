<?php namespace KitSoft\Pages\Behaviors;

use October\Rain\Extension\ExtensionBase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * ContentHandlerModel
 */
class ContentHandlerModel extends ExtensionBase
{
    protected $model;

    /**
     * Constructor
     */
    public function __construct($model)
    {
        $this->model = $model;

        $this->model->bindEvent('model.beforeSave', function () {
            $this->beforeSave();
        });
    }

    /**
     * beforeSave
     */
    protected function beforeSave()
    {
        foreach ($this->model->contentHandlerFields as $field) {
            if (!isset($this->model->{$field})) {
                continue;
            }
            $this->model->{$field} = $this->getContentHandlerField($this->model->{$field});
        }
    }

    /**
     * getContentHandlerField
     */
    protected function getContentHandlerField(string $content)
    {
        preg_match_all("/<a .*?class=\"fr-file\"(.+?)(?=href)href=\"([^\"]+)\".*?>/si", $content, $matches);

        if (!isset($matches[2]) || !is_array($matches[2])) {
            return $content;
        }

        foreach ($matches[2] as $key => $link) {
            if (!$file = $this->getFile($link)) {
                continue;
            }

            $html = $matches[0][$key];

            $content = str_replace($html, $this->extendString($html, $file), $content);
        }

        return $content;
    }

    /**
     * getFile
     */
    protected function getFile(string $url)
    {
        $url = rawurldecode($url);
        $host = parse_url($url, PHP_URL_HOST);
        $currentHost = request()->getHttpHost();
        $path = parse_url($url, PHP_URL_PATH);

        if (!$path) {
            return;
        }

        if ($host && $host !== $currentHost) {
            return;
        }

        $path = base_path($path);

        if (!file_exists($path)) {
            return;
        }
        
        return new UploadedFile($path, basename($path));
    }

    /**
     * extendString
     */
    protected function extendString(string $content, UploadedFile $file): string
    {
        $string = "class=\"fr-file\"";
        $string .= " data-size=\"{$file->getSize()}\"";
        $string .= " data-extension=\"{$file->getClientOriginalExtension()}\"";

        return str_replace('class="fr-file"', $string, $content);
    }
}
