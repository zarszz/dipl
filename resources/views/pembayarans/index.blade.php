@extends('layouts.app')

@section('title', __('pembayaran.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Pembayaran)
            <a href="{{ route('pembayarans.index', ['action' => 'create']) }}" class="btn btn-success">{{ __('pembayaran.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('pembayaran.list') }} <small>{{ __('app.total') }} : {{ $pembayarans->total() }} {{ __('pembayaran.pembayaran') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('pembayaran.search') }}</label>
                        <input placeholder="{{ __('pembayaran.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('pembayaran.search') }}" class="btn btn-secondary">
                    <a href="{{ route('pembayarans.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('pembayaran.title') }}</th>
                        <th>{{ __('pembayaran.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayarans as $key => $pembayaran)
                    <tr>
                        <td class="text-center">{{ $pembayarans->firstItem() + $key }}</td>
                        <td>{{ $pembayaran->title }}</td>
                        <td>{{ $pembayaran->description }}</td>
                        <td class="text-center">
                            @can('update', $pembayaran)
                                <a href="{{ route('pembayarans.index', ['action' => 'edit', 'id' => $pembayaran->id] + Request::only('page', 'q')) }}" id="edit-pembayaran-{{ $pembayaran->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $pembayarans->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
        @include('pembayarans.forms')
        @endif
    </div>
</div>
@endsection
