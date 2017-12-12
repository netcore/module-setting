@if ($setting->is_translatable)
    @include('translate::_partials._nav_tabs')

    <!-- Tab panes -->
    <div class="tab-content">
        @foreach(\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language)
            <div role="tabpanel" class="tab-pane {{ $loop->first ? 'active' : '' }}"
                 id="{{ $language->iso_code }}">

                @if($mediaModule && $mediaModule->enabled() && $setting->has_manager)
                    <div class="row">
                        <div class="col-md-10">
                            {!! Form::text('translations['.$language->iso_code.'][value]', trans_model($setting, $language, 'value'), $setting->getAttributesData()) !!}
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-block js-file-manager">
                                <i class="fa fa-folder"></i> Select from storage
                            </button>
                        </div>
                    </div>
                @else
                    <div class="form-group no-margin-hr">
                        @include('setting::_partials.fields._' . $setting->type)
                    </div>
                @endif

            </div>
        @endforeach
    </div>
@else
    @if($mediaModule && $mediaModule->enabled() && $setting->has_manager)
        <div class="row">
            <div class="col-md-10">
                {!! Form::text(isset($language) ? 'translations['.$language->iso_code.'][value]' : 'value', $setting->value, $setting->getAttributesData()) !!}
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary btn-block js-file-manager">
                    <i class="fa fa-folder"></i> Select from storage
                </button>
            </div>
        </div>
    @else
        <div class="form-group no-margin-hr">
            @include('setting::_partials.fields._' . $setting->type)
        </div>
    @endif
@endif
