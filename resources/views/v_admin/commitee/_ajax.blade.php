<script>
    //cropper
	const img_file = select('#hero_img');
	const cropped = select('.crop_img');

	img_file.addEventListener("change", function() {
		let cropper;
        let crop_image = $('#modal');
		const hero_img = select('.img-preview');
		let modal = select('#modal');
		let image = select('#sample_image');
		let files = event.target.files;

		let done = function(url){
			image.src = url;
			crop_image.modal('show');
		};

		if(files && files.length > 0){
			reader = new FileReader();
			reader.onload = function(event){
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}

		crop_image.on('shown.bs.modal', function() {
			cropper = new Cropper(image, {
				autoCrop: true,
				viewMode: 3,
				preview:'.preview'
			});
		}).on('hidden.bs.modal', function(){
			cropper.destroy();
			cropper = null;
            hide_loader();
		});

		$('#crop').click(function(){
            show_loader();
			canvas = cropper.getCroppedCanvas();

			canvas.toBlob(function(blob){
				var reader = new FileReader();
				reader.readAsDataURL(blob);
				reader.onloadend = function(e){
					crop_image.modal('hide');
					hero_img.src = e.target.result;
                    hero_img.onload = function () {
                        hero_img.style.width = (this.width / this.height * 34) + "rem";
                    }
                    cropped.value = reader.result;
				}
			});
		});
	});

	$(document).on("click", "#modal_add", function() {
		$.ajax({
			method: "GET",
			url: '/Admin/Position/create', 
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_add_position',data);
		})
	})
	
	$(document).on('submit', '#form_add_position', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Position/store',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.position, '#position', '#position-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_add_position').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'Jabatan ' + capitalize(param.position) + ' telah ditambahkan',
					'success',
				);
				$.ajax({
                    method: "GET",
                    url: '/Admin/Position/fetch_new',
                    data: data,
                    success: function(data) {
                        $('.select2').append(data);
                        $('.select2').select2();
                    },
                })
			}
		})
		e.preventDefault();
	})
</script>