@if (Request::get('action') == 'create')
@can('create', new App\Models\Pembayaran)
    <form method="POST" action="{{ route('pembayarans.store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('pembayaran.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('pembayaran.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input type="submit" value="{{ __('pembayaran.create') }}" class="btn btn-success">
        <a href="{{ route('pembayarans.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
    </form>
@endcan
@endif
@if (Request::get('action') == 'edit' && $editablePembayaran)
@can('update', $editablePembayaran)
    <form method="POST" action="{{ route('pembayarans.update', $editablePembayaran) }}" accept-charset="UTF-8">
        {{ csrf_field() }} {{ method_field('patch') }}
        <div class="form-group">
            <label for="title" class="form-label">{{ __('pembayaran.title') }} <span class="form-required">*</span></label>
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $editablePembayaran->title) }}" required>
            {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('pembayaran.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $editablePembayaran->description) }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input name="page" value="{{ request('page') }}" type="hidden">
        <input name="q" value="{{ request('q') }}" type="hidden">
        <input type="submit" value="{{ __('pembayaran.update') }}" class="btn btn-success">
        <a href="{{ route('pembayarans.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        @can('delete', $editablePembayaran)
            <a href="{{ route('pembayarans.index', ['action' => 'delete', 'id' => $editablePembayaran->id] + Request::only('page', 'q')) }}" id="del-pembayaran-{{ $editablePembayaran->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
        @endcan
    </form>
@endcan
@endif
@if (Request::get('action') == 'delete' && $editablePembayaran)
@can('delete', $editablePembayaran)
    <div class="card">
        <div class="card-header">{{ __('pembayaran.delete') }}</div>
        <div class="card-body">
            <label class="form-label text-primary">{{ __('pembayaran.title') }}</label>
            <p>{{ $editablePembayaran->title }}</p>
            <label class="form-label text-primary">{{ __('pembayaran.description') }}</label>
            <p>{{ $editablePembayaran->description }}</p>
            {!! $errors->first('pembayaran_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <hr style="margin:0">
        <div class="card-body text-danger">{{ __('pembayaran.delete_confirm') }}</div>
        <div class="card-footer">
            <form method="POST" action="{{ route('pembayarans.destroy', $editablePembayaran) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                {{ csrf_field() }} {{ method_field('delete') }}
                <input name="pembayaran_id" type="hidden" value="{{ $editablePembayaran->id }}">
                <input name="page" value="{{ request('page') }}" type="hidden">
                <input name="q" value="{{ request('q') }}" type="hidden">
                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
            </form>
            <a href="{{ route('pembayarans.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        </div>
    </div>
@endcan
@endif
