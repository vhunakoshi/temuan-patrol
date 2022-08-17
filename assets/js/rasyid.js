$(function () {
	$(".tampilUserModalTambah").on("click", function () {
		$("#newUserModalLabel").html("Tambah User");
		$(".modal-footer button[type=submit]").html("Tambah");
		$("#id").val("");
		$("#name_user").val("");
		$("#username").val("").prop("readonly", false);
		$("#level").val("");
		$("#id_seksi").val("");
		$(".modal-body form").attr(
			"action",
			base_url+"admin/addMasterPetugas"
		);
	});

	$(".tampilUserModalUbah").on("click", function () {
		$("#newUserModalLabel").html("Edit User");
		$("#username").prop("readonly", true);
		$(".modal-footer button[type=submit]").html("Ubah");
		$(".modal-body form").attr(
			"action",
			base_url+"admin/updateMasterPetugas"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "getUbahMasterPetugas",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$("#name_user").val(data.name_user);
				$("#username").val(data.username);
				$("#level").val(data.level);
				$("#id_seksi").val(data.id_seksi).trigger("change");
				$("#id").val(data.id_user);
			},
		});
	});

	$(".tampilUserModalDelete").on("click", function () {
		const id = $(this).data("id");

		$.ajax({
			url: "getUbahMasterPetugas",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$(".DeleteModalBody").html(
					"klik Delete untuk menghapus data " + data.name_user
				);
				$(".btnDelete").attr(
					"href",
					base_url+"admin/hapus_petugas/" +
						data.id_user
				);
			},
		});
	});
});

$(function () {
	$(".tampilSeksiModalTambah").on("click", function () {
		$("#newSeksiModalLabel").html("Tambah Seksi");
		$(".modal-footer button[type=submit]").html("Tambah");
		$("#id").val("");
		$("#nama_seksi").val("");
		$(".modal-body form").attr(
			"action",
			base_url+"admin/addMasterSeksi"
		);
	});

	$(".tampilSeksiModalUbah").on("click", function () {
		$("#newSeksiModalLabel").html("Edit Seksi");
		$(".modal-footer button[type=submit]").html("Ubah");
		$(".modal-body form").attr(
			"action",
			base_url+"admin/updateMasterSeksi"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "getUbahMasterSeksi",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$("#kode_seksi").val(data.kode_seksi);
				$("#nama_seksi").val(data.nama_seksi);
				$("#id").val(data.id_seksi);
			},
		});
	});

	$(".tampilSeksiModalDelete").on("click", function () {
		const id = $(this).data("id");

		$.ajax({
			url: "getUbahMasterSeksi",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$(".DeleteModalBody").html(
					"klik Delete untuk menghapus data " + data.nama_seksi
				);
				$(".btnDelete").attr(
					"href",
					base_url+"admin/hapus_seksi/" +
						data.id_seksi
				);
			},
		});
	});
});

$(function () {
	$(".tampilZonaModalTambah").on("click", function () {
		$("#newZonaModalLabel").html("Tambah Zona");
		$(".modal-footer button[type=submit]").html("Tambah");
		$("#id").val("");
		$("#nama_zona").val("");
		$("#lokasi").val("");
		$(".modal-body form").attr(
			"action",
			base_url+"admin/addMasterZona"
		);
	});

	$(".tampilZonaModalUbah").on("click", function () {
		$("#newZonaModalLabel").html("Edit Zona");
		$(".modal-footer button[type=submit]").html("Ubah");
		$(".modal-body form").attr(
			"action",
			base_url+"admin/updateMasterZona"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "getUbahMasterZona",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$("#nama_zona").val(data.nama_zona);
				$("#lokasi").val(data.lokasi);
				$("#id").val(data.id_zona);
			},
		});
	});

	$(".tampilZonaModalDelete").on("click", function () {
		const id = $(this).data("id");

		$.ajax({
			url: "getUbahMasterZona",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$(".DeleteModalBody").html(
					"klik Delete untuk menghapus data " + data.nama_zona
				);
				$(".btnDelete").attr(
					"href",
					base_url+"admin/hapus_zona/" +
						data.id_zona
				);
			},
		});
	});
});

$(function () {
	$(".tampilTimModalTambah").on("click", function () {
		$("#newTimModalLabel").html("Tambah Tim");
		$(".modal-footer button[type=submit]").html("Tambah");
		$("#id").val("");
		$("#nama_tim").val("");
		$("#id_user").val("");
		$("#image").val("");
		$(".modal-body form").attr(
			"action",
			base_url+"admin/addMasterTim"
		);
	});

	$(".tampilTimModalUbah").on("click", function () {
		$("#newTimModalLabel").html("Edit Tim");
		$(".modal-footer button[type=submit]").html("Ubah");
		$(".modal-body form").attr(
			"action",
			base_url+"admin/updateMasterTim"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "getUbahMasterTim",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$("#nama_tim").val(data.nama_tim);
				$("#id_user").val(data.id_user).trigger("change");
				$("#logo_tim").val(data.logo_tim).trigger("choose");
				$("#id").val(data.id_tim);
			},
		});
	});

	$(".tampilTimModalDelete").on("click", function () {
		const id = $(this).data("id");

		$.ajax({
			url: "getUbahMasterTim",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$(".DeleteModalBody").html(
					"klik Delete untuk menghapus data " + data.nama_tim
				);
				$(".btnDelete").attr(
					"href",
					base_url+"admin/hapus_tim/" + data.id_tim
				);
			},
		});
	});
});

$(function () {
	$(".remove").on("click", function () {
		$("#id_seksi").val("");
		$("#foto_bukti_temuan").val("");
		$("#keterangan").val("");
		$("#kategori").val("");
	});
});

$(function () {
	$(".tampilModalPerbaikan").on("click", function () {
		const id = $(this).data("id");
		$("#id_temuan").val(id);
	});
});

$(function () {
	$(".tampilModalVerifikasi").on("click", function () {
		const id = $(this).data("id");
		const id_temuan = $(this).data("id_temuan");
		$("#id_perbaikan").val(id);
		$("#id_temuan").val(id_temuan);
	});
});

$(function () {
	$(".tampilJadwalModalTambah").on("click", function () {
		$("#newJadwalModalLabel").html("Tambah Jadwal Patrol");
		$(".modal-footer button[type=submit]").html("Tambah");
		$("#id").val("");
		$("#id_tim").val("");
		$("#id_zona").val("");
		$("#tgl_patrol").val("");
		$(".modal-body form").attr(
			"action",
			base_url+"admin/addJadwalPatrol"
		);
	});

	$(".tampilJadwalModalUbah").on("click", function () {
		$("#newJadwalModalLabel").html("Edit Jadwal Patrol");
		$(".modal-footer button[type=submit]").html("Ubah");
		$(".modal-body form").attr(
			"action",
			base_url+"admin/updateJadwalPatrol"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "getUbahJadwalPatrol",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$("#id_tim").val(data.id_tim).trigger("change");
				$("#id_zona").val(data.id_zona).trigger("change");
				$("#tgl_patrol").val(data.tgl_patrol);
				$("#id").val(data.id_jadwal);
			},
		});
	});

	$(".tampilJadwalModalInfo").on("click", function () {
		const id = $(this).data("id");

		$.ajax({
			url: "getUbahJadwalPatrol",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$("#infoNamaTim").html(data.nama_tim);
				$("#infoZona").html(data.nama_zona);
				$("#infoLokasi").html(data.lokasi);
				$("#infoJadwalPatrol").html(data.tgl_patrol);
				$("#infoStatusJob").html(data.status);

				$.ajax({
					url: "getUbahMasterPetugas",
					data: {
						id: data.id_user,
					},
					method: "post",
					dataType: "json",
					success: function (data2) {
						$("#infoKetuaTim").html(data2.name_user);
					},
				});

				$.ajax({
					url: "getUbahAnggota",
					data: {
						id: data.id_tim,
					},
					method: "post",
					dataType: "json",
					success: function (data3) {
						var html = "";
						var i;
						for (i = 0; i < data3.length; i++) {
							html +=
								"<p> - " +
								data3[i].name_user +
								" [" +
								data3[i].nama_seksi +
								"] </p>";
						}
						$("#infoAnggotaTeam").html(html);
					},
				});
			},
		});
	});

	$(".tampilJadwalModalDelete").on("click", function () {
		const id = $(this).data("id");

		$.ajax({
			url: "getUbahJadwalPatrol",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$(".DeleteModalBody").html(
					"klik Delete untuk menghapus jadwal " +
						data.nama_tim +
						" pada tanggal " +
						data.tgl_patrol
				);
				$(".btnDelete").attr(
					"href",
					base_url+"admin/hapus_jadwal/" +
						data.id_jadwal
				);
			},
		});
	});

	$(".tampilJadwalModalInfoKaryawan").on("click", function () {
		const id = $(this).data("id");

		$.ajax({
			url: "getUbahJadwalPatrol",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$("#infoNamaTim").html(data.nama_tim);
				$("#infoZona").html(data.nama_zona);
				$("#infoLokasi").html(data.lokasi);
				$("#infoJadwalPatrol").html(data.tgl_patrol);
				$("#infoStatusJob").html(data.status);
				$(".upload_bukti").attr(
					"href",
					base_url+"karyawan/v_uploadbuktiverifikasi/" +
						data.id_jadwal
				);
				$(".upload_temuan").attr(
					"href",
					base_url+"karyawan/v_uploadbuktitemuan/" +
						data.id_jadwal
				);
				$(".upload_perbaikan").attr(
					"href",
					base_url+"karyawan/v_uploadbuktiperbaikan/" +
						data.id_jadwal
				);

				$.ajax({
					url: "getUbahMasterPetugas",
					data: {
						id: data.id_user,
					},
					method: "post",
					dataType: "json",
					success: function (data2) {
						$("#infoKetuaTim").html(data2.name_user);
					},
				});

				$.ajax({
					url: "getUbahAnggota",
					data: {
						id: data.id_tim,
					},
					method: "post",
					dataType: "json",
					success: function (data3) {
						var html = "";
						var i;
						for (i = 0; i < data3.length; i++) {
							html +=
								"<p> - " +
								data3[i].name_user +
								" [" +
								data3[i].nama_seksi +
								"] </p>";
						}
						$("#infoAnggotaTeam").html(html);
					},
				});
			},
		});
	});
});
