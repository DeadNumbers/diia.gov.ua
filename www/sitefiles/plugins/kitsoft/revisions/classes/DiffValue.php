<?php namespace KitSoft\Revisions\Classes;

use SebastianBergmann\Diff\Differ;

class DiffValue
{
    const TYPE_ADDED = 'added';
    const TYPE_REMOVED = 'removed';
    const TYPE_MODIFIED = 'modified';
    
    public $oldValue;
    public $newValue;
    public $oldValueDiff;
    public $newValueDiff;
    public $type;
    
    public function __construct($type, $oldValue, $newValue)
    {
        $this->oldValue = $oldValue;
        $this->newValue = $newValue;
        $this->type = $type;
        $this->setDifference();
    }

    /**
     * setDifference
     */
    protected function setDifference(): void
    {
        $differ = new Differ;
        $differ = $differ->diffToArray((string)$this->oldValue, (string)$this->newValue);

        $old = $current = '';

        foreach ($differ as $key => $row) {
            if (!$string = trim(preg_replace('/\s+/', ' ', $row[0]))) {
                continue;
            }
            if (empty($string)) {
                continue;
            }
            switch ($row[1]) {
                case 1:
                    $current .= $string . '<hr>';
                    break;
                case 2:
                    $old .= $string . '<hr>';
                    break;
            }
        }

        $this->oldValueDiff = $old;
        $this->newValueDiff = $current;
    }
}
