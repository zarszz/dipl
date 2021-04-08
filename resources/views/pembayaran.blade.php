<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ Auth::user()->role_id == 1 ? 'Manajemen' : '' }} Pembayaran</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    <x-slot name="slot">
        <section class="section">
            <div class="card">
                <div class="card-body card-content align-items-center">
                    <table id="table_pembayaran" class="table table-striped dataTable w-full table-hover"
                        data-plugin="dataTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>User Id</th>
                                <th>No Bayar</th>
                                <th>Status</th>
                                <th>Jumlah Bayar</th>
                                <th>Verifikasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal fade"
             id="exampleModal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog"
                 role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- w-100 class so that header
                div covers 100% width of parent div -->
                        <h5 class="modal-title w-100"
                            id="exampleModalLabel">
                          GeeksForGeeks
                      </h5>
                        <button type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">
                              ×
                          </span>
                        </button>
                    </div>

                    <!--Modal body with image-->
                    <div class="modal-body">
                        <img src="http://localhost:8000/storage/pembayaran/fa8c09f6-33e3-4d1f-bf3f-012affd4f4c1.jpg" />
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-danger"
                                data-dismiss="modal">
                          Close
                      </button>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </x-slot>
</x-app-layout>
