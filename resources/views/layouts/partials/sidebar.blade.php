<x-maz-sidebar :href="route('index')" :logo="asset('images/logo/warehouse_logo.png')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Barang" :link="route('dashboard.barang')" icon="bi bi-bag"></x-maz-sidebar-item>

    @if (auth()->user()->isAdmin())
        <x-maz-sidebar-item name="User" :link="route('dashboard.user')" icon="bi bi-people"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Kategori" :link="route('dashboard.kategories')" icon="bi bi-tag"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Ruangan" :link="route('dashboard.ruangan')" icon="bi bi-house"></x-maz-sidebar-item>
    @endif

    @if (auth()->user()->role_id != 2) <!-- user saat ini bukan driver -->
        <x-maz-sidebar-item name="Pembayaran" :link="route('dashboard.pembayaran')" icon="bi bi-wallet"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Gudang" :link="route('dashboard.gudang')" icon="bi bi-building"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Ticketing" :link="route('dashboard.ticketing')" icon="bi bi-question-circle-fill"></x-maz-sidebar-item>
        <x-maz-sidebar-item name="Audit Log" :link="route('dashboard.audit_log')" icon="bi bi-clock-history"></x-maz-sidebar-item>
    @endif

</x-maz-sidebar>
