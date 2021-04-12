<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ Auth::user()->role_id == 1 ? 'Manajemen' : '' }} Barang</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Barang</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    <x-slot name="slot">
        <section class="section">
            <div class="card">
                <div class="card-body card-content align-items-center">
                    <div class="col-3 align-item-center">
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.barangs.create') }}" class="btn btn-success me-1 mb-1 btn-block"
                                style="font-weight:bold;">Tambah Barang Baru</a>
                        @else
                            @if (auth()->user()->status == 'verified')
                                <a href="{{ route('user.barangs.create') }}"
                                    class="btn btn-success me-1 mb-1 btn-block" style="font-weight:bold;">Tambah Barang
                                    Baru</a>
                            @else
                                <a href="#" id="unverified_tambah_barang"
                                    class="btn btn-success me-1 mb-1 btn-block" style="font-weight:bold;">Tambah Barang
                                    Baru</a>
                            @endif
                        @endif
                    </div>
                    <table id="table_barang" class="table table-striped dataTable w-full table-hover"
                        data-plugin="dataTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>User Id</th>
                                <th>Kode Gudang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
