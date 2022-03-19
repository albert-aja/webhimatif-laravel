<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    });

    $(document).ready(function() {
        getWebStatus();
    });

    /**
	 * Easy selector helper function
	 */
	const select = (el, all = false) => {
		el = el.trim();
		if (all) {
		return [...document.querySelectorAll(el)];
		} else {
		return document.querySelector(el);
		}
	};

	let LOADER = "#item-preloader";

	/* 1. anti-DRY function */
	function show_loader(){
		$(LOADER).show();
	}

	function hide_loader(){
		$(LOADER).hide(0);
	}

	function call_modal(modal,data){
		$('#modal-div').html(data);
		$(modal).modal('show');
	}

	//reload tabel setelah aksi (UX)
	function reload_table(table){
		table.ajax.reload(null, false);
	}

    //validasi data dan feedback (UX)
	function validation(validate,field,feedback){
		if(validate){
			$(field).removeClass('is-valid').addClass('is-invalid');
			$(feedback).text(validate);
		} else {
			$(field).removeClass('is-invalid').addClass('is-valid');
		}
	}

	//ambil data dari parameter url (UX)
	function parse_query_string(query) {
		let vars = query.split("&");
		let query_string = {};

		for (let i = 0; i < vars.length; i++) {
			let pair = vars[i].split("=");
			let key = decodeURIComponent(pair[0]);
			let value = decodeURIComponent(pair[1]);

			// If first entry with this name
			if (typeof query_string[key] === "undefined") {
				query_string[key] = decodeURIComponent(value);
				// If second entry with this name
			} else if (typeof query_string[key] === "string") {
				var arr = [query_string[key], decodeURIComponent(value)];
				query_string[key] = arr;
				// If third or later entry with this name
			} else {
				query_string[key].push(decodeURIComponent(value));
			}
		}

		return query_string;
	}

	//fungsi untuk membuat huruf pertama sebuah kata menjadi kapital
	function capitalize(string) {
		return string.charAt(0).toUpperCase() + string.slice(1);
	}

    function errorSwal(){
        Swal.fire(
            "{{ __('admin/swal.error.title') }}",
            "{{ __('admin/swal.error.msg') }}",
            'error',
        );
    }

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

        if(!status){
            Swal.fire({
                title: "{{ __('admin/webInfo.config.2maintenance.title') }}",
                text: "{{ __('admin/webInfo.config.2maintenance.text') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('admin/swal.btn.confirm') }}",
                cancelButtonText: "{{ __('admin/swal.btn.cancel') }}",
            }).then((change) => {
                if (change.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: '/Admin/a2m',
                        beforeSend: function(){
                            show_loader();
                        },
                        error: function() {
                            errorSwal();
                        },
                        success: function(data) {
                            hide_loader();
                            Swal.fire({
                                title: "{{ __('admin/webInfo.config.2maintenance.mode') }}",
                                icon: 'success',
                            })
                            $("#web-status").children().remove();
                            $('.beep').css("background-color", "#ffa426");
                            getWebStatus();
                        }
                    });
                } else {
                    hide_loader();
                    Swal.fire({
                        title: "{{ __('admin/webInfo.config.2maintenance.still') }}",
                        icon: 'info',
                    })
                    $(this).prop("checked" , true);
                }
            });
        } else {
            Swal.fire({
                title: "{{ __('admin/webInfo.config.2active.title') }}",
                text: "{{ __('admin/webInfo.config.2active.text') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('admin/swal.btn.confirm') }}",
                cancelButtonText: "{{ __('admin/swal.btn.cancel') }}",
            }).then((change) => {
                if (change.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: '/Admin/m2a',
                        beforeSend: function(){
                            show_loader();
                        },
                        error: function() {
                            Swal.fire(
                                "{{ __('admin/swal.error.title') }}",
                                "{{ __('admin/swal.error.msg') }}",
                                'error',
                            );
                        },
                        success: function(data) {
                            hide_loader();
                            Swal.fire({
                                title: "{{ __('admin/webInfo.config.2active.mode') }}",
                                icon: 'success',
                            })
                            $("#web-status").children().remove();
                            $('.beep').css("background-color", "#20c997");
                            getWebStatus();
                        }
                    });
                } else {
                    hide_loader();
                    Swal.fire({
                        title: "{{ __('admin/webInfo.config.2active.still') }}",
                        icon: 'info',
                    })
                    $(this).prop("checked" , false);
                }
            });
        }
    })

	//loading button
	$(document).on("click", ".clicked-button", function() {
		//change button text
		$(this).innerText = 'Loading...';
		// disable button
		$(this).prop("disabled", true);
		// add spinner to button
		$(this).html(
			`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
		);
    });
</script>