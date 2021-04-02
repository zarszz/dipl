<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Update user</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.user') }}">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update user</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    <div class="col-xs-4 box"></div>
    <x-slot name="slot">
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <form class="form form-horizontal"
                            action="{{ route('admin.user.update', ['id' => $user['id']]) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <input type="hidden" value="{{ $user['id'] }}" name="id">
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" class="form-control form-control-xl" name="nama"
                                    placeholder="Nama Lengkap" value="{{ $user['nama'] }}" required>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="email" class="form-control form-control-xl" name="email"
                                    placeholder="Email" value="{{ $user['email'] }}" required>
                                <div class="form-control-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <textarea class="form-control form-control-xl" name="alamat" placeholder="Alamat"
                                    required>{{ $user['alamat'] }}</textarea>
                                <div class="form-control-icon">
                                    <i class="bi bi-house"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <div class="form-group position-relative mb-4">
                                    <p style="color: #6c757d; font-size: 22px;">Tanggal Lahir</p>
                                    <input type="text" id="datetimepicker" name="tgl_lahir"
                                        value="{{ $user['tgl_lahir'] }}" required>
                                </div>
                            </div>
                            <div class="form-group position-relative mb-4">
                                <p style="color: #6c757d; font-size: 22px;">Jenis kelamin</p>
                                <div class="form-check">
                                    @if ($user['jenis_kelamin'] == 'pria')
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="radio_pria" value="pria" checked required>
                                    @else
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="radio_pria" value="pria" required>
                                    @endif
                                    <label class="form-check-label" for="radio_pria">
                                        Pria
                                    </label>
                                </div>
                                <div class="form-check">
                                    @if ($user['jenis_kelamin'] == 'wanita')
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="radio_wanita" value="wanita" checked required>
                                    @else
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="radio_wanita" value="wanita" required>
                                    @endif
                                    <label class="form-check-label" for="radio_wanita">
                                        Wanita
                                    </label>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <p style="color: #6c757d; font-size: 22px;">Role User</p>
                                <select class="form-select" aria-label="Default select example">
                                    <option @php if ($user['role_id'] == 1) echo 'selected="selected"' @endphp value="1">ADMIN</option>
                                    <option @php if ($user['role_id'] == 2) echo 'selected="selected"' @endphp value="2">DRIVER</option>
                                    <option @php if ($user['role_id'] == 3) echo 'selected="selected"' @endphp value="3">USER</option>
                                </select>
                            </div>
                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
