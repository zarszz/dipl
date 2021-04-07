<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambahkan barang</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.barang') }}">Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambahkan barang</li>
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
                        <form class="form form-horizontal" action="{{ route('admin.barangs.store') }}" method="POST">
                            @csrf
                            <div class="form-group position-relative">
                                <p style="color: #6c757d; font-size: 22px;">Nama Barang</p>
                                <input type="text" class="form-control form-control-xl" name="nama_brg"
                                    placeholder="masukkan nama barang" required>
                            </div>
                            <div class="form-group position-relative mb-4">
                                <p style="color: #6c757d; font-size: 22px;">Kategori</p>
                                <select class="form-select" name="kode_kategori"">
                                    @foreach ($kategories as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                    @endforeach
                                  </select>
                            </div>
                            <div class="form-group position-relative">
                                <p style="color: #6c757d; font-size: 22px;">Jumlah Barang</p>
                                <input type="text" class="form-control form-control-xl" name="jumlah_brg"
                                    placeholder="masukkan jumlah barang" required>
                            </div>
                            <div class="form-group position-relative mb-4">
                                <p style="color: #6c757d; font-size: 22px;">Pilih Gudang</p>
                                <select class="form-select" name="kode_gudang" id="ddlSelectGudang" onchange="setDaftarRuangan();">
                                    @foreach ($gudangs as $gudang)
                                        <option value="{{ $gudang->id }}">{{ $gudang->nama_gudang }}</option>
                                    @endforeach
                                  </select>
                            </div>
                            <div class="form-group position-relative mb-4">
                                <p style="color: #6c757d; font-size: 22px;">Pilih Ruangan</p>
                                <select class="form-select" name="kode_ruangan" id="ddlSelectRuangan"">
                                </select>
                            </div>
                            <div class="form-group position-relative mb-4">
                                <p style="color: #6c757d; font-size: 22px;">Kode Kendaraan</p>
                                <select class="form-select" name="kode_kendaraan" id="ddlSelectKendaraan">
                                        <option value="null">Tidak Menggunakan kendaraan</option>
                                    @forelse ($kendaraans as $kendaraan)
                                        <option value="{{ $kendaraan->id }}" name="kode_kendaraan">{{ $kendaraan->plat_nomor }}</option>
                                    @empty
                                        <option value="-">Tidak ada kendaraan tersedia</option>
                                    @endforelse
                                  </select>
                            </div>
                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Daftar</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
