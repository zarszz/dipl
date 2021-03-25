@if (Request::get('action') == 'create')
@can('create', new App\Models\Barang)
    <form method="POST" action="{{ route('barangs.store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('barang.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('barang.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input type="submit" value="{{ __('barang.create') }}" class="btn btn-success">
        <a href="{{ route('barangs.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
    </form>
@endcan
@endif
@if (Request::get('action') == 'edit' && $editableBarang)
@can('update', $editableBarang)
    <form method="POST" action="{{ route('barangs.update', $editableBarang) }}" accept-charset="UTF-8">
        {{ csrf_field() }} {{ method_field('patch') }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('barang.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $editableBarang->title) }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('barang.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $editableBarang->description) }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input name="page" value="{{ request('page') }}" type="hidden">
        <input name="q" value="{{ request('q') }}" type="hidden">
        <input type="submit" value="{{ __('barang.update') }}" class="btn btn-success">
        <a href="{{ route('barangs.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        @can('delete', $editableBarang)
            <a href="{{ route('barangs.index', ['action' => 'delete', 'id' => $editableBarang->id] + Request::only('page', 'q')) }}" id="del-barang-{{ $editableBarang->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
        @endcan
    </form>
@endcan
@endif
@if (Request::get('action') == 'delete' && $editableBarang)
@can('delete', $editableBarang)
    <div class="card">
        <div class="card-header">{{ __('barang.delete') }}</div>
        <div class="card-body">
            <label class="form-label text-primary">{{ __('barang.title') }}</label>
            <p>{{ $editableBarang->title }}</p>
            <label class="form-label text-primary">{{ __('barang.description') }}</label>
            <p>{{ $editableBarang->description }}</p>
            {!! $errors->first('barang_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <hr style="margin:0">
        <div class="card-body text-danger">{{ __('barang.delete_confirm') }}</div>
        <div class="card-footer">
            <form method="POST" action="{{ route('barangs.destroy', $editableBarang) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                {{ csrf_field() }} {{ method_field('delete') }}
                <input name="barang_id" type="hidden" value="{{ $editableBarang->id }}">
                <input name="page" value="{{ request('page') }}" type="hidden">
                <input name="q" value="{{ request('q') }}" type="hidden">
                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
            </form>
            <a href="{{ route('barangs.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        </div>
    </div>
@endcan
@endif
