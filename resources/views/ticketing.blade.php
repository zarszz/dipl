<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ auth()->user()->isAdmin() ? 'Manajemen' : '' }}Ticketing</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ticketing</li>
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
                        <a href="{{ route('ticketing.create') }}" class="btn btn-success me-1 mb-1 btn-block">Tambah Ticket Baru</a>
                    </div>
                    <table id="table_ticketing" class="table table-striped dataTable w-full table-hover" data-plugin="dataTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Id</th>
                                <th>Pesan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
