<?php

namespace KitSoft\Forms\Classes\Validatorbuilders;

use \KitSoft\Forms\Classes\Interfaces\ValidatorBuilderInterface;

class BuilderLimit implements ValidatorBuilderInterface
{
    /**
     * @param $data
     * @return array
     */
    public function build($data): array
    {
        if ($min = array_get($data, 'min')) {
            $return[] = 'min:' . $min;
        }

        if ($max = array_get($data, 'max')) {
            $return[] = 'max:' . $max;
        }

        return $return;
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return collect([
            'max' => 'kitsoft.forms::lang.validation.max.string',
            'min' => 'kitsoft.forms::lang.validation.min.string'
        ])
            ->map(function ($item) {
                return (($res = trans($item)) && $res !== $item) ? $res : '';
            })
            ->filter(function ($item) {
                return $item;
            })
            ->toArray();
    }
}
