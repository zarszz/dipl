<x-maz-sidebar :href="route('index')" :logo="asset('images/logo/logo.png')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Barang" :link="route('dashboard.barang')" icon="bi bi-bag"></x-maz-sidebar-item>

    @if (auth()->user()->role_id == 1)
        <x-maz-sidebar-item name="User" :link="route('dashboard.user')" icon="bi bi-people">
            {{-- <x-slot name="submenu">
                <x-maz-sidebar-item name="Verifikasi User" :link="route('admin.user.verif')" icon="bi bi-person-check-fill"></x-maz-sidebar-item>
            </x-slot> --}}
        </x-maz-sidebar-item>
    @endif

    @if (auth()->user()->role_id != 3) <!-- user saat ini bukan driver -->
        <x-maz-sidebar-item name="Pembayaran" :link="route('dashboard.pembayaran')" icon="bi bi-wallet"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Gudang" :link="route('dashboard.gudang')" icon="bi bi-house"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Audit Log" :link="route('dashboard.log_audit')" icon="bi bi-clock-history"></x-maz-sidebar-item>
    @endif

</x-maz-sidebar>
