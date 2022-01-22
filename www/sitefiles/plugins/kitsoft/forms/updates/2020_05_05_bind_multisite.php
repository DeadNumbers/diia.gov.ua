<?php namespace KitSoft\Forms\Updates;

use Schema;
use KitSoft\Forms\Models\Form;
use KitSoft\Forms\Models\Inbox;
use KitSoft\MultiSite\Models\Site;
use KitSoft\MultiSite\Classes\MultiSite;
use October\Rain\Database\Updates\Migration;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\MultiSite\Models\Entity as MSEntity;
use KitSoft\MultiLanguage\Models\Entity as MLEntity;

class BindMultiSite extends Migration
{
    protected $haveML;
    protected $haveMS;

    /**
     * up
     */
    public function up()
    {
        $this->setProjectParams();

        if ($this->haveMS) {
            $this->bindInboxes();
        }

        if ($this->haveMS || $this->haveML) {
            if ($forms = Form::withoutGlobalScopes()->get()) {
                $this->cloneForms($forms);
            }
        }
    }

    /**
     * setProjectParams
     */
    protected function setProjectParams()
    {
        $this->haveML = Schema::hasTable('kitsoft_multilanguage_entities');
        $this->haveMS = Schema::hasTable('kitsoft_multisite_sites_entities');
    }

    /**
     * bindInboxes
     */
    protected function bindInboxes()
    {
        $mainSiteID = MultiSite::instance()->getCurrentSiteId();

        Inbox::withoutGlobalScopes()->chunk(50, function ($items) use ($mainSiteID) {
            foreach ($items as $item) {
                if ($item->sites()->get()->count()) {
                    continue;
                }

                MSEntity::createIfNotExist([
                    'site_id'     => $mainSiteID,
                    'entity_id'   => $item->id,
                    'entity_type' => Inbox::class
                ]);
            }
        });
    }

    /**
     * cloneForms
     * @param collection $forms
     */
    protected function cloneForms($forms)
    {
        if ($this->haveML) {
            MultiLanguage::instance()->setLocale('ua');
        }

        if ($this->haveMS) {
            Site::orderBy('id', 'asc')->get()->each(function ($site) use ($forms) {
                MultiSite::instance()->reinitSite($site->id);
                foreach ($forms as $form) {

                    if (!$form->sites()->get()->count()) {
                        $this->bindForm($site->id, $form->id);
                        continue;
                    }

                    $haveThisForm = Form::make()->where('code', $form->code)->first();

                    if ($form->site->site_id == $site->id || $haveThisForm) {
                        if ($this->haveML) {
                            MLEntity::createIfNotExist([
                                'locale'      => 'ua',
                                'entity_id'   => $form->id,
                                'relation_id' => $form->id,
                                'entity_type' => Form::class,
                            ]);
                        }

                        continue;
                    }

                    $newForm = $form->replicate();
                    $newForm->save();

                    foreach ($form->fields as $field) {
                        $newField = $field->replicate();
                        $newField->form_id = $newForm->id;
                        $newField->save();
                    }
                }
            });

        } elseif ($this->haveML) {
            foreach ($forms as $form) {
                MLEntity::createIfNotExist([
                    'locale'      => 'ua',
                    'entity_id'   => $form->id,
                    'relation_id' => $form->id,
                    'entity_type' => Form::class,
                ]);
            }
        }
    }

    /**
     * bindFormWithFields
     * @params int $siteID, int $formID
     */
    protected function bindForm(int $siteID, int $formID)
    {
        MSEntity::insert([
            'site_id'     => $siteID,
            'entity_id'   => $formID,
            'entity_type' => Form::class
        ]);

        if ($this->haveML) {
            MLEntity::createIfNotExist([
                'locale'      => 'ua',
                'entity_id'   => $formID,
                'relation_id' => $formID,
                'entity_type' => Form::class
            ]);
        }
    }

    public function down()
    {

    }
}
