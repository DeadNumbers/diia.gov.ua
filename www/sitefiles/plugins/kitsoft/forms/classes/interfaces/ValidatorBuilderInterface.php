<?php

namespace KitSoft\Forms\Classes\Interfaces;

interface ValidatorBuilderInterface
{
    /**
     * @param $data
     * @return array
     */
    public function build($data): array;

    /**
     * @return array
     */
    public function messages(): array;
}
