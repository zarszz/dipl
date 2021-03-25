<x-maz-sidebar :href="route('index')" :logo="asset('images/logo/logo.png')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="User" :link="route('user')" icon="bi bi-people"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Pembayaran" :link="route('pembayaran')" icon="bi bi-wallet"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Gudang" :link="route('gudang')" icon="bi bi-house"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Barang" :link="route('barang')" icon="bi bi-bag"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Audit Log" :link="route('log_audit')" icon="bi bi-clock-history"></x-maz-sidebar-item>

</x-maz-sidebar>
