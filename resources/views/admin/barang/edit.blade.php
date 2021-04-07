<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Update barang</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.barang') }}">Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update barang</li>
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
                            action="{{ route('admin.barangs.update', ['id' => $barang->id]) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <input type="hidden" value="{{ $barang->id }}" name="id">
                            <input type="hidden" value="{{ $barang->user_id }}" name="user_id">
                            <div class="form-group position-relative">
                                <p style="color: #6c757d; font-size: 22px;">Nama Barang</p>
                                <input type="text" class="form-control form-control-xl" name="nama_brg"
                                    placeholder="masukkan nama barang" value="{{ $barang->nama_brg }}" required>
                            </div>
                            <div class="form-group position-relative mb-4">
                                <p style="color: #6c757d; font-size: 22px;">Kategori</p>
                                <select class="form-select" name="kode_kategori"">
                                           @foreach ($kategories as $kategori)
                                    @if ($kategori->id == $barang->kategori_id)
                                        <option value="{{ $kategori->id }}" selected>{{ $kategori->kategori }}
                                        </option>
                                    @else
                                        <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group position-relative">
                                <p style="color: #6c757d; font-size: 22px;">Jumlah Barang</p>
                                <input type="text" class="form-control form-control-xl" name="jumlah_brg"
                                    placeholder="masukkan jumlah barang" required value="{{ $barang->jumlah_brg }}">
                            </div>
                            <div class="form-group position-relative mb-4">
                                <p style="color: #6c757d; font-size: 22px;">Pilih Gudang</p>
                                <select class="form-select" name="kode_gudang" id="ddlSelectGudang"
                                    onchange="setDaftarRuangan();">
                                    @foreach ($gudangs as $gudang)
                                        @if ($gudang->id == $barang->id)
                                            <option value="{{ $gudang->id }}" selected>{{ $gudang->nama_gudang }}
                                            </option>
                                        @else
                                            <option value="{{ $gudang->id }}">{{ $gudang->nama_gudang }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group position-relative mb-4">
                                <p style="color: #6c757d; font-size: 22px;">Pilih Ruangan</p>
                                <select class="form-select" name="kode_ruangan" id="ddlSelectRuangan"">
                                    <option value=" {{ $barang->kode_ruangan }}"
                                    selected>{{ $ruangan->nama_ruangan }}</option>
                                </select>
                            </div>
                            <div class=" form-group position-relative mb-4">
                                <p style="color: #6c757d; font-size: 22px;">Kode Kendaraan</p>
                                <select class="form-select" name="kode_kendaraan" id="ddlSelectKendaraan">
                                    <option value="null">Tidak Menggunakan kendaraan</option>
                                    @forelse ($kendaraans as $kendaraan)
                                        @if ($kendaraan->id == $barang->kendaraan_id)
                                            <option value="{{ $kendaraan->id }}" name="kode_kendaraan" selected>
                                                {{ $kendaraan->plat_nomor }}</option>
                                        @else
                                            <option value="{{ $kendaraan->id }}" name="kode_kendaraan">
                                                {{ $kendaraan->plat_nomor }}</option>
                                        @endif
                                    @empty
                                        <option value="-">Tidak ada kendaraan tersedia</option>
                                    @endforelse
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
