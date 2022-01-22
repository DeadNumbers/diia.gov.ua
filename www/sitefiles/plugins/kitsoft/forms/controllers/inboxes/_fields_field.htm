<ul>
	<?php /* render form fields */ ?>
	<?php $object = $record ?? $model; ?>
	<?php foreach ($object->form()->withoutGlobalScopes()->first()->fields as $field) : ?>
		<?php if (in_array($field->type, ['recaptcha', 'file']) || !isset($value[$field->code])) continue; ?>
		<li>
			<?php if ($field->rules && in_array('email', $field->rules)) : ?>
				<b><?= $field->title; ?>:</b> <a href="mailto:<?= htmlentities($value[$field->code]); ?>"><?= htmlentities($value[$field->code]); ?></a>
			<?php else : ?>
				<?php if (is_array($value[$field->code])) : ?>
					<b><?= $field->title; ?>:</b>
					<?= htmlentities(implode(', ', $value[$field->code])); ?>
				<?php else : ?>
					<b><?= $field->title; ?>:</b> <?= htmlentities($value[$field->code]); ?>
				<?php endif ?>
			<?php endif ?>
		</li>
	<?php endforeach ?>

	<?php /* render other fields */ ?>
	<?php foreach ($value as $code => $value) : ?>
		<?php if ($object->form()->withoutGlobalScopes()->first()->fields->where('code', $code)->count()) continue; ?>
		<?php if (!is_string($code) || !is_string($value)) {echo 'Invalid data';continue;} ?>
		<li><b><?= htmlentities($code); ?>:</b> <?= htmlentities($value); ?></li>
	<?php endforeach ?>
</ul>