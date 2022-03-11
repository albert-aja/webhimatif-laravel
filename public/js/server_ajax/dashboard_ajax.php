<script>
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

    // function fetchData(labelArray, dataArray, dataTotal){
    //     var data = new Object();

    //     data['label'] = [];
    //     data['value'] = [];
    //     data['step'] = getStep(dataTotal);
        
    //     for(var i=0; i<data.length; i++){
    //         data.label.push(labelArray[i].created_at);
    //         data.value.push(dataArray[i].total);
    //     }

    //     return data;
    // }

    $(document).ready(function() {
        newsStatChart();
        latestNews();
        anggotaHimatif();
    });

    function newsStatChart(){
        $.ajax({
            type: 'POST',
            url: '/Admin/Dashboard/newsStatChart/',
            dataType: 'json',
            beforeSend: function(){
                $.ajax({
                    url: "/Admin/Dashboard/newsDateRange/",
                    type: "GET",
                    dataType: "html",
                    success: function(data) {
                        $('.news-chart').append(data).show();
                    },
                });
            },
            success: function(data) {
                label = [];
                value = [];
                step = getStep(data.length);

                for(var i=0; i<data.length; i++){
                    label.push(data[i].created_at);
                    value.push(data[i].total);
                }

                var news_chart = document.getElementById("newsStatChart").getContext("2d");
                
                var myChart = new Chart(news_chart, {
                    type: "line",
                    data: {
                        labels: label,
                        datasets: [
                            {
                                label: "Jumlah Berita",
                                data: value,
                                borderWidth: 5,
                                borderColor: "#6777ef",
                                backgroundColor: 'transparent',
                                pointBackgroundColor: "#fff",
                                pointBorderColor: "#6777ef",
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
                                        display: false,
                                        drawBorder: false,
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
                                        color: "#fbfbfb",
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
            }
        });
    }

    function topNews(){
        $.ajax({
            url: "/Admin/Dashboard/topNews/",
            type: "GET",
            dataType: "html",
            success: function(data) {
                $('.top-news').append(data).show();
                height = document.querySelector(".news-chart").offsetHeight;
                document.querySelector(".top-news").style.height = height + "px";
                $(".topNews-body").niceScroll();
            },
        });
    }
    
    function latestNews(){
        $.ajax({
            url: "/Admin/Dashboard/latestNews/",
            type: "GET",
            dataType: "html",
            success: function(data) {
                $('.latest-news').append(data).show();
                height = document.querySelector(".news-chart").offsetHeight;
                document.querySelector(".latest-news").style.height = height + "px";
                $(".latest-news").niceScroll();
            },
        });
    }

    function anggotaHimatif(){
        $.ajax({
            type: 'POST',
            url: '/Admin/Dashboard/anggotaHimatif/',
            dataType: 'json',
            beforeSend: function(){
                $.ajax({
                    url: '/Admin/Dashboard/anggotaHimatifChart/',
                    type: "GET",
                    dataType: "html",
                }).done(function (data){
                    $('.anggota-himatif').append(data).show();
                });
            },
            success: function(data) {
                label = [];
                value1 = [];
                value2 = [];

                for(var i=0; i<data.length; i++){
                    label.push(data[i].alias);
                    value1.push(data[i].utama);
                    value2.push(data[i].intern);
                }

                var ctx = document.getElementById("anggotaHimatif").getContext('2d');
                var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        data: value1,
                        backgroundColor: '#6777ef',
                        label: 'Jumlah Anggota Utama'
                    },{
                        data: value2,
                        backgroundColor: '#ffa426',
                        label: 'Jumlah Anggota Intern'
                    }],
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