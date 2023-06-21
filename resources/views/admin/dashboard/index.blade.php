@extends('admin.layouts.index')
@section('title')
    dashboard
@endsection

@section('content')
    <h2 class="mb-4">داشبورد</h2>
    <div class="main-content">
        <div class="header background-theme pb-5 pt-5 pt-md-8">
            <div class="container-fluid">
                <h2 class="mb-5 text-dark">آمار سایت</h2>
                <div class="header-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6">
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">ترافیک</h5>
                                            <span class="h2 font-weight-bold mb-0">350,897</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-nowrap">از ماه گذشته</span>
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">فروش</h5>
                                            <span class="h2 font-weight-bold mb-0">2,356</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                <i class="fas fa-chart-pie"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-nowrap">از هفته گذشته</span>
                                        <span class="text-danger mr-2"><i
                                                class="fas fa-arrow-down"></i> 3.48%</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">کاربران جدید</h5>
                                            <span class="h2 font-weight-bold mb-0">924</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-nowrap">از روز گذشته</span>
                                        <span class="text-warning mr-2"><i
                                                class="fas fa-arrow-down"></i> 1.10%</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">بازدهی</h5>
                                            <span class="h2 font-weight-bold mb-0">49,65%</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                <i class="fas fa-percent"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-nowrap">از 3 ماه گذشته</span>
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
    </div>
    <div class="main-content mt-4">
        <div class="row">
            <div class="col-md-6 col-xl-6 col-sm-12">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, aliquid architecto consequatur
                ducimus est fugit, illum in neque nihil nostrum officia perferendis tenetur velit. Accusantium dicta
                iste possimus rem vitae.
            </div>
            <div class="col-md-6 col-xl-6 col-sm-12">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aut, dignissimos doloremque ipsa
                ipsam iusto magni minus molestias nesciunt perspiciatis ratione voluptatem. Doloremque doloribus in,
                ipsam laboriosam mollitia quasi unde.
                <hr>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque hic pariatur, perspiciatis repellendus
                reprehenderit rerum tempora. Alias aliquam, deserunt dolorem odio quidem similique soluta! Aspernatur
                deserunt eos minus odio optio?
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection
