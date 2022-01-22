<?php namespace KitSoft\TaxSystems\Components;

use App;
use Cms\Classes\ComponentBase;
use Mail;
use KitSoft\TaxSystems\Models\TaxSystem as TaxSystemModel;
use Exception;
use Validator;
use ValidationException;

class TaxSystem extends ComponentBase
{
    public $item;
    public $choise;

    public function componentDetails()
    {
        return [
            'name'        => 'Tax System',
            'description' => ''
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        if (!$this->item = $this->loadTaxSystem()) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        // pdf
        if (request()->has('pdf')) {
            return $this->generatePdf()->stream();
        }

        $this->choise = request()->has('choise');

        $this->page->hash = $this->item->hash;
    }

    /**
     * loadTaxSystem
     */
    protected function loadTaxSystem()
    {
         return TaxSystemModel::isPublished()
            ->where('slug', $this->param('slug'))
            ->first();
    }

    /**
     * generatePdf
     */
    protected function generatePdf()
    {
        $pdf = App::make('dompdf.wrapper');

        $pdf->setOptions([])->loadHTML($this->renderPartial('@pdf.htm', [
            'item' => $this->item
        ]));

        return $pdf;
    }

    /**
     * onPdfTaxSystemSendToMail
     */
    public function onPdfTaxSystemSendToMail()
    {
        $data = request()->all();

        $validator = Validator::make($data, [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            $this->loadTaxSystem();

            Mail::send('kitsoft.taxsystems::taxsystems.taxsystem_pdf', [
                'item' => $this->item
            ], function ($message) use ($data) {
                $message->to($data['email']);
                $message->attachData($this->generatePdf()->output(), "{$this->item->slug}.pdf");
            });
        } catch (Exception $e) {
            trace_log($e);
            return response()->json('Something was wrong', 500);
        }
    }
}
