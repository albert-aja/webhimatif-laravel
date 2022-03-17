<script>
    $(document).ready(function() {
        getWebStatus();
    });

    function getWebStatus(){
        $.ajax({
            type: 'GET',
            url: '/Admin/get_status',
            dataType: 'html',
            success: function(data) {
                $('#web-status').html(data);
            },
        })
    }

    function show_loader(){
        $("#item-preloader").show();
    }

    function hide_loader(){
        $('#item-preloader').hide(0);
    }

    $(document).on('change', '#maintenance-btn', function(){
		let status = $(this).attr("data-status");

        if(!status){
            swal({
                title: "{{ __('admin/webInfo.config.2maintenance.title') }}",
                text: "{{ __('admin/webInfo.config.2maintenance.text') }}",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willChange) => {
                if (willChange) {
                    $.ajax({
                        type: 'GET',
                        url: '/Admin/a2m',
                        beforeSend: function(){
                            show_loader();
                        },
                        error: function() {
                            swal('Error', 'Terjadi Kesalahan!', 'error');
                        },
                        success: function(data) {
                            hide_loader();
                            swal("{{ __('admin/webInfo.config.2maintenance.mode') }}", {
                                icon: 'success',
                            });
                            $("#web-status").children().remove();
                            $('.beep').css("background-color", "#ffa426");
                            getWebStatus();
                        }
                    });
                } else {
                    hide_loader();
                    swal("{{ __('admin/webInfo.config.2maintenance.still') }}", {
                        icon: 'info',
                    });
                    $(this).prop("checked" , true);
                }
            });
        } else {
            swal({
                title: "{{ __('admin/webInfo.config.2active.title') }}",
                text: "{{ __('admin/webInfo.config.2active.text') }}",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willChange) => {
                if (willChange) {
                    $.ajax({
                        type: 'GET',
                        url: '/Admin/m2a',
                        beforeSend: function(){
                            show_loader();
                        },
                        error: function() {
                            swal('Error', 'Terjadi Kesalahan!', 'error');
                        },
                        success: function(data) {
                            hide_loader();
                            swal("{{ __('admin/webInfo.config.2active.mode') }}", {
                                icon: 'success',
                            });
                            $("#web-status").children().remove();
                            $('.beep').css("background-color", "#20c997");
                            getWebStatus();
                        }
                    });
                } else {
                    hide_loader();
                    swal("{{ __('admin/webInfo.config.2active.still') }}", {
                        icon: 'info',
                    });
                    $(this).prop("checked" , false);
                }
            });
        }
    })
</script>