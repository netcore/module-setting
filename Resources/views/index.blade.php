@extends('admin::layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Settings</h4>
                </div>
                <div class="panel-body">
                    @if (setting()->grouped()->count())
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach (setting()->grouped() as $group => $settings)
                                <li role="presentation" class="{{ $loop->first ? 'active' : '' }}">
                                    <a href="#{{ $group }}" aria-controls="global" role="tab" data-toggle="tab">{{ ucfirst($group) }}</a>
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
                                            <th>Value</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($settings as $setting)
                                            <tr>
                                                <td width="30%">{{ $setting['key'] }}</td>
                                                <td>{{ $setting['name'] }}</td>
                                                <td>
                                                    {{ $setting['value'] }}
                                                </td>
                                                <td width="10%" class="text-center">
                                                    <a href="{{ route('admin::setting.edit', $setting['id']) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
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
