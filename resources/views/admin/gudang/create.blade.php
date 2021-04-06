<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Menambahkan Gudang Baru</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.gudang') }}">Gudang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Menambah Gudang Baru</li>
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
                        <form class="form form-horizontal" action="{{ route('admin.gudangs.store') }}" method="POST">
                            @csrf
                            <div class="form-group position-relative">
                                <input type="text" class="form-control form-control-xl" name="nama_gudang"
                                    placeholder="Nama Gudang" required>
                            </div>
                            <div class="form-group position-relative mb-4">
                                <textarea class="form-control form-control-xl" name="alamat" placeholder="Alamat"
                                    required></textarea>
                            </div>
                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Tambahkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
