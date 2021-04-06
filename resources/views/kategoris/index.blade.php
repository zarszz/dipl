@extends('layouts.app')

@section('title', __('kategori.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Kategori)
            <a href="{{ route('kategoris.index', ['action' => 'create']) }}" class="btn btn-success">{{ __('kategori.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('kategori.list') }} <small>{{ __('app.total') }} : {{ 12 }} {{ __('kategori.kategori') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('kategori.search') }}</label>
                        <input placeholder="{{ __('kategori.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('kategori.search') }}" class="btn btn-secondary">
                    <a href="{{ route('kategoris.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('kategori.title') }}</th>
                        <th>{{ __('kategori.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoris as $key => $kategori)
                    <tr>
                        <td class="text-center">{{ $kategori->created_at }}</td>
                        <td>{{ $kategori->title }}</td>
                        <td>{{ $kategori->description }}</td>
                        <td class="text-center">
                            @can('update', $kategori)
                                <a href="{{ route('kategoris.index', ['action' => 'edit', 'id' => $kategori->id] + Request::only('page', 'q')) }}" id="edit-kategori-{{ $kategori->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ 12  }}</div>
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
        @include('kategoris.forms')
        @endif
    </div>
</div>
@endsection
