<?php
namespace KitSoft\Search\Classes\Interfaces;

use Illuminate\Http\Request;

interface SearchInterface
{
    /**
     * receive request at search api
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(): \Illuminate\Http\JsonResponse;
}