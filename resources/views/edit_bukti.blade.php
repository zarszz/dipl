<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Update Bukti Pembayaran</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.pembayaran') }}">Pembayaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Upload Bukti</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    <div class="col-xs-4 box"></div>
    <x-slot name="slot">
        <div class="py-5 text-center">
            <h2>Update Bukti Pembayaran</h2>
            <p class="lead">Berikut adalah data-data yang diperlukan untuk melakukan pembayaran.</p>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Pembayaran Anda</span>
                    <span class="badge bg-primary rounded-pill">2</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (Rupiah)</span>
                        <strong>Rp.{{ number_format($pembayaran->jumlah_bayar, 2) }}</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Informasi pengguna</h4>
                <form action="{{ route('pembayarans.bukti.update', ['id' => $pembayaran->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row g-3">
                        <input type="hidden" name="pembayaran_id" value="{{ $pembayaran->id }}">
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
                        <div class="col-sm-12">
                            <label for="address" class="form-label">Nomor Pembayaran</label>
                            <textarea class="form-control" id="address"
                                disabled>{{ $pembayaran->no_bayar }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Bukti pembayaran saat ini</label>
                            @if ($pembayaran->bukti_bayar)
                                <img src="{{ $pembayaran->bukti_bayar }}" alt="">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Silahkan pilih file bukti pembayaran</label>
                            <input class="form-control" type="file" name="bukti_pembayaran">
                        </div>
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Update Bukti Pembayaran</button>
                </form>
            </div>
        </div>
    </x-slot>
</x-app-layout>
