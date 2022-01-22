<?php namespace KitSoft\Pages\Models;

use Db;
use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Classes\ValidationHelpers;
use KitSoft\Pages\Models\Page;
use Model;
use October\Rain\Html\Helper as HtmlHelper;
use Cms\Classes\Theme;
use October\Rain\Parse\Yaml;

/**
 * Component Model
 */
class Section extends Model
{
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_pages_sections';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $hidden = ['test'];

    protected $jsonable = ['fields'];

    public $rules = [
        'name' => 'required|max:255',
        'title' => 'required|max:255'
    ];

    /**
     * beforeValidate
     */
    public function beforeValidate()
    {
        // add validation rules only for update, not for create
        if ($this->id) {
            $rules = ValidationHelpers::getRulesFromFields($this->getConfigFields());
            $this->rules = array_merge($this->rules, $rules);
        }
    }

    /**
     * page
     */
    public function entity() {
        return Db::table('kitsoft_pages_entities')
            ->where('entity_type', self::class)
            ->where('entity_id', $this->id)
            ->first();
    }

    /**
     * scopeIsPublished
     */
    public function scopeIsPublished($query)
    {
        return $query
            ->where('published', true);
    }

    /**
     * getPagesOptions
     */
    public function getPagesOptions() {
        return Page::orderBy('nest_left', 'asc')
            ->listsNested('title', 'id');
    }

    /**
     * getSectionsList
     */
    public static function getSectionsList($template = null) {
        $theme = Theme::getActiveThemeCode();

        $templatesPath = themes_path("{$theme}/fields/sections");
        if(!file_exists($templatesPath))
            return [];

        $templates = array_diff(scandir($templatesPath), ['.', '..']);

        $result = [];
        foreach($templates as &$row) {
            $key = basename($row, '.yaml');
            $section = (new Yaml())->parsefile("{$templatesPath}/{$row}");
            $sectionTemplates = isset($section['templates'])
                ? explode(',', $section['templates'])
                : [];

            if ($template && $sectionTemplates && !in_array($template, $sectionTemplates)) continue;

            $row = $section['title'] ?? $key;
            $result[$key] = $row;
        }

        return $result;
    }

    /**
     * getCodeAttribute
     */
    public function getCodeAttribute()
    {
        return $this->name;
    }

    /**
     * beforeCreate
     */
    public function beforeCreate() {
        $this->title = $this->title ?? $this->name;
    }

    /**
     * getConfigYaml
     */
    public function getConfigYaml()
    {
        return PagesHelper::getSectionConfig($this->name);
    }

    /**
     * getConfigFields
     */
    public function getConfigFields()
    {
        $config = $this->getConfigYaml();

        return PagesHelper::getConfigFieldsFromTabs($config);
    }
}
