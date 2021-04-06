<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Update Ruangan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.ruangan') }}">Ruangan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Ruangan</li>
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
                            action="{{ route('admin.ruangans.update', ['id' => $ruangan['id']]) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <input type="hidden" value="{{ $ruangan['id'] }}" name="id">
                            <div class="form-group position-relative mb-4">
                                <input type="text" class="form-control form-control-xl" name="nama_ruangan"
                                    placeholder="Nama Ruangan" value="{{ $ruangan['nama_ruangan'] }}" required>
                            </div>
                            <div class="form-group position-relative mb-4">
                                <p style="color: #6c757d; font-size: 22px;">Pilih Gudang</p>
                                <select class="form-select" name="kode_gudang" id="ddlRuanganGudang" onchange="setKodeGudang();">
                                    @foreach ($gudangs as $gudang)
                                        @if ($gudang['id'] == $ruangan['kode_gudang'])
                                            <option selected value="{{ $gudang->id }}">{{ $gudang->nama_gudang }}</option>
                                        @else
                                            <option selected value="{{ $gudang->id }}">{{ $gudang->nama_gudang }}</option>
                                        @endif
                                    @endforeach
                                  </select>
                            </div>
                            <div class="form-group position-relative">
                                <p style="color: #6c757d; font-size: 22px;">Kode Ruangan</p>
                                <input type="text" class="form-control form-control-xl" name="kode_ruangan"
                                id="input_kode_ruangan" placeholder="Kode Ruangan" value="{{ $ruangan['kode_ruangan'] }}" required>
                                    <small id="kodeRuanganHelper" class="form-text text-muted">Kode Ruangan saat ini : {{ $ruangan['kode_ruangan'] }} </small>
                            </div>
                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
