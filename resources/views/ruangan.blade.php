<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manajemen Ruangan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.gudang') }}">Gudang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ruangan</li>
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
                        <a href="{{ route('admin.ruangans.create') }}" class="btn btn-success me-1 mb-1 btn-block">Tambah Ruangan Baru</a>
                    </div>
                    <table id="table_ruangan" class="table table-striped dataTable w-full table-hover" data-plugin="dataTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Kode Ruangan</th>
                                <th>Nama Ruangan</th>
                                <th>Kode Gudang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
