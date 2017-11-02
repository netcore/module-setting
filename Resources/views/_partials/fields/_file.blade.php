{!! Form::file(isset($language) ? 'translations['.$language->iso_code.'][value]' : 'value', null, $setting->getAttributesData()) !!}
