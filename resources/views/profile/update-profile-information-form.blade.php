<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('Profile Information') }}</h4>
            <p class="card-description">Update informasi akun</p>
        </div>
        <div class="card-body">

            <x-maz-alert class="mr-3" on="saved" color='success'>
                Saved
            </x-maz-alert>
            <form action="{{ route('user.update', ['id' => auth()->user()->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" value="{{ auth()->user()->id }}" name="id">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" name="nama" placeholder="Nama Lengkap"
                        value="{{ auth()->user()->nama }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="email" class="form-control form-control-xl" name="email" placeholder="Email"
                        value="{{ auth()->user()->email }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <textarea class="form-control form-control-xl" name="alamat" placeholder="Alamat"
                        required>{{ auth()->user()->alamat }}</textarea>
                    <div class="form-control-icon">
                        <i class="bi bi-house"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <div class="form-group position-relative mb-4">
                        <p style="color: #6c757d; font-size: 22px;">Tanggal Lahir</p>
                        <input type="text" id="datetimepicker" name="tgl_lahir"
                            value="{{ auth()->user()->tgl_lahir }}" required>
                    </div>
                </div>
                <div class="form-group position-relative mb-4">
                    <p style="color: #6c757d; font-size: 22px;">Jenis kelamin</p>
                    <div class="form-check">
                        @if (auth()->user()->jenis_kelamin == 'pria')
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="radio_pria"
                                value="pria" checked required>
                        @else
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="radio_pria"
                                value="pria" required>
                        @endif
                        <label class="form-check-label" for="radio_pria">
                            Pria
                        </label>
                    </div>
                    <div class="form-check">
                        @if (auth()->user()->jenis_kelamin == 'wanita')
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="radio_wanita"
                                value="wanita" checked required>
                        @else
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="radio_wanita"
                                value="wanita" required>
                        @endif
                        <label class="form-check-label" for="radio_wanita">
                            Wanita
                        </label>
                    </div>
                </div>
                <button class="btn btn-primary float-end mt-2" wire:loading.attr="disabled"
                    wire:target="photo">Simpan</button>
            </form>
        </div>
    </div>
</section>
