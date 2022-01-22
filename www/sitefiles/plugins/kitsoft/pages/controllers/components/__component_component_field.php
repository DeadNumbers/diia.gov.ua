<?php $components = KitSoft\Pages\Models\Component::getAvailableComponents($this->widget->form->model->layout); ?>

<div class="components-section">
    <input type="hidden" name="Component[name]" value="">
    <input type="hidden" name="Component[class]" value="">

    <div id="components-modal" class="control-list">
        <table class="table data">
            <thead>
                <tr>
                    <th><span><?= trans('kitsoft.pages::lang.components.plugin_name'); ?></span></th>
                    <th><span><?= trans('kitsoft.pages::lang.components.name'); ?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($components as $key => $tab) : ?>
                    <tr>
                        <td><strong style="font-size: 14px"><?= $key ?></strong></td>
                        <td>
                            <?php foreach ($tab as $component) : ?>
                                <button
                                    type="button"
                                    class="btn btn-primary components-section-type"
                                    style="margin-bottom:5px;"
                                    data-name="<?= $component->alias; ?>"
                                    data-classname="<?= get_class($component); ?>"
                                ><?= $component->name; ?></button>
                            <?php endforeach ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $('.btn.components-section-type').on('click', function(){
        var name = $(this).data('name')
        var classname = $(this).data('classname')

        $(this).parents('.components-section').find('input[name="Component[name]"]').val(name)
        $(this).parents('.components-section').find('input[name="Component[class]"]').val(classname)
        $(this).parents('.modal').find('button[type=submit]').click()
        return false
    })
</script>