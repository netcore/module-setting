@if ($setting->type == 'checkbox')
    {!! Form::checkbox('value', 1, $setting->value, $setting->getAttributesData()) !!}
@elseif ($setting->type == 'select')
    {!! Form::select('value', $setting->getOptionsData(), $setting->value, $setting->getAttributesData()) !!}
@elseif ($setting->type == 'file')
    {!! Form::file('value', $setting->getAttributesData()) !!}
@else
    @if($mediaModule && $mediaModule->enabled() && $setting->has_manager)
        <div class="row">
            <div class="col-md-10">
                {!! Form::text('value', $setting->value, $setting->getAttributesData()) !!}
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary btn-block js-file-manager">
                    <i class="fa fa-folder"></i> Select from storage
                </button>
            </div>
        </div>
    @else
        {!! Form::{$setting->type}('value', $setting->value, $setting->getAttributesData()) !!}
    @endif
@endif
