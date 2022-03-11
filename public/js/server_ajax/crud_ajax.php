<script>
	//FIXME fix onclick function

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

	var article_table = $('#tableBlog').DataTable({
		"serverSide": true,
		"pageLength": 5,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/berita/getArticle',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			null,
			null,
			null,
			null,
			null,
			{"sClass": "text-center" },
			{"sClass": "text-center" },
		],
	});

	var tag_table = $('#tableTag').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/Tag/getTags',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			null,
			{"sClass": "text-center" },
			{"sClass": "text-center" },
		]
	});

	let division_table = $('#tableDivisi').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"autoWidth": false,
		"responsive": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/divisi/getDivisi',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			{"sClass": "px-5" },
			null,
			null,
			{"sClass": "text-center" },
			{"sClass": "text-center" },
			{"sClass": "text-center" },
		]
	});

	var pengurus_table = $('#tablePengurus').DataTable({
		"serverSide": true,
		"pageLength": 5,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/pengurus/getPengurus',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			null,
			null,
			null,
			{"sClass": "text-center" },
		]
	});

	var progja_table = $('#tableProgja').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/progja/getProgja',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			null,
			null,
			{"sClass": "text-center" },
		]
	});

	var item_table = $('#tableItem').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/Shop/getItem',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			null,
			null,
			null,
			null,
			{"sClass": "text-center" },
		]
	});

	var category_table = $('#tableCategory').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/Shop/getCategory',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			null,
			null,
			{"sClass": "text-center" },
		]
	});

	var colour_table = $('#tableWarna').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/shop/getWarna',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			{"sClass": "text-center" },
			{"sClass": "text-center" },
		],
	});

	var kontakUM_table = $('#tableKontakUM').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/KontakUM/getKontakUM',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			{"sClass": "text-center" },
			{"sClass": "text-center" },
			{"sClass": "text-center" },
		],
	});

	var jabatan_table = $('#tableJabatan').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/Jabatan/getJabatan',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			{"sClass": "text-center" },
		]
	});

	var misi_table = $('#tableMisi').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/config/getMisi',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			{"sClass": "text-center" },
		],
	});

	var service_table = $('#tableService').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/config/getService',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			null,
			{"sClass": "text-center" },
		],
	});

	var social_table = $('#tableSocial').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"ajax": {
			"url": '<?= base_url();?>/admin/config/getSocial',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center" },
			null,
			null,
			null,
			{"sClass": "text-center" },
			{"sClass": "text-center" },
		],
	});
	
	// tabel truncate
	var truncate_table = $('#tableTruncate').DataTable({
		"serverSide": true,
		"paging": false,
		"autoWidth": false,
		"responsive": true,
		"stateSave": true,
		"bLengthChange": false,
		"bFilter": false,
		"bInfo": false,
		"ajax": {
			"url": '<?= base_url();?>/admin/truncate/getTable',
			"type": "GET"
		},
		"lengthMenu": [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		"aoColumns": [
			{"sClass": "text-center"},
			null,
			{"sClass": "text-center"},
		],
	});
	
	$(document).on("click", ".hapusArtikel", function() {
		let title = $(this).attr("data-title");
		let id = $(this).attr("data-id");

		swal({
				title: 'Yakin ingin menghapus berita berjudul "' +title+ '"?',
				text: 'Berita akan hilang setelah dihapus!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/berita/delete_article/'+id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Berita Berhasil Di Hapus!', {
							icon: 'success',
						});
						reload_table(article_table);
					}
				});
			}
		});
	});

	
	
	$(document).on("click", "#delete_tag", function() {
		let tag = $(this).attr("data-tag");
		let id = $(this).attr("data-id");

		swal({
				title: 'Yakin ingin menghapus tag ' + tag + '?',
				text: 'Tag akan hilang setelah dihapus!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/tag/delete_tag/' + id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Tag Berhasil Di Hapus!', {
							icon: 'success',
						});

						reload_table(tag_table);
					}
				});
			}
		});
	})
	
	$(document).on("click", ".hapusDivisi", function() {
		let divisi = $(this).attr("data-divisi");
		let id = $(this).attr("data-id");

		swal({
				title: 'Yakin ingin menghapus divisi ' + divisi + '?',
				text: 'Divisi akan hilang setelah dihapus!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/divisi/delete_divisi/' + id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Divisi Berhasil Di Hapus!', {
							icon: 'success',
						});
						reload_table(division_table);
					}
				});
			}
		});
	})
	
	$(document).on("click", ".hapusProgja", function() {
		let progja = $(this).attr("data-progja");
		let id = $(this).attr("data-id");

		swal({
				title: 'Yakin ingin menghapus progja ' + progja + '?',
				text: 'Progja akan hilang setelah dihapus!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/progja/delete_progja/' + id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Program Kerja Berhasil Di Hapus!', {
							icon: 'success',
						});
						reload_table(progja_table);
					}
				});
			}
		});
	})
	
	$(document).on("click", ".hapusJabatan", function() {
		let jabatan = $(this).attr("data-jabatan");
		let id = $(this).attr("data-id");

		swal({
				title: 'Yakin ingin menghapus jabatan ' + jabatan + '?',
				text: 'Jabatan akan hilang setelah dihapus!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/Jabatan/delete_jabatan/' + id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Jabatan Berhasil Di Hapus!', {
							icon: 'success',
						});
						reload_table(jabatan_table);
					}
				});
			}
		});
	})
	
	$(document).on("click", ".hapusPengurus", function() {
		let id 			= $(this).attr("data-id");
		let pengurus 	= $(this).attr("data-pengurus");

		swal({
				title: 'Yakin ingin menghapus data ' + pengurus + '?',
				text: 'Data akan hilang setelah dihapus!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/pengurus/delete_pengurus/' + id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Data Berhasil Di Hapus!', {
							icon: 'success',
						});
						reload_table(pengurus_table);
					}
				});
			}
		});
	})
	
	$(document).on("click", ".hapusItem", function() {
		let item = $(this).attr("data-item");
		let id = $(this).attr("data-id");

		swal({
				title: 'Yakin ingin menghapus produk ' + item + '?',
				text: 'Item akan hilang setelah dihapus!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/shop/delete_item/' + id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Produk Berhasil Di Hapus!', {
							icon: 'success',
						});
						reload_table(item_table);
					}
				});
			}
		});
	})
	
	$(document).on("click", "#delete_category", function() {
		let category = $(this).attr("data-category");
		let id = $(this).attr("data-id");

		swal({
				title: 'Yakin ingin menghapus kategori ' + category + '?',
				text: 'Kategori akan hilang setelah dihapus!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/shop/delete_category/' + id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Kategori Berhasil Di Hapus!', {
							icon: 'success',
						});
						reload_table(category_table);
					}
				});
			}
		});
	})
	
	$(document).on("click", "#delete_warna", function() {
		let warna = $(this).attr("data-warna");
		let id = $(this).attr("data-id");

		swal({
				title: 'Yakin ingin menghapus warna ' + warna + '?',
				text: 'Warna akan hilang setelah dihapus!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/shop/delete_warna/' + id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Warna berhasil Di Hapus!', {
							icon: 'success',
						});
						reload_table(colour_table);
					}
				});
			}
		});
	})
	
	$(document).on("click", "#delete_kontakUM", function() {
		let id = $(this).attr("data-id");
		let social = $(this).attr("data-social");

		swal({
				title: 'Yakin ingin menghapus kontak ' + social + '?',
				text: 'Kontak akan hilang setelah dihapus!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/KontakUM/delete_kontakUM/' + id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Kontak Berhasil Di Hapus!', {
							icon: 'success',
						});
						reload_table(kontakUM_table);
					}
				});
			}
		});
	})
	
	$(document).on("click", "#delete_misi", function() {
		let id = $(this).attr("data-id");

		swal({
			title: 'Yakin ingin menghapus misi ini?',
			text: 'Misi akan hilang setelah dihapus!',
			icon: 'warning',
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/config/delete_misi/' + id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Misi Berhasil Di Hapus!', {
							icon: 'success',
						});
						reload_table(misi_table);
					}
				});
			}
		});
	})

	//truncate table
	$(document).on("click", "#hapusTable", function() {
		let table = $(this).attr("data-table");

		swal({
			title: 'Yakin ingin menghapus data tabel ' + table + ' ?',
			text: 'Data pada tabel ' + table + ' akan hilang',
			icon: 'warning',
			buttons: true,
			showCancelButton: true,
			confirmButtonText: "Hapus",
			cancelButtonText: "Batal",
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/Truncate/truncateHandler/?table=' + table,
					type: 'DELETE',
					beforeSend: function(){
						show_loader();
					},
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
			            hide_loader();
						swal('Poof! Data pada tabel berhasil dihapus!', {
							icon: 'success',
						});

						reload_table(truncate_table);
					}
				});
			}
		});
	})
	
	$(document).on("click", "#lihatDetailTabel", function() {
		let table = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: '/Admin/Truncate/getTableDetail?table=' + table, 
            beforeSend: function(){
				show_loader();
			},
		})
		.done(function(data) {
			hide_loader();
			call_modal('#modal_detail_tabel',data);
		})
	})
	
	$(document).on("click", "#doRegression", function() {
		swal({
			title: 'Yakin ingin ganti kepengurusan?',
			text: 'Data kepengurusan sebelumnya akan hilang',
			icon: 'warning',
			buttons: true,
			showCancelButton: true,
		}).then((doRegression) => {
			if (doRegression) {
				$('#tableChecklist').submit();
			}
		})
	})

	$(document).on("submit", "#tableChecklist", function(e) {
		e.preventDefault();
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Feature/Regression',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(data) {
			hide_loader();
			swal('Selamat Datang Kepengurusan Baru!', {
				icon: 'success',
			});
			getWebStatus();
		})
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
	
	//modal nyusun gambar produk
	$(document).on("click", "#openModal", function() {
        let id = $(this).attr("data-id");

        $.ajax({
            url: "/Admin/Shop/rearanggeModal?id=" + id,
            type: "GET",
            dataType: "html", 
            beforeSend: function(){
                $('.modal-content').remove();
                // $("#item-preloader").show();
            },
        }).done(function (data) {
            // $('#item-preloader').hide(0);
            $('.modal-dialog').append(data).show();
			$(function () {
				$("#arrange").sortable({
					filter: ".number",
					update: function (event, ui) {
						var values = [];
						$(".listitemClass").each(function (index) {
							values.push($(this).attr("id"));
						});

						$("#outputvalues").val(values);

						$('#btn-updateOrder').prop("disabled", false);
					}, 
				});
			});
        })
    })

	//update susunan produk
	$(document).on('submit','#form-updateOrder',function(e){
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
            url: "/admin/shop/updateOrder",
            method: "POST",
            data: data,
			error: function() {
				swal('Error', 'Terjadi Kesalahan!', 'error');
			},
			success: function(data) {
				swal('Poof! Urutan gambar telah diubah!', {
					icon: 'success',
				});
				$('#staticBackdrop').modal('hide');
				item_table.ajax.reload(null, false);
			}
        })
    });

	$("[data-checkboxes]").each(function() {
		var me = $(this),
			group = me.data('checkboxes'),
			role = me.data('checkbox-role');

		me.change(function() {
			var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
			checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
			dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
			total = all.length,
			checked_length = checked.length;

			if(role == 'dad') {
			if(me.is(':checked')) {
				all.prop('checked', true);
			}else{
				all.prop('checked', false);
			}
			}else{
			if(checked_length >= total) {
				dad.prop('checked', true);
			}else{
				dad.prop('checked', false);
			}
			}
		});
	});

	//preview image
	const upload_file = select('#hero_img');
	const prev = select('.hidden_prev');
	
	upload_file.addEventListener("change", function() {
		const hero_img = select('.img-preview');

		let crop_image = $('#modal');
		let modal = select('#modal');

		let image = select('#sample_image');
		let cropper;

		let files = event.target.files;

		let done = function(url){
			image.src = url;
			crop_image.modal('show');
		};

		if(files && files.length > 0){
			reader = new FileReader();
			reader.onload = function(event)
			{
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
		});

		$('#crop').click(function(){
			canvas = cropper.getCroppedCanvas();

			canvas.toBlob(function(blob){
				var reader = new FileReader();
				reader.readAsDataURL(blob);
				reader.onloadend = function(e){
					crop_image.modal('hide');
					hero_img.src = e.target.result;
					prev.value = reader.result;
				}
			});
		});
	});

	function auto_grow(element) {
		element.style.height = "5px";
		element.style.height = element.scrollHeight + "px";
	}

	function getTitle(){
		return document.querySelector('#title').value;
	}
</script>