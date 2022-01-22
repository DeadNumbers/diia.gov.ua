<?php $details = (new $model->class)->componentDetails(); ?>

<div class="field-section">
    <h4><?= Lang::get(array_get($details, 'name')); ?></h4>
    <p class="help-block"><?= Lang::get(array_get($details, 'description')); ?></p>
</div>