<?php namespace KitSoft\Services\Components;

use App;
use Mail;
use Exception;
use Cms\Classes\ComponentBase;
use KitSoft\Services\Models\Service as ServiceModel;
use Validator;
use ValidationException;

class Service extends ComponentBase
{
    public $service;
    public $formAction;

    public function componentDetails()
    {
        return [
            'name'        => 'Service',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        if (!$this->service = $this->loadService()) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        // redirect
        if ($this->service->type == 'link') {
            return redirect($this->service->link);
        }

        // pdf
        if (request()->has('pdf')) {
            return $this->generatePdf()->stream();
        }

        // mail
        if (request()->has('mail')) {
            return $this->generateMailContent();
        }

        $this->controller->addJs('/plugins/kitsoft/services/assets/js/hit.js');

        $this->formAction = url('api/service_form/send');

        $this->page->hash = $this->service->hash;

        $this->setSeoTags();
        $this->setOgTags();
    }

    /**
     * loadService
     */
    protected function loadService()
    {
        return ServiceModel::isPublished()
            ->with(['life_situations' => function ($query) {
                return $query->isPublished();
            }])
            ->where('slug', $this->param('slug'))
            ->first();
    }

    /**
     * onServiceHit
     */
    public function onServiceHit()
    {
        if ($service = $this->loadService()) {
            $service->increment('hits');
        }
    }

    /**
     * onServiceActionHit
     */
    public function onServiceActionHit()
    {
        if ($service = $this->loadService()) {
            $service->increment('action_hits');
        }
    }

    /**
     * setSeoTags
     */
    protected function setSeoTags()
    {
        $this->page->meta_title = $this->service->meta_title
            ? $this->service->meta_title
            : $this->service->title;

        $this->page->meta_description = $this->service->meta_description
            ? $this->service->meta_description
            : ($this->service->excerpt
                ? $this->service->excerpt
                : str_before(strip_tags($this->service->html_content), '.')
            );
    }

    /**
     * setOgTags
     */
    protected function setOgTags()
    {
        if (!$this->service->og_image) {
            return;
        }

        $this->page->og_image = media_url($this->service->og_image);
    }

    /**
     * generatePdf
     */
    protected function generatePdf()
    {
        $pdf = App::make('dompdf.wrapper');

        $pdf->setOptions([])->loadHTML($this->renderPartial('@pdf.htm', [
            'pdfSections' => $this->service
                ->sections()
                ->whereRaw("fields::jsonb ->> 'isPdfRender' = '1'")
                ->get()
        ]));

        return $pdf;
    }

    /**
     * generateMailContent
     */
    protected function generateMailContent()
    {
        return $this->renderPartial('@info.htm', [
            'sections' => $this->service
                ->sections()
                ->whereRaw("fields::jsonb ->> 'isPdfRender' = '1'")
                ->get()
        ]);
    }

    /**
     * onInfoServiceSendToMail
     */
    public function onInfoServiceSendToMail()
    {
        $data = request()->all();

        $validator = Validator::make($data, [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            $this->loadService();

            Mail::send('kitsoft.services::services.service_info', [
                'service' => $this->service,
                'content' => $this->generateMailContent()
            ], function ($message) use ($data) {
                $message->to($data['email']);
                $message->subject($this->service->title);
            });
        } catch (Exception $e) {
            trace_log($e);
            return response()->json('Something was wrong', 500);
        }
    }

    /**
     * onPdfServiceSendToMail
     */
    public function onPdfServiceSendToMail()
    {
        $data = request()->all();

        $validator = Validator::make($data, [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            $this->loadService();

            Mail::send('kitsoft.services::services.service_pdf', [
                'service' => $this->service
            ], function ($message) use ($data) {
                $message->to($data['email']);
                $message->attachData($this->generatePdf()->output(), "{$this->service->slug}.pdf");
            });
        } catch (Exception $e) {
            trace_log($e);
            return response()->json('Something was wrong', 500);
        }
    }
}
