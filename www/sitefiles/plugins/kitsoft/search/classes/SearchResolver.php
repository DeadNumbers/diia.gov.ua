<?php
namespace KitSoft\Search\Classes;

use Illuminate\Http\Request;
use KitSoft\Search\Classes\ElasticSearch;
use KitSoft\Search\Classes\EloquentSearch;
use KitSoft\Search\Classes\Traits\HelperTrait;
use KitSoft\Search\Models\Settings;
use Exception;
use ValidationException;

/**
* search
*/
class SearchResolver
{
    use HelperTrait;

    public function requestHandler(Request $request)
    {
        try {
            if (!$this->isValidPaginatorPage($request)) {
                throw new ValidationException(['per_page' => 'The page param is too large.']);
            }

            $result = $this->factory($request)->search();

        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'errors' => $e->getErrors()
            ], 406);
        } catch (Exception $e) {
            trace_log($e);
            
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

        return $result;
    }

    /**
     * factory
     */
    protected function factory(Request $request)
    {
        if ((bool)Settings::get('is_elastic')) {
            return new ElasticSearch($request);
        } else {
            return new EloquentSearch($request);
        }
    }
}
