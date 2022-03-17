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

    $(document).on('change', '#maintenance-btn', function(){
		let status = $(this).attr("data-status");

        if(status){
            swal({
                title: "{{ __('admin/webInfo.config.2maintenance.title') }}",
                text: "{{ __('admin/webInfo.config.2maintenance.text') }}",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willChange) => {
                if (willChange) {
                    $.ajax({
                        type: 'POST',
                        url: '/Admin/maintenance_switch/' + status,
                        error: function() {
                            swal('Error', 'Terjadi Kesalahan!', 'error');
                        },
                        success: function(data) {
                            swal("{{ __('admin/webInfo.config.2maintenance.mode') }}", {
                                icon: 'success',
                            });
                            $("#web-status").children().remove();
                            $('.beep').css("background-color", "#ffa426");
                            getWebStatus();
                        }
                    });
                } else {
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
                        type: 'POST',
                        url: '/Admin/maintenance_switch/' + status,
                        error: function() {
                            swal('Error', 'Terjadi Kesalahan!', 'error');
                        },
                        success: function(data) {
                            swal("{{ __('admin/webInfo.config.2active.mode') }}", {
                                icon: 'success',
                            });
                            $("#web-status").children().remove();
                            $('.beep').css("background-color", "#20c997");
                            getWebStatus();
                        }
                    });
                } else {
                    swal("{{ __('admin/webInfo.config.2active.still') }}", {
                        icon: 'info',
                    });
                    $(this).prop("checked" , false);
                }
            });
        }
    })
</script>