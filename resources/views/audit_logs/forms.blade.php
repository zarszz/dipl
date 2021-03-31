@if (Request::get('action') == 'create')
@can('create', new App\Models\AuditLog)
    <form method="POST" action="{{ route('audit_logs.store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('audit_log.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('audit_log.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input type="submit" value="{{ __('audit_log.create') }}" class="btn btn-success">
        <a href="{{ route('audit_logs.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
    </form>
@endcan
@endif
@if (Request::get('action') == 'edit' && $editableAuditLog)
@can('update', $editableAuditLog)
    <form method="POST" action="{{ route('audit_logs.update', $editableAuditLog) }}" accept-charset="UTF-8">
        {{ csrf_field() }} {{ method_field('patch') }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('audit_log.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $editableAuditLog->title) }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('audit_log.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $editableAuditLog->description) }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input name="page" value="{{ request('page') }}" type="hidden">
        <input name="q" value="{{ request('q') }}" type="hidden">
        <input type="submit" value="{{ __('audit_log.update') }}" class="btn btn-success">
        <a href="{{ route('audit_logs.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        @can('delete', $editableAuditLog)
            <a href="{{ route('audit_logs.index', ['action' => 'delete', 'id' => $editableAuditLog->id] + Request::only('page', 'q')) }}" id="del-audit_log-{{ $editableAuditLog->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
        @endcan
    </form>
@endcan
@endif
@if (Request::get('action') == 'delete' && $editableAuditLog)
@can('delete', $editableAuditLog)
    <div class="card">
        <div class="card-header">{{ __('audit_log.delete') }}</div>
        <div class="card-body">
            <label class="form-label text-primary">{{ __('audit_log.title') }}</label>
            <p>{{ $editableAuditLog->title }}</p>
            <label class="form-label text-primary">{{ __('audit_log.description') }}</label>
            <p>{{ $editableAuditLog->description }}</p>
            {!! $errors->first('audit_log_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <hr style="margin:0">
        <div class="card-body text-danger">{{ __('audit_log.delete_confirm') }}</div>
        <div class="card-footer">
            <form method="POST" action="{{ route('audit_logs.destroy', $editableAuditLog) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                {{ csrf_field() }} {{ method_field('delete') }}
                <input name="audit_log_id" type="hidden" value="{{ $editableAuditLog->id }}">
                <input name="page" value="{{ request('page') }}" type="hidden">
                <input name="q" value="{{ request('q') }}" type="hidden">
                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
            </form>
            <a href="{{ route('audit_logs.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        </div>
    </div>
@endcan
@endif
