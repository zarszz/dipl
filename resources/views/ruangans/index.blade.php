@extends('layouts.app')

@section('title', __('ruangan.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Ruangan)
            <a href="{{ route('ruangans.index', ['action' => 'create']) }}" class="btn btn-success">{{ __('ruangan.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('ruangan.list') }} <small>{{ __('app.total') }} : {{ $ruangans->total() }} {{ __('ruangan.ruangan') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('ruangan.search') }}</label>
                        <input placeholder="{{ __('ruangan.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('ruangan.search') }}" class="btn btn-secondary">
                    <a href="{{ route('ruangans.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('ruangan.title') }}</th>
                        <th>{{ __('ruangan.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ruangans as $key => $ruangan)
                    <tr>
                        <td class="text-center">{{ $ruangans->firstItem() + $key }}</td>
                        <td>{{ $ruangan->title }}</td>
                        <td>{{ $ruangan->description }}</td>
                        <td class="text-center">
                            @can('update', $ruangan)
                                <a href="{{ route('ruangans.index', ['action' => 'edit', 'id' => $ruangan->id] + Request::only('page', 'q')) }}" id="edit-ruangan-{{ $ruangan->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $ruangans->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
        @include('ruangans.forms')
        @endif
    </div>
</div>
@endsection
