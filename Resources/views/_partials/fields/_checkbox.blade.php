{!! Form::checkbox(isset($language) ? 'translations['.$language->iso_code.'][value]' : 'value', 1, isset($language) ? trans_model($setting, $language, 'value') : $setting->value, $setting->getAttributesData()) !!}