@extends('layouts.app')

@section('title', __('role.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Role)
            <a href="{{ route('roles.index', ['action' => 'create']) }}" class="btn btn-success">{{ __('role.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('role.list') }} <small>{{ __('app.total') }} : {{ $roles->total() }} {{ __('role.role') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('role.search') }}</label>
                        <input placeholder="{{ __('role.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('role.search') }}" class="btn btn-secondary">
                    <a href="{{ route('roles.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('role.title') }}</th>
                        <th>{{ __('role.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $key => $role)
                    <tr>
                        <td class="text-center">{{ $roles->firstItem() + $key }}</td>
                        <td>{{ $role->title }}</td>
                        <td>{{ $role->description }}</td>
                        <td class="text-center">
                            @can('update', $role)
                                <a href="{{ route('roles.index', ['action' => 'edit', 'id' => $role->id] + Request::only('page', 'q')) }}" id="edit-role-{{ $role->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $roles->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
        @include('roles.forms')
        @endif
    </div>
</div>
@endsection
