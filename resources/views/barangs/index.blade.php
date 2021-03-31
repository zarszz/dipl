@extends('layouts.app')

@section('title', __('barang.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Barang)
            <a href="{{ route('barangs.index', ['action' => 'create']) }}" class="btn btn-success">{{ __('barang.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('barang.list') }} <small>{{ __('app.total') }} : {{ $barangs->total() }} {{ __('barang.barang') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('barang.search') }}</label>
                        <input placeholder="{{ __('barang.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('barang.search') }}" class="btn btn-secondary">
                    <a href="{{ route('barangs.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('barang.title') }}</th>
                        <th>{{ __('barang.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $key => $barang)
                    <tr>
                        <td class="text-center">{{ $barangs->firstItem() + $key }}</td>
                        <td>{{ $barang->title }}</td>
                        <td>{{ $barang->description }}</td>
                        <td class="text-center">
                            @can('update', $barang)
                                <a href="{{ route('barangs.index', ['action' => 'edit', 'id' => $barang->id] + Request::only('page', 'q')) }}" id="edit-barang-{{ $barang->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $barangs->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
        @include('barangs.forms')
        @endif
    </div>
</div>
@endsection
