@extends('layouts.app')

@section('title', __('audit_log.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\AuditLog)
            <a href="{{ route('audit_logs.index', ['action' => 'create']) }}" class="btn btn-success">{{ __('audit_log.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('audit_log.list') }} <small>{{ __('app.total') }} : {{ $auditLogs->total() }} {{ __('audit_log.audit_log') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('audit_log.search') }}</label>
                        <input placeholder="{{ __('audit_log.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('audit_log.search') }}" class="btn btn-secondary">
                    <a href="{{ route('audit_logs.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('audit_log.title') }}</th>
                        <th>{{ __('audit_log.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auditLogs as $key => $auditLog)
                    <tr>
                        <td class="text-center">{{ $auditLogs->firstItem() + $key }}</td>
                        <td>{{ $auditLog->title }}</td>
                        <td>{{ $auditLog->description }}</td>
                        <td class="text-center">
                            @can('update', $auditLog)
                                <a href="{{ route('audit_logs.index', ['action' => 'edit', 'id' => $auditLog->id] + Request::only('page', 'q')) }}" id="edit-audit_log-{{ $auditLog->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $auditLogs->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
        @include('audit_logs.forms')
        @endif
    </div>
</div>
@endsection
