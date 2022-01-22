{% set form = __SELF__.form %}
{% set recaptcha = __SELF__.recaptcha %}

<div class="form-{{ form.code }}">
	<p>{{ form.description|raw }}</p>
	<form
		data-request="onSubmitForm"
		data-request-success="$(this).remove()"
		data-request-update="'{{__SELF__}}::result': '.callback-form-result'"
		data-request-files
		action="POST"
	>
		<input type="hidden" name="form_id" value="{{ form.id }}">
		{% for field in form.fields %}

			{# TEXT #}
			{% if field.type == 'text' %}
				<div class="form-group field-{{ field.code }}">
					<label for="{{ field.code }}">{{ field.title }}</label>
					<input
						class="form-control"
						type="text"
						name="{{ field.code }}"
						id="{{ field.code }}"
						placeholder="{{ field.placeholder }}"
					>
				</div>
			{# /TEXT #}

			{# TEXTAREA #}
			{% elseif field.type == 'textarea' %}
				<div class="form-group field-{{ field.code }}">
					<label for="{{ field.code }}">{{ field.title }}</label>
					<textarea
						class="form-control"
						name="{{ field.code }}"
						id="{{ field.code }}"
						placeholder="{{ field.placeholder }}"
						rows="7"
					></textarea>
				</div>
			{# /TEXTAREA #}

			{# SELECT #}
			{% elseif field.type == 'select' %}
				<div class="form-group field-{{ field.code }}">
					<label for="{{ field.code }}">{{ field.title }}</label>
					<select
						class="form-control"
						name="{{ field.code }}"
						id="{{ field.code }}"
					>
						<option value="">{{ field.placeholder }}</option>
						{% for option in field.options %}
							<option value="{{ option.value }}">{{ option.title }}</option>
						{% endfor %}
					</select>
				</div>
			{# /SELECT #}

			{# RECAPTCHA #}
			{% elseif field.type == 'recaptcha' %}
				<div class="form-group" class="field-recaptcha">
					<div class="g-recaptcha" data-sitekey="{{ recaptcha.site_key }}"></div>
					<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl={{ recaptcha.lang }}"></script>
				</div>
			{# /RECAPTCHA #}

			{# RADIO #}
			{% elseif field.type == 'radio' %}
				<div class="form-group" class="field-radio">
					{% for option in field.options %}
						<label class="radio-inline">
							<input type="radio"
								   name="{{ field.code }}"
								   value="{{ option.value }}"
								   id="{{ field.code ~ '_' ~ loop.index }}">
							{{ option.title }}
						</label>
					{% endfor %}
				</div>
			{# /RADIO #}

			{# CHECKBOX #}
			{% elseif field.type == 'checkbox' %}
				<div class="form-group form-check field-{{ field.code }}">
					<input
						class="form-check-input"
						type="checkbox"
						name="{{ field.code }}"
						id="{{ field.code ~ '_' ~ loop.index }}">
					<label class="form-check-label" for="{{ field.code ~ '_' ~ loop.index }}">
						{{ field.title }}
					</label>
				</div>
			{# /CHECKBOX #}

			{# MULTICHECKBOX #}
			{% elseif field.type == 'multicheckbox' %}
				<div class="form-group form-check field-{{ field.code }}">
					<label for="{{ field.code }}">{{ field.title }}</label>
					{% for option in field.options %}
						<label class="radio-inline">
							<input type="checkbox"
								   name="{{ field.code }}[]"
								   value="{{ option.value }}"
								   id="{{ field.code ~ '_' ~ loop.index }}">
							{{ option.title }}
						</label>
					{% endfor %}
				</div>
			{# /MULTICHECKBOX #}

			{# LABEL#}
            {% elseif field.type == 'label' %}
				<div class="form-group">
					<label>
                        {{ field.title }}
					</label>
				</div>
			{# /LABEL#}

			{# LABEL#}
            {% elseif field.type == 'file' %}
				<div class="form-group form-check field-{{ field.code }}">
					<input
						class="form-check-input"
						type="file"
						name="{{ field.code }}"
						id="{{ field.code ~ '_' ~ loop.index }}">
					<label class="form-check-label" for="{{ field.code ~ '_' ~ loop.index }}">
						{{ field.title }}
					</label>
				</div>
			{# /LABEL#}

			{% endif %}
		{% endfor %}

		<button type="submit" class="btn btn-primary">{{ form.submit_text }}</button>
	</form>
	<div class="callback-form-result"></div>
</div>