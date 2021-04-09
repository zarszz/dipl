<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ Auth::user()->role_id == 1 ? 'Audit Log' : 'Log Aktivitas' }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->role_id == 1 ? 'Audit Log' : 'Log Aktivitas' }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    <x-slot name="slot">
        <section class="section">
            <div class="card">
                <div class="card-body card-content align-items-center">
                    <table id="table_audit_log" class="table table-striped dataTable w-full table-hover"
                        data-plugin="dataTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Id</th>
                                <th>Kode Barang</th>
                                <th>Kode Gudang</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
