<?php namespace KitSoft\Core\Console\Interfaces;

interface ContentGenerationInterface
{
    public function __construct(int $count = null);
    public function run();
}
