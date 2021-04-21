<x-app-layout>
    <x-slot name="header">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Statistik data</h3>
        </div>
        <div class="page-content">
            <div class="col-12 ">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5 custom-bg-card">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">User</h6>
                                        <h6 class="font-extrabold mb-0">{{ $usersCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5 custom-bg-card">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Gudang</h6>
                                        <h6 class="font-extrabold mb-0">{{ $gudangCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5 custom-bg-card">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Barang</h6>
                                        <h6 class="font-extrabold mb-0">{{ $barangCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5 custom-bg-card">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Aktivitas</h6>
                                        <h6 class="font-extrabold mb-0">{{ $logCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Distribusi barang</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Distribusi Per-kategori</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitors-profile"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4><a href="{{ route('dashboard.ticketing') }}" class="text-dark">Ticketing
                                        terakhir</a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>User Id</th>
                                                <th>Pesan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($latestTicketing as $ticketing)
                                                <tr>
                                                    <td class="col-3">
                                                        <p class="font-bold ms-3 mb-0">{{ $ticketing->user_id }}</p>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">{{ $ticketing->pesan }}</p>
                                                    </td>
                                                    <td>
                                                        @if (auth()->user()->isAdmin())
                                                            @switch($ticketing->status)
                                                                @case('pending')
                                                                    <button type="button" class="disabled btn btn-warning"
                                                                        id="prosesTicket"
                                                                        value="{{ $ticketing->id }}">Pending</button>
                                                                @break
                                                                @case('on_progress')
                                                                    <button type="button" class="disabled btn btn-primary"
                                                                        id="prosesTicket"
                                                                        value="{{ $ticketing->id }}">Progress</button>
                                                                @break

                                                                @default
                                                                    <button type="button" class="disabled btn btn-success"
                                                                        id="prosesTicket"
                                                                        value="{{ $ticketing->id }}">Finished</button>
                                                            @endswitch
                                                        @else
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                    <p>Tidak ada data.</p>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4><a href="{{ route('dashboard.pembayaran') }}" class="text-black">Pembayaran</a></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-lg">
                                            <thead>
                                                <tr>
                                                    <th>User id</th>
                                                    <th>Kode bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($latestPembayaran as $pembayaran)
                                                    <tr>
                                                        <td class="col-3">
                                                            <p class="font-bold ms-3 mb-0">{{ $pembayaran->user_id }}</p>
                                                        </td>
                                                        <td class="col-3">
                                                            <p class="font-bold ms-3 mb-0">{{ $pembayaran->no_bayar }}</p>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    Tidak ada data.
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4><a href="{{ route('dashboard.user') }}" class="text-black">User belum verifikasi</a></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($latestUnverifiedUser as $user)
                                                    <tr>
                                                        <td class="col-3">
                                                            <p class="font-bold ms-3 mb-0">{{ $user->nama }}</p>
                                                        </td>
                                                        <td class="col-3">
                                                            <p class="font-bold ms-3 mb-0">{{ $user->email }}</p>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    Tidak ada data.
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-app-layout>
