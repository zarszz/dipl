@extends('layouts.app')

@section('title', __('kendaraan.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Kendaraan)
            <a href="{{ route('kendaraans.index', ['action' => 'create']) }}" class="btn btn-success">{{ __('kendaraan.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('kendaraan.list') }} <small>{{ __('app.total') }} : {{ $kendaraans->total() }} {{ __('kendaraan.kendaraan') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('kendaraan.search') }}</label>
                        <input placeholder="{{ __('kendaraan.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('kendaraan.search') }}" class="btn btn-secondary">
                    <a href="{{ route('kendaraans.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('kendaraan.title') }}</th>
                        <th>{{ __('kendaraan.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kendaraans as $key => $kendaraan)
                    <tr>
                        <td class="text-center">{{ $kendaraans->firstItem() + $key }}</td>
                        <td>{{ $kendaraan->title }}</td>
                        <td>{{ $kendaraan->description }}</td>
                        <td class="text-center">
                            @can('update', $kendaraan)
                                <a href="{{ route('kendaraans.index', ['action' => 'edit', 'id' => $kendaraan->id] + Request::only('page', 'q')) }}" id="edit-kendaraan-{{ $kendaraan->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $kendaraans->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
        @include('kendaraans.forms')
        @endif
    </div>
</div>
@endsection
