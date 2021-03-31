@extends('layouts.app')

@section('title', __('gudang.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Gudang)
            <a href="{{ route('gudangs.index', ['action' => 'create']) }}" class="btn btn-success">{{ __('gudang.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('gudang.list') }} <small>{{ __('app.total') }} : {{ $gudangs->total() }} {{ __('gudang.gudang') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('gudang.search') }}</label>
                        <input placeholder="{{ __('gudang.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('gudang.search') }}" class="btn btn-secondary">
                    <a href="{{ route('gudangs.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('gudang.title') }}</th>
                        <th>{{ __('gudang.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gudangs as $key => $gudang)
                    <tr>
                        <td class="text-center">{{ $gudangs->firstItem() + $key }}</td>
                        <td>{{ $gudang->title }}</td>
                        <td>{{ $gudang->description }}</td>
                        <td class="text-center">
                            @can('update', $gudang)
                                <a href="{{ route('gudangs.index', ['action' => 'edit', 'id' => $gudang->id] + Request::only('page', 'q')) }}" id="edit-gudang-{{ $gudang->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $gudangs->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
        @include('gudangs.forms')
        @endif
    </div>
</div>
@endsection
