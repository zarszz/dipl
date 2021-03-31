@extends('layouts.app')

@section('title', __('ticketing.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Ticketing)
            <a href="{{ route('ticketings.index', ['action' => 'create']) }}" class="btn btn-success">{{ __('ticketing.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('ticketing.list') }} <small>{{ __('app.total') }} : {{ $ticketings->total() }} {{ __('ticketing.ticketing') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('ticketing.search') }}</label>
                        <input placeholder="{{ __('ticketing.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('ticketing.search') }}" class="btn btn-secondary">
                    <a href="{{ route('ticketings.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('ticketing.title') }}</th>
                        <th>{{ __('ticketing.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ticketings as $key => $ticketing)
                    <tr>
                        <td class="text-center">{{ $ticketings->firstItem() + $key }}</td>
                        <td>{{ $ticketing->title }}</td>
                        <td>{{ $ticketing->description }}</td>
                        <td class="text-center">
                            @can('update', $ticketing)
                                <a href="{{ route('ticketings.index', ['action' => 'edit', 'id' => $ticketing->id] + Request::only('page', 'q')) }}" id="edit-ticketing-{{ $ticketing->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $ticketings->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
        @include('ticketings.forms')
        @endif
    </div>
</div>
@endsection
