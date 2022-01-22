<?php namespace KitSoft\Multilanguage\Models;

use Str;
use Artisan;
use Cache;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use Model;

/**
 * Message Model
 */
class Message extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_multilanguage_messages';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $jsonable = ['translates'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /*
     * afterSave
     */
    public function afterSave()
    {
        Cache::forget('kitsoft.multilanguage.messages');
    }

    /*
     * getList
     */
    public static function getList()
    {
        $data = self::all();
        foreach ($data as $row) {
            $result[$row->message] = $row->translates;
        }
        return $result ?? [];
    }

    /**
     * trans
     */
    public static function trans($name, $params, $lang = null, $plural = null)
    {
        $lang = $lang ?: MultiLanguage::instance()->getActiveLocale(true);
        $code = self::makeMessageCode($name, $plural);

        $cacheKey = 'kitsoft.multilanguage.messages';
        if (!$messages = Cache::get($cacheKey)) {
            $messages = self::getList();
            Cache::forever($cacheKey, $messages);
        }

        if (!isset($messages[$code])) {
            self::insert([
                'message' => $code,
                'translates' => json_encode([$lang => $name])
            ]);
            Cache::forget($cacheKey);
        }

        $params = array_build($params, function ($key, $value) {
            return [':'.$key, $value];
        });

        $msg = (isset($messages[$code], $messages[$code][$lang]))
            ? $messages[$code][$lang]
            : $name;

        $msg = strtr($msg, $params);

        return $msg;
    }

    /**
     * makeMessageCode
     */
    protected static function makeMessageCode($message, $plural = false)
    {
        $message = strip_tags($message);

        $separator = '.';

        // Convert all dashes/underscores into separator
        $message = preg_replace('!['.preg_quote('_').'|'.preg_quote('-').']+!u', $separator, $message);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $message = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($message));

        // Replace all separator characters and whitespace by a single separator
        $message = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $message);

        $message = trim($message, $separator);

        $result = (strlen($message) > 255)
            ? substr($message, 0, 255 - 40) . '-' . md5($message)
            : $message;

        return $plural
            ? "{$result}_plural"
            : $result;
    }

    /**
     * Import an array of messages. Only known messages are imported.
     */
    public static function importMessages($messages)
    {
        self::importMessageCodes(array_combine($messages, $messages));
    }

    /**
     * Import an array of messages. Only known messages are imported.
     */
    public static function importMessageCodes($messages, $locale = null)
    {
        $locale = $locale ?? MultiLanguage::instance()->getDefaultLocale();

        foreach ($messages as $code => $message) {
            // Ignore empties
            if (!strlen(trim($message))) {
                continue;
            }

            $code = self::makeMessageCode($code);

            if (!$item = self::where('message', $code)->first()) {
                $item = self::make();
                $item->message = $code;
                $item->save();
            }

            // Do not overwrite existing translations
            if (isset($item->translates[$locale])) {
                continue;
            }

            $item->translates = array_merge($item->translates ?? [], [$locale => $message]);
            $item->save();
        }
    }
}
