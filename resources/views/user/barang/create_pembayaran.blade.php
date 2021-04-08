<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Buat Pembayaran</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.barang') }}">Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    <div class="col-xs-4 box"></div>
    <x-slot name="slot">
        <div class="py-5 text-center">
            <h2>Form Pembayaran</h2>
            <p class="lead">Berikut adalah data-data yang diperlukan untuk melakukan pembayaran.</p>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Pembayaran Anda</span>
                    <span class="badge bg-primary rounded-pill">2</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">{{ $barang['nama_brg'] }}</h6>
                            <small class="text-muted">Barang yang akan disimpan</small>
                        </div>
                        <span class="text-muted">Rp.{{ number_format($dibayar['harga'], 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">PPN</h6>
                            <small class="text-muted">10% dari harga barang</small>
                        </div>
                        <span class="text-muted">Rp.{{ number_format($dibayar['ppn'], 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (Rupiah)</span>
                        <strong>Rp.{{ number_format($dibayar['total'], 2) }}</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Informasi pengguna</h4>
                <form action="{{ route('user.pembayarans.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <input type="hidden" name="jumlah_bayar" value="{{ $dibayar['total'] }}">
                        <input type="hidden" name="kode_gudang" value="{{ $barang['kode_gudang'] }}">
                        <input type="hidden" name="kode_ruangan" value="{{ $barang['kode_ruangan'] }}">
                        <input type="hidden" name="kode_kendaraan" value="{{ $barang['kode_kendaraan'] }}">
                        <input type="hidden" name="nama_brg" value="{{ $barang['nama_brg'] }}">
                        <input type="hidden" name="jumlah_brg" value="{{ $barang['jumlah_brg'] }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="col-sm-12">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" class="form-control" value="{{ $user->nama }}" disabled>
                        </div>
                        <div class="col-sm-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="col-sm-12">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" disabled>{{ $user->alamat }}</textarea>
                        </div>
                        <hr class="my-4">
                        <h4 class="mb-3">Pembayaran</h4>
                        <div class="my-3">
                            <ul>
                                <li>Transfer ke rekening 30001231 BRI a/n PT. Warehouse System Coorporate</li>
                                <li>Transfer ke rekening 33332111 BNI a/n PT. Warehouse System Coorporate</li>
                            </ul>
                            <p style="font-weight: bold; color: red">Harap simpan bukti transfer untuk verifikasi pembayaran !!</p>
                        </div>
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Buat Pembayaran</button>
                </form>
            </div>
        </div>
    </x-slot>
</x-app-layout>
