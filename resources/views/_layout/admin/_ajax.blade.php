<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    });

    $(document).ready(function() {
        getWebStatus();
    });

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

    function build_ckeditor() {
        let editor = CKEDITOR.replace("ckeditor", {
            height: 300,
        });

        editor.config.extraPlugins = "autogrow";
        editor.config.editorplaceholder = '{{ __("admin/crud.form.type") }}';
        editor.config.allowedContent = true;
        editor.config.autoGrow_minHeight = 300;
        editor.config.autoGrow_maxHeight = 800;
    }

	function call_modal(modalID, data, appendTo = '#modal-div'){
		$(appendTo).html(data);
		$(modalID).modal('show');

        $(modalID).on('shown.bs.modal', function () {
			$(modalID).find('input[type!=hidden]:first').focus();
		});
	}

	//reload tabel setelah aksi (UX)
	function reload_table(table, callback = null, reset = false){
		table.ajax.reload(callback, reset);
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
    function select2() {
        if (jQuery().select2) {
            $(".select2").select2({
                dropdownParent: $('.modal-body')
            });
        }
    }

    function tooltip(){
        let tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    function try_link() {
        var el = $("#linkTo");
        if ($(".linkMediaSosial").val().match(/^http([s]?):\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/)) {
            el.attr("href", $(".linkMediaSosial").val());
            el.css("pointer-events", "visible");
            el.addClass("btn-primary");
            el.removeClass("btn-secondary");
        } else {
            el.css("pointer-events", "none");
            el.addClass("btn-secondary");
            el.removeClass("btn-primary");
        }
    }

    function preview_social() {
        if ($(".linkMediaSosial").length > 0) {
            try_link();

            $(".linkMediaSosial").keyup(function () {
                try_link();
                $("#preview-btn").attr("href", $(".linkMediaSosial").val());
            });

            $("input[name='icon']").click(function () {
                $("#preview-icon").removeClass();
                $("#preview-icon").addClass(
                    $("input[name='icon']:checked").val()
                );
            });
        }
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

	$(document).on("click", "#changePassword", function() {
		$.ajax({
            type: 'GET',
            url: '/Admin/changepw',
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_change_password', data, '#feature-div');
            $('#show_password').change(function(){
                let y = document.getElementById('new');
                let z = document.getElementById('confirm');

                if (y.type === "password") {
                    y.type = "text";
                    z.type = "text";
                } else {
                    y.type = "password";
                    z.type = "password";
                }
            });
		})
	})

    $(document).on('submit', '#form_change_password', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/editpw',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();

			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.password, '#new', '#new-feedback');
				validation(feedback.password_confirmation, '#confirm', '#confirm-feedback');
			} else {
				$('#modal_change_password').modal('hide');
                Swal.fire({
					title: '{{ __("admin/swal.success") }}',
					text: 'Password berhasil diperbarui!',
					icon: 'success',
                    timer: 2000,
                    timerProgressBar: true,
				})
			}
		})
		e.preventDefault();
	})

</script>