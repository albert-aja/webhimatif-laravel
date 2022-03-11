<script>
    $(document).ready(function() {
        getWebStatus();
    });

    function getWebStatus(){
        $.ajax({
            type: 'POST',
            url: '/Admin/Feature/get_status',
            dataType: 'html',
            success: function(data) {
                $('#web-status').html(data);
            },
        })
    }

    $(document).on('change', '#maintenance-btn', function(){
		let status = $(this).attr("data-status");

        if(status == "false"){
            swal({
                title: 'Yakin ingin mengubah website menjadi Maintenance Mode?',
                text: 'User tidak dapat mengakses website selama Maintenance Mode!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willChange) => {
                if (willChange) {
                    $.ajax({
                        url: '/Admin/Feature/maintenance_switch/' + status,
                        error: function() {
                            swal('Error', 'Terjadi Kesalahan!', 'error');
                        },
                        success: function(data) {
                            swal('Poof! Maintenance Mode telah diaktifkan!', {
                                icon: 'success',
                            });
                            $("#web-status").children().remove();
                            $('.beep').css("background-color", "#ffa426");
                            getWebStatus();
                        }
                    });
                } else {
                    swal('Website tetap Aktif', {
                        icon: 'info',
                    });
                    $(this).prop("checked" , true);
                }
            });
        } else if(status == "true"){
            swal({
                title: 'Aktifkan Kembali Website?',
                text: 'User dapat mengakses kembali website setelah diaktifkan!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willChange) => {
                if (willChange) {
                    $.ajax({
                        url: '/Admin/Feature/maintenance_switch/' + status,
                        error: function() {
                            swal('Error', 'Terjadi Kesalahan!', 'error');
                        },
                        success: function(data) {
                            swal('Poof! Website sudah aktif sekarang!', {
                                icon: 'success',
                            });
                            $("#web-status").children().remove();
                            $('.beep').css("background-color", "#20c997");
                            getWebStatus();
                        }
                    });
                } else {
                    swal('Website tetap dalam Maintenance Mode', {
                        icon: 'info',
                    });
                    $(this).prop("checked" , false);
                }
            });
        }
    })
</script>