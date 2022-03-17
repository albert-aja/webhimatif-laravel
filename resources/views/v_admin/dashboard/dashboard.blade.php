@extends('_layout.admin._template')

@section('content')

<section class="section">
    <div class="row">

        <x-dashboard.admin-card bg="bg-primary" icon="fa-users" :title="__('admin/dashboard.card.division')" :info="$jumlahDivisi" :route="route('division-data')"/>
        <x-dashboard.admin-card bg="bg-success" icon="fa-user" :title="__('admin/dashboard.card.commitee')" :info="$jumlahPengurus"/>
        <x-dashboard.admin-card bg="bg-warning" icon="fa-file-alt" :title="__('admin/dashboard.card.post')" :info="$jumlahBerita" :route="route('post-data')"/>
        <x-dashboard.admin-card bg="bg-danger" icon="fa-shopping-bag" :title="__('admin/dashboard.card.product')" :info="$jumlahProduk" :route="route('shop-data')"/>

    </div>

    <div class="data-berita">
        <x-dashboard.collapse-header targetID="dataBerita" :title="__('admin/dashboard.collapse.post')"/>
        <div class="section-body show" id="dataBerita">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card news-chart">
                    
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card card-hero top-news">
                    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card latest-news">
                    
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card postBy-Division">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <x-dashboard.collapse-header targetID="dataPengurus" :title="__('admin/dashboard.collapse.division')"/>
            <div class="section-body show" id="dataPengurus">
                <div class="row">
                    <div class="col">
                        <div class="card anggota-himatif">
            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <x-dashboard.collapse-header targetID="dataShop" :title="__('admin/dashboard.collapse.shop')"/>
            <div class="section-body show" id="dataShop">
                <div class="row">
                    <div class="col">
                        <div class="card product-himatifShop">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection

@push('addon-script')
<script src="{{ asset('js/chart.js') }}"></script>
@include('v_admin.dashboard._ajax')
@endpush
