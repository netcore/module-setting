@extends('admin::layouts.master')

@section('content')
    @include('admin::_partials._messages')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Edit setting</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['admin::setting.update', $setting], 'method' => 'PATCH', 'files' => true]) !!}
                    <div class="form-group no-margin-hr">
                        <label>{{ $setting->name }}</label><br>
                        @if ($setting->type == 'checkbox')
                            {!! Form::checkbox('value', 1, $setting->value, $setting->getAttributesData()) !!}
                        @elseif ($setting->type == 'select')
                            {!! Form::select('value', $setting->getOptionsData(), $setting->value, $setting->getAttributesData()) !!}
                        @elseif ($setting->type == 'file')
                            {!! Form::file('value', $setting->getAttributesData()) !!}
                        @else
                            @if($mediaModule && $mediaModule->enabled() && $setting->group == 'url')
                                <div class="row">
                                    <div class="col-md-10">
                                        {!! Form::{$setting->type}('value', $setting->value, $setting->getAttributesData()) !!}
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary js-file-manager" disabled>Select from storage</button>
                                    </div>
                                </div>
                            @else
                                {!! Form::{$setting->type}('value', $setting->value, $setting->getAttributesData()) !!}
                            @endif
                        @endif
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    <a href="{{ route('admin::setting.index') }}" class="btn btn-default pull-right"><i class="fa fa-undo"></i> Back</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection