@extends('layouts.blank')
@section('main_container')

    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- preloader end -->

    <!-- ========================= header start ========================= -->
    <header class="header navbar-area bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="index.html">
                            <img src="{{ asset('img/logo/warehouse_logo.jpg') }}" alt="Logo" width="100" height="100">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="page-scroll active" href="#home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#services">Layanan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#process">Alur Kerja</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#about">About</a>
                                </li>
                            </ul>
                            <div class="header-btn">
                                @auth
                                    <a href="{{ route('dashboard') }}" class="theme-btn">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="theme-btn">Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="theme-btn">Register</a>
                                    @endif
                                @endauth
                            </div>
                        </div> <!-- navbar collapse -->
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->

    </header>
    <!-- ========================= header end ========================= -->

    <!-- ========================= carousel-section end ========================= -->
    <section id="home" class="carousel-section-wrapper">
        <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-section carousel-item active clip-bg pt-225 pb-200 img-bg"
                    style="background-image: {{ asset('img/carousel/1.jpg') }};">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-10 mx-auto">
                                <div class="carousel-content text-center">
                                    <div class="section-title">
                                        <h2 class="text-white">Kelola Dengan Sentuhan</h2>
                                        <p class="text-white">Warehouse System menawarkan sistem yang terintegrasi dan
                                            anda cukup menggunakan sentuhan untuk mengelelola seluruh barang-barang yang
                                            anda simpan pada Warehouse System.</p>
                                    </div>
                                    <!-- <a href="javascript:void(0)" class="theme-btn border-btn">Read More</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-section carousel-item clip-bg pt-225 pb-200 img-bg"
                    style="background-image: {{ asset('img/carousel/2.jpg') }};">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-10 mx-auto">
                                <div class="carousel-content text-center">
                                    <div class="section-title">
                                        <h2 class="text-white">Data on Cloud</h2>
                                        <p class="text-white">Warehouse System menyimpan seluruh data mengenai barang
                                            anda. Anda sudah tidak perlu lagi menggunakan kertas yang menumpuk untuk
                                            mencatat data-data mengenai barang anda.</p>
                                    </div>
                                    <!-- <a href="javascript:void(0)" class="theme-btn border-btn">Read More</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-section carousel-item clip-bg pt-225 pb-200 img-bg"
                    style="background-image: {{ asset('img/carousel/2.jpg') }};">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-10 mx-auto">
                                <div class="carousel-content text-center">
                                    <div class="section-title">
                                        <h2 class="text-white">Integrated Audit Log System</h2>
                                        <p class="text-white">Warehouse System mencatat seluruh kegiatan aktifitas
                                            barang anda. Mulai dari barang masuk kedalam Warehouse System, barang yang
                                            ditarik dari Warehouse System, hingga kapan barang anda disimpan .</p>
                                    </div>
                                    <!-- <a href="javascript:void(0)" class="theme-btn border-btn">Read More</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control carousel-control-prev" href="#carouselExampleCaptions" role="button"
                data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"><i class="lni lni-arrow-left"></i></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control carousel-control-next" href="#carouselExampleCaptions" role="button"
                data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"><i class="lni lni-arrow-right"></i></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <!-- ========================= carousel-section end ========================= -->

    <!-- ========================= feature-section start ========================= -->
    <section id="features" class="feature-section pt-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7 col-md-9 mx-auto">
                    <div class="section-title text-center mb-55">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Kenapa Memilih Kami ?</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Mengapa anda harus menggunakan Warehouse System</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box box-style">
                        <div class="feature-icon box-icon-style">
                            <i class="lni lni-layers"></i>
                        </div>
                        <div class="box-content-style feature-content">
                            <h4>Terintegrasi</h4>
                            <p>Sistem dashboard yang terintegrasi dengan berbagai fitur.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box box-style">
                        <div class="feature-icon box-icon-style">
                            <i class="lni lni-pointer-up"></i>
                        </div>
                        <div class="box-content-style feature-content">
                            <h4>Kelola dari jarak jauh</h4>
                            <p>Kelola darimanapun, selama ada koneksi internet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box box-style">
                        <div class="feature-icon box-icon-style">
                            <i class="lni lni-chevron-left-circle"></i>
                        </div>
                        <div class="box-content-style feature-content">
                            <h4>Audit Log System </h4>
                            <p>Seluruh aktifitas masuk dan keluarnya barang anda tercatat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= feature-section end ========================= -->

    <!--========================= about-section start========================= -->
    <section id="about" class="pt-100">
        <div class="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="about-img-wrapper">
                            <div class="about-img position-relative d-inline-block wow fadeInLeft" data-wow-delay=".3s">
                                <img src="{{ asset('img/about/about-img.png') }}" alt="">

                                <div class="about-experience">
                                    <h3>5 Tahun</h3>
                                    <p>Pengguna telah mempercayai sistem kami.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="about-content-wrapper">
                            <div class="section-title">
                                <span class="wow fadeInUp" data-wow-delay=".2s">Tentang Kami</span>
                            </div>
                            <div class="about-content">
                                <p class="mb-45 wow fadeInUp" data-wow-delay=".6s">Warehouse System telah dipercaya
                                    pengguna untuk menyimpan data-data mengenai barang yang ada di gudang mereka,
                                    berikut adalah jumlah pengguna dan data barang yang tersimpan dalam warehouse system
                                </p>
                                <div class="counter-up wow fadeInUp" data-wow-delay=".5s">
                                    <div class="counter">
                                        <span id="secondo" class="countup count color-1" cup-end="30"
                                            cup-append="k">10</span>
                                        <h4>Pengguna terdaftar</h4>
                                        <!-- <p> <br class="d-none d-md-block d-lg-none d-xl-block"> library that is robust and</p> -->
                                    </div>
                                    <div class="counter">
                                        <span id="secondo" class="countup count color-2" cup-end="42"
                                            cup-append="k">5</span>
                                        <h4>Barang disimpan</h4>
                                        <!-- <p>We Crafted an awesome design <br class="d-none d-md-block d-lg-none d-xl-block"> library that is robust and</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--========================= about-section end========================= -->

    <!-- ========================= service-section start ========================= -->
    <section id="services" class="service-section pt-130">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7 col-md-9 mx-auto">
                    <div class="section-title text-center mb-55">
                        <span class="wow fadeInDown" data-wow-delay=".2s">Layanan</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Berikut Adalah Layanan Terbaik Kami</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Warehouse System Memiliki Layanan Berikut</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="service-box box-style">
                        <div class="service-icon box-icon-style">
                            <i class="lni lni-leaf"></i>
                        </div>
                        <div class="box-content-style service-content">
                            <h4>Dashboard System</h4>
                            <p>Dashboard yang terintegrasi dengan beberapa fitur yang lainnya.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-box box-style">
                        <div class="service-icon box-icon-style">
                            <i class="lni lni-chevron-left-circle"></i>
                        </div>
                        <div class="box-content-style service-content">
                            <h4>Audit Log</h4>
                            <p>Warehouse system selalu mencatat aktifitas barang anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-box box-style">
                        <div class="service-icon box-icon-style">
                            <i class="lni lni-headphone-alt"></i>
                        </div>
                        <div class="box-content-style service-content">
                            <h4>Ticketing System</h4>
                            <p>Terdapat permasalahan ? Silahkan buat ticketing untuk mendapatkan solusi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-box box-style">
                        <div class="service-icon box-icon-style">
                            <i class="lni lni-support"></i>
                        </div>
                        <div class="box-content-style service-content">
                            <h4>Dukungan 24 jam</h4>
                            <p>Dukungan penuh selama 24 jam.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-box box-style">
                        <div class="service-icon box-icon-style">
                            <i class="lni lni-infinite"></i>
                        </div>
                        <div class="box-content-style service-content">
                            <h4>Akses darimana saja</h4>
                            <p>Akses Warehouse System darimana saja, selama terdapat koneksi internet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-box box-style">
                        <div class="service-icon box-icon-style">
                            <i class="lni lni-reload"></i>
                        </div>
                        <div class="box-content-style service-content">
                            <h4>Regular Updates</h4>
                            <p>Gratis pembaruan tanpa syarat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= service-section end ========================= -->

    <!-- ========================= process-section start ========================= -->
    <section id="process" class="process-section pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7 col-md-9 mx-auto">
                    <div class="section-title text-center mb-55">
                        <span class="wow fadeInDown" data-wow-delay=".2s">Alur Kerja</span>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Berikut Adalah Alur Kerja Warehouse System</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center time-line">
                <div class="col-12">
                    <div class="single-timeline">
                        <div class="row align-items-center">
                            <div class="col-lg-5 order-last order-lg-first">
                                <div class="timeline-content left-content text-lg-right">
                                    <div class="box-icon-style">
                                        <i class="lni lni-user"></i>
                                    </div>
                                    <h4 class="mb-10">Registrasi</h4>
                                    <p>Silahkan registrasi akun anda.</p>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-5">
                                <div class="timeline-img">
                                    <img src="{{ asset('img/timeline/timeline-1.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-timeline">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="timeline-img">
                                    <img src="{{ asset('img/timeline/timeline-2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-5">
                                <div class="timeline-content right-content text-left">
                                    <div class="box-icon-style">
                                        <i class="lni lni-checkbox"></i>
                                    </div>
                                    <h4 class="mb-10">Verifikasi Akun</h4>
                                    <p>Setelah melakukan registrasi, tunggu informasi aktivasi akun anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-timeline">
                        <div class="row align-items-center">
                            <div class="col-lg-5 order-last order-lg-first">
                                <div class="timeline-content left-content text-lg-right">
                                    <div class="box-icon-style">
                                        <i class="lni lni-apartment"></i>
                                    </div>
                                    <h4 class="mb-10">Pilih Gudang</h4>
                                    <p>Setelah akun terverifikasi, Silahkan ke dashboard Barang dan tambahkan barang untuk memilih gudang.</p>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-5">
                                <div class="timeline-img">
                                    <img src="{{ asset('img/timeline/timeline-3.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-timeline">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="timeline-img">
                                    <img src="{{ asset('img/timeline/timeline-4.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-5">
                                <div class="timeline-content right-content text-left">
                                    <div class="box-icon-style">
                                        <i class="lni lni-delivery"></i>
                                    </div>
                                    <h4 class="mb-10">Simpan Barang Anda</h4>
                                    <p>Buat Pembayaran dan segera lunasi pembayaran anda. Tim Warehouse System siap mengambil barang anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= process-section end ========================= -->

    <!-- ========================= footer start ========================= -->
    <footer class="footer pt-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget mb-60 wow fadeInLeft" data-wow-delay=".2s">
                        <a href="index.html" class="logo mb-30"><img
                                src="{{ asset('img/logo/warehouse_logo.jpg') }}" alt="logo" width="140"
                                height="100"></a>
                        <p class="mb-30 footer-desc">Kami Membangun Warehouse System.</p>
                    </div>
                </div>
                <div class="col-xl-2 offset-xl-1 col-lg-2 col-md-6">
                    <div class="footer-widget mb-60 wow fadeInUp" data-wow-delay=".4s">
                        <h4>Quick Link</h4>
                        <ul class="footer-links">
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="#about">About Us</a>
                            </li>
                            <li>
                                <a href="#services">Service</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="footer-widget mb-60 wow fadeInRight" data-wow-delay=".8s">
                        <h4>Contact</h4>
                        <ul class="footer-contact">
                            <li>
                                <p>+62822342112</p>
                            </li>
                            <li>
                                <p>bussiness@whsystem.com</p>
                            </li>
                            <li>
                                <p>Bojongsoang, Bandung</br>
                                    Indonesia</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="copyright-area">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="footer-social-links">
                            <ul class="d-flex">
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram-original"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="wow fadeInUp" data-wow-delay=".3s">Template by <a href="https://uideck.com"
                                rel="nofollow">UIdeck</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ========================= footer end ========================= -->


    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-arrow-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{ URL::asset('js/bootstrap.bundle-5.0.0.alpha-min.js') }}"></script>
    <script src="{{ URL::asset('js/count-up.min.js') }}"></script>
    <script src="{{ URL::asset('js/wow.min.js') }}"></script>
    <script src="{{ URL::asset('js/imagesloaded.min.js') }}"></script>
    <script src="{{ URL::asset('js/landing.js') }}"></script>
    </body>
@endsection
