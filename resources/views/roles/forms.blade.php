@if (Request::get('action') == 'create')
@can('create', new App\Models\Role)
    <form method="POST" action="{{ route('roles.store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('role.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('role.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input type="submit" value="{{ __('role.create') }}" class="btn btn-success">
        <a href="{{ route('roles.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
    </form>
@endcan
@endif
@if (Request::get('action') == 'edit' && $editableRole)
@can('update', $editableRole)
    <form method="POST" action="{{ route('roles.update', $editableRole) }}" accept-charset="UTF-8">
        {{ csrf_field() }} {{ method_field('patch') }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('role.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $editableRole->title) }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('role.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $editableRole->description) }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input name="page" value="{{ request('page') }}" type="hidden">
        <input name="q" value="{{ request('q') }}" type="hidden">
        <input type="submit" value="{{ __('role.update') }}" class="btn btn-success">
        <a href="{{ route('roles.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        @can('delete', $editableRole)
            <a href="{{ route('roles.index', ['action' => 'delete', 'id' => $editableRole->id] + Request::only('page', 'q')) }}" id="del-role-{{ $editableRole->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
        @endcan
    </form>
@endcan
@endif
@if (Request::get('action') == 'delete' && $editableRole)
@can('delete', $editableRole)
    <div class="card">
        <div class="card-header">{{ __('role.delete') }}</div>
        <div class="card-body">
            <label class="form-label text-primary">{{ __('role.title') }}</label>
            <p>{{ $editableRole->title }}</p>
            <label class="form-label text-primary">{{ __('role.description') }}</label>
            <p>{{ $editableRole->description }}</p>
            {!! $errors->first('role_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <hr style="margin:0">
        <div class="card-body text-danger">{{ __('role.delete_confirm') }}</div>
        <div class="card-footer">
            <form method="POST" action="{{ route('roles.destroy', $editableRole) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                {{ csrf_field() }} {{ method_field('delete') }}
                <input name="role_id" type="hidden" value="{{ $editableRole->id }}">
                <input name="page" value="{{ request('page') }}" type="hidden">
                <input name="q" value="{{ request('q') }}" type="hidden">
                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
            </form>
            <a href="{{ route('roles.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        </div>
    </div>
@endcan
@endif
