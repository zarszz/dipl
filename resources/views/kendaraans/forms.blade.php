@if (Request::get('action') == 'create')
@can('create', new App\Models\Kendaraan)
    <form method="POST" action="{{ route('kendaraans.store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('kendaraan.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('kendaraan.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input type="submit" value="{{ __('kendaraan.create') }}" class="btn btn-success">
        <a href="{{ route('kendaraans.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
    </form>
@endcan
@endif
@if (Request::get('action') == 'edit' && $editableKendaraan)
@can('update', $editableKendaraan)
    <form method="POST" action="{{ route('kendaraans.update', $editableKendaraan) }}" accept-charset="UTF-8">
        {{ csrf_field() }} {{ method_field('patch') }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('kendaraan.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $editableKendaraan->title) }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('kendaraan.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $editableKendaraan->description) }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input name="page" value="{{ request('page') }}" type="hidden">
        <input name="q" value="{{ request('q') }}" type="hidden">
        <input type="submit" value="{{ __('kendaraan.update') }}" class="btn btn-success">
        <a href="{{ route('kendaraans.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        @can('delete', $editableKendaraan)
            <a href="{{ route('kendaraans.index', ['action' => 'delete', 'id' => $editableKendaraan->id] + Request::only('page', 'q')) }}" id="del-kendaraan-{{ $editableKendaraan->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
        @endcan
    </form>
@endcan
@endif
@if (Request::get('action') == 'delete' && $editableKendaraan)
@can('delete', $editableKendaraan)
    <div class="card">
        <div class="card-header">{{ __('kendaraan.delete') }}</div>
        <div class="card-body">
            <label class="form-label text-primary">{{ __('kendaraan.title') }}</label>
            <p>{{ $editableKendaraan->title }}</p>
            <label class="form-label text-primary">{{ __('kendaraan.description') }}</label>
            <p>{{ $editableKendaraan->description }}</p>
            {!! $errors->first('kendaraan_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <hr style="margin:0">
        <div class="card-body text-danger">{{ __('kendaraan.delete_confirm') }}</div>
        <div class="card-footer">
            <form method="POST" action="{{ route('kendaraans.destroy', $editableKendaraan) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                {{ csrf_field() }} {{ method_field('delete') }}
                <input name="kendaraan_id" type="hidden" value="{{ $editableKendaraan->id }}">
                <input name="page" value="{{ request('page') }}" type="hidden">
                <input name="q" value="{{ request('q') }}" type="hidden">
                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
            </form>
            <a href="{{ route('kendaraans.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        </div>
    </div>
@endcan
@endif
