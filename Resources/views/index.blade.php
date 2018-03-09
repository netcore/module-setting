@extends('admin::layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Settings</h4>
                </div>
                <div class="panel-body">
                    @include('admin::_partials._messages')
                    @if (setting()->grouped()->count())
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach (setting()->grouped() as $group => $settings)
                                <li role="presentation" class="{{ $loop->first ? 'active' : '' }}">
                                    <a href="#{{ $group }}" aria-controls="global" role="tab"
                                       data-toggle="tab">{{ ucfirst(preg_replace('/-+/', ' ', $group)) }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach (setting()->grouped() as $group => $settings)
                                <div role="tabpanel" class="tab-pane {{ $loop->first ? 'active' : '' }}"
                                     id="{{ $group }}">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Key</th>
                                            <th>Name</th>
                                            <th class="text-center">Value/Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($settings as $setting)
                                            <tr>
                                                <td width="30%">{{ $setting->key }}</td>
                                                <td>{{ $setting->name }}</td>
                                                <td>
                                                    @if($setting->is('checkbox'))
                                                        <a href="#" id="{{ $setting->key }}" data-type="select"
                                                           data-url="{{ route('admin::setting.update', $setting->id) }}"
                                                           data-pk="{{ $setting->id }}"
                                                           data-source="[{value: 0, text: 'No'}, {value: 1, text: 'Yes'}]"
                                                           data-title="Select value"
                                                           class="x-edit editable editable-click">{{ $setting->value ? 'Yes' : 'No' }}</a>
                                                    @elseif ($setting->is('select'))
                                                        <a href="#" id="{{ $setting->key }}" data-type="select"
                                                           data-url="{{ route('admin::setting.update', $setting->id) }}"
                                                           data-pk="{{ $setting->id }}"
                                                           data-source="{{ json_encode($setting->getOptionsData()) }}"
                                                           data-title="Select value"
                                                           data-value="{{ $setting->value }}"
                                                           class="x-edit editable editable-click">{{ array_get($setting->getOptionsData(), $setting->value) }}</a>
                                                    @elseif ($setting->is('file'))
                                                        <a href="{{ route('admin::setting.edit', $setting) }}"
                                                           class="btn btn-xs btn-primary">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                    @elseif ($setting->has_manager)
                                                        <a href="{{ route('admin::setting.edit', $setting) }}"
                                                           class="btn btn-xs btn-primary">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                    @else
                                                        @if ($setting->is_translatable)
                                                            @php
                                                                $translations = $setting->translations->pluck('value', 'locale')->toArray();
                                                            @endphp
                                                            @foreach(\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language)
                                                                <b>{{ strtoupper($language->iso_code) }}</b>:
                                                                <a
                                                                        href="#" id="{{ $setting->key }}"
                                                                        data-type="{{ $setting->type }}"
                                                                        data-url="{{ route('admin::setting.update', [$setting->id, $language]) }}"
                                                                        data-pk="{{ $setting->id }}"
                                                                        data-title="Enter value"
                                                                        class="x-edit editable editable-click">{{ isset($translations[$language->iso_code]) ? str_limit($translations[$language->iso_code], 100) : 'Not specified' }}</a>
                                                                <br>
                                                            @endforeach
                                                        @else
                                                            <a href="#" id="{{ $setting->key }}"
                                                               data-type="{{ $setting->type }}"
                                                               data-url="{{ route('admin::setting.update', $setting->id) }}"
                                                               data-pk="{{ $setting->id }}" data-title="Enter value"
                                                               class="x-edit editable editable-click"
                                                               data-tpl="@include('setting::_partials.templates._' . $setting->type)"
                                                            >{{ str_limit($setting->value, 100) }}</a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">No settings!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        $.fn.editable.defaults.ajaxOptions = {
            type: 'PATCH'
        };

        $(document).ready(function () {
            $('.x-edit').editable();
        });

    </script>
@endsection
