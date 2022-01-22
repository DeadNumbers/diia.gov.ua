<?php namespace KitSoft\Core\Extensions;

use System\Controllers\Settings as SettingsController;
use DB;
use Flash;
use Schema;
use Validator;
use ValidationException;

class DomainChangingExtension
{
    protected $allowedColumns = [
        'content',
        'content_html',
        'html_content',
        'link_content',
        'excerpt',
        'name',
        'title',
        'description',
        'question',
        'answer',
        'bio',
        'bio_timeline',
        'links',
        'fields'
    ];

    /**
     * __construct
     */
    public function __construct()
    {
        $this->extendSettingsController();
    }

    /**
     * extendSettingsController
     */
    protected function extendSettingsController()
    {
        SettingsController::extend(function($controller) {
            $controller->addDynamicMethod('onReplaceDomain', function() {

                $data = request()->all();

                $validator = Validator::make($data, [
                    'DomainChanging.oldValue' => 'required|url',
                    'DomainChanging.newValue' => 'required|url',
                ]);

                if ($validator->fails()) {
                    throw new ValidationException($validator);
                }

                DB::beginTransaction();
                try {
                    $oldValue = post('DomainChanging[oldValue]');
                    $newValue = post('DomainChanging[newValue]');
                    $model = post('DomainChanging[model]');
                    $table = $model::make()->getTable();

                    $columns = Schema::getColumnListing($table);

                    foreach ($columns as $column) {
                        if (!in_array($column, $this->allowedColumns)) {
                            continue;
                        }
                        DB::statement("UPDATE {$table} SET {$column} = REPLACE({$table}.{$column}, '{$oldValue}', '{$newValue}')");
                    }

                } catch (Exception $e) {
                    DB::rollback();
                    trace_log($e);
                    Flash::error('Неможливо виконати!');
                    return;
                }

                DB::commit();
                Flash::success("Успішно виконано!");
            });
        });
    }
}