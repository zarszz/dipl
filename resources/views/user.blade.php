<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    <x-slot name="slot">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div id="chart-registered-user"></div>
                </div>
            </div>
            <div class="card">
                @include('layouts.partials.success_update')
                <div class="card-body card-content">
                    <form class="form form-horizontal">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-3">
                                    <a href="{{ route('dashboard.user.create') }}"
                                        class="btn btn-success me-1 mb-1 btn-block">Add New User</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table id="table1" class="table table-striped dataTable w-full table-hover" data-plugin="dataTable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
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
