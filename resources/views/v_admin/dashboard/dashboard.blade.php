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
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    function round5(number){
        return Math.ceil(number/5)*5;
    }

    function stepMin(number){
        return Math.ceil(number/5);
    }

    function getStep(max_size){
        if(max_size <= 15){
            return stepMin(max_size);
        } else {
            return round5(stepMin(max_size));
        }
    }

    function randColor(dataTotal){
        color_arr = [
            '#0d6efd', '#6610f2', '#6f42c1', '#d63384',
            '#dc3545', '#fd7e14', '#ffc107', '#198754',
            '#20c997', '#0dcaf0', '#6c757d', '#343a40',
            '#0d6efd', '#6c757d','#198754', '#212529',
            '#0dcaf0', '#ffc107', '#dc3545', '#f8f9fa'
        ]

        rand_arr = [],
        j = 0;

        while (dataTotal--) {
            j = Math.floor(Math.random() * (dataTotal+1));
            rand_arr.push(color_arr[j]);
            color_arr.splice(j,1);
        }
        
        return rand_arr;
    }

    $(document).ready(function() {
        newsStatChart();
        anggotaHimatifChart();
        productPerCategoryChart();
    });

    function newsStatChart(){
        $.ajax({
            url: '/Admin/dashboard_ajax/newsDateRange',
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                $('.news-chart').append(data).show();
            },
            complete: function() {
                newStatData()
            }
        });
    }

    function newStatData(){
        $.ajax({
            type: 'GET',
            url: '/Admin/dashboard_ajax/newsStatChart',
            dataType: 'json',
            success: function(data) {
                label = [];
                value = [];
                step = getStep(data.length);

                for(var i=0; i<data.length; i++){
                    label.push(data[i].created_at);
                    value.push(data[i].total);
                }

                var news_chart = document.getElementById('newsStatChart').getContext('2d');
                
                var myChart = new Chart(news_chart, {
                    type: 'line',
                    data: {
                        labels: label,
                        datasets: [
                            {
                                label: "{{ __('admin/dashboard.chart.postedNews.label') }}",
                                data: value,
                                borderWidth: 5,
                                borderColor: '#6777ef',
                                backgroundColor: 'transparent',
                                pointBackgroundColor: '#fff',
                                pointBorderColor: '#6777ef',
                                pointRadius: 4,
                            },
                        ],
                    },
                    options: {
                        legend: {
                            display: false,
                        },
                        scales: {
                            yAxes: [
                                {
                                    gridLines: {
                                        color: '#F1F3F6',
                                        lineWidth: 2,
                                    },
                                    ticks: {
                                        beginAtZero: true,
                                        stepSize: step,
                                    },
                                },
                            ],
                            xAxes: [
                                {
                                    gridLines: {
                                        color: '#F1F3F6',
                                        lineWidth: 2,
                                    },
                                },
                            ],
                        },
                    },
                });
            },
            complete: function () {
                topNews();
                latestNews();
            }
        })
    }

    function topNews(){
        $.ajax({
            url: '/Admin/dashboard_ajax/topNews',
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                $('.top-news').append(data).show();
                height = document.querySelector('.news-chart').offsetHeight;
                document.querySelector('.top-news').style.height = height + 'px';
                $('.topNews-body').niceScroll();
            },
        });
    }
    
    function latestNews(){
        $.ajax({
            url: '/Admin/dashboard_ajax/latestNews',
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                $('.latest-news').append(data).show();
                height = document.querySelector('.news-chart').offsetHeight;
                document.querySelector('.latest-news').style.height = height + 'px';
                $('.latest-news').niceScroll();
            },
            complete: function () {
                postByDivisionChart();
            }
        });
    }

    function postByDivisionChart(){
        $.ajax({
            url: '/Admin/dashboard_ajax/postByDivisionChart',
            type: 'GET',
            dataType: 'html',
            success: function (data){
                $('.postBy-Division').append(data).show();
            },
            complete: function() {
                postByDivisionData();
            }
        });
    }

    function postByDivisionData() {
        $.ajax({
            type: 'GET',
            url: '/Admin/dashboard_ajax/postByDivision',
            dataType: 'json',
            success: function(data) {
                label = [];
                value = [];

                for(var i=0; i<data.length; i++){
                    label.push(data[i].alias);
                    value.push(data[i].post);
                }

                var ctx = document.getElementById('postByDivision').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            data: value,
                            backgroundColor: '#6777ef',
                            label: "{{ __('admin/dashboard.chart.postByDivision.label') }}"
                        }],
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false,
                        },
                        scales: {
                            yAxes: [
                                {
                                    gridLines: {
                                        color: '#F1F3F6',
                                        lineWidth: 2,
                                    },
                                    ticks: {
                                        beginAtZero: true,
                                        stepSize: step,
                                    },
                                },
                            ],
                            xAxes: [
                                {
                                    gridLines: {
                                        color: '#F1F3F6',
                                        lineWidth: 2,
                                    },
                                },
                            ],
                        },
                    },
                });
            },
        });
    }

    function anggotaHimatifChart(){
        $.ajax({
            url: '/Admin/dashboard_ajax/anggotaHimatifChart',
            type: 'GET',
            dataType: 'html',
            success: function (data){
                $('.anggota-himatif').append(data).show();
            },
            complete: function(){
                anggotaHimatifData();
            }
        })
    }
    
    function anggotaHimatifData(){
        $.ajax({
            type: 'GET',
            url: '/Admin/dashboard_ajax/anggotaHimatif',
            dataType: 'json',
            success: function(data) {
                label = [];
                value1 = [];
                value2 = [];

                for(var i=0; i<data.length; i++){
                    label.push(data[i].division.alias);
                    value1.push(data[i].utama);
                    value2.push(data[i].intern);
                }

                var ctx = document.getElementById('anggotaHimatif').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            data: value1,
                            backgroundColor: '#6777ef',
                            label: "{{ __('admin/dashboard.chart.totalCommitee.labelMain') }}"
                        }, {
                            data: value2,
                            backgroundColor: '#ffa426',
                            label: "{{ __('admin/dashboard.chart.totalCommitee.labelIntern') }}"
                        }],
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'top',
                        },
                        scales: {
                            yAxes: [
                                {
                                    ticks: {
                                        beginAtZero: true,
                                        stepSize: step,
                                    }
                                }
                            ],
                        },
                    }
                });
            },
        });
    }

    function productPerCategoryChart(){
        $.ajax({
            url: '/Admin/dashboard_ajax/shopProductChart',
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                $('.product-himatifShop').append(data).show();
            },
            complete: function() {
                productPerCategoryData();
            }
        });
    }

    function productPerCategoryData(){
        $.ajax({
            type: 'GET',
            url: '/Admin/dashboard_ajax/shopProduct',
            dataType: 'json',
            success: function(data) {
                label = [];
                value = [];

                for(var i=0; i<data.length; i++){
                    label.push(data[i].product_category.category);
                    value.push(data[i].total);
                }

                var ctx = document.getElementById('shopProduct').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: label,
                        datasets: [{
                            data: value,
                            backgroundColor: randColor(label.length),
                        },],
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'top',
                        },
                    }
                });
            },
        });
    }
</script>
@endpush
