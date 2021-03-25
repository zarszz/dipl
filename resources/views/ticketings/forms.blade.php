@if (Request::get('action') == 'create')
@can('create', new App\Models\Ticketing)
    <form method="POST" action="{{ route('ticketings.store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('ticketing.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('ticketing.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input type="submit" value="{{ __('ticketing.create') }}" class="btn btn-success">
        <a href="{{ route('ticketings.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
    </form>
@endcan
@endif
@if (Request::get('action') == 'edit' && $editableTicketing)
@can('update', $editableTicketing)
    <form method="POST" action="{{ route('ticketings.update', $editableTicketing) }}" accept-charset="UTF-8">
        {{ csrf_field() }} {{ method_field('patch') }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('ticketing.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $editableTicketing->title) }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('ticketing.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $editableTicketing->description) }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input name="page" value="{{ request('page') }}" type="hidden">
        <input name="q" value="{{ request('q') }}" type="hidden">
        <input type="submit" value="{{ __('ticketing.update') }}" class="btn btn-success">
        <a href="{{ route('ticketings.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        @can('delete', $editableTicketing)
            <a href="{{ route('ticketings.index', ['action' => 'delete', 'id' => $editableTicketing->id] + Request::only('page', 'q')) }}" id="del-ticketing-{{ $editableTicketing->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
        @endcan
    </form>
@endcan
@endif
@if (Request::get('action') == 'delete' && $editableTicketing)
@can('delete', $editableTicketing)
    <div class="card">
        <div class="card-header">{{ __('ticketing.delete') }}</div>
        <div class="card-body">
            <label class="form-label text-primary">{{ __('ticketing.title') }}</label>
            <p>{{ $editableTicketing->title }}</p>
            <label class="form-label text-primary">{{ __('ticketing.description') }}</label>
            <p>{{ $editableTicketing->description }}</p>
            {!! $errors->first('ticketing_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <hr style="margin:0">
        <div class="card-body text-danger">{{ __('ticketing.delete_confirm') }}</div>
        <div class="card-footer">
            <form method="POST" action="{{ route('ticketings.destroy', $editableTicketing) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                {{ csrf_field() }} {{ method_field('delete') }}
                <input name="ticketing_id" type="hidden" value="{{ $editableTicketing->id }}">
                <input name="page" value="{{ request('page') }}" type="hidden">
                <input name="q" value="{{ request('q') }}" type="hidden">
                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
            </form>
            <a href="{{ route('ticketings.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        </div>
    </div>
@endcan
@endif
