@extends('admin::layouts.master')

@section('content')
    @include('admin::_partials._messages')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="{{ route('admin::setting.index') }}" class="btn btn-xs btn-primary">
                            <i class="fa fa-undo"></i> Back to list
                        </a>
                    </div>
                    <h4 class="panel-title">Edit setting - {{ $setting->name }}</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['admin::setting.update', $setting], 'method' => 'PATCH', 'files' => true]) !!}
                    <div class="form-group no-margin-hr">
                        <label>{{ $setting->name }}</label><br>
                        @include('setting::_form')
                    </div>
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Save</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
