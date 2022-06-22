<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->

		<div class="col-xl-3 col-md-6 mb-4">
			<a href="<?= base_url('admin/useradmin') ?>">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
									Admin</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $useradmin ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-user-cog fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<a href="<?= base_url('admin/userdata') ?>">
				<div class="card border-left-success shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
									Member</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $usermember ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-user fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<a href="<?= base_url('admin/usernonactive') ?>">
				<div class="card border-left-info shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengajuan Akun
								</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
										<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $delaymember ?></div>
									</div>
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-user-plus fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<a href="<?= base_url('admin/media/mediapending') ?>">
				<div class="card border-left-danger shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
									Pertinjauan Media</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mediapending ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-photo-video fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>

	</div>

	<!-- Content Row -->

	<div class="row">

		<!-- Area Chart -->
		<div class="col-xl-8 col-lg-7">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Grafik Unggahan Pengguna</h6>
					<!-- <div id="myChart"><?= json_encode($jumlah_produk); ?></div> -->

					<!-- <select class="col-3 form-control" name="yeartahun" id="yeartahun">
						<option value=" <?= date("Y") ?>" selected><?= date("Y") ?></option>
						<?php foreach ($tahun as $year) { ?>
							<option value="<?= $year->year ?>"><?= $year->year ?></option>
						<?php } ?>
					</select> -->

				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="chart-area">
						<canvas id="myChartArea" name="myChartArea" style="display: block;height: 325px;width: 741px;"></canvas>
						<!-- <div id="myChart" name="myChart"></div> -->
					</div>
				</div>
			</div>
		</div>

		<!-- Pie Chart -->
		<div class="col-xl-4 col-lg-5">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Penguna</h6>

				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="chart-pie pt-4 pb-2" style="height: 100%;">
						<canvas id="myChartPie" name=""></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php
	$label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
	foreach ($kategori_user as $kat) {
		$kategori[] = $kat['category_user'];
		$count[] = "getRandomColor()";
	}

	$count_kategori = count($kategori_user) - 1;
	$p = str_replace('"', '', json_encode($count));


	// $query = "SELECT COUNT(*) FROM user_produk WHERE MONTH(upload_date) ='2'";
	// $jumlah_produk= $this->db->query($query)->result();
	?>
</div>
<!-- /.container-fluid -->



<script type="text/javascript" src="<?= base_url('assets/chart.js/chart.js') ?>"></script>
<!-- diagram lingkaran -->
<script>
	var ctx = document.getElementById("myChartPie");
	var kat = <?= json_encode($kategori); ?>;
	var myChartPie = new Chart(ctx, {
		type: 'doughnut',
		data: {

			labels: kat,
			datasets: [{
				label: false,
				data: <?= json_encode($jumlah_user_kat); ?>,

				backgroundColor: <?= $p ?>
			}]
		},
		options: {
			maintainAspectRatio: false,
			responsive: true
		}
	});

	function getRandomColor() {
		var letters = '789ABCD'.split('');
		var color = '#';
		for (var i = 0; i < 6; i++) {
			color += letters[Math.round(Math.random() * 6)];
		}
		return color;
	}
</script>


<!-- diagram batang -->
<script>
	var ctx = document.getElementById("myChartArea").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		options: {
			maintainAspectRatio: false
		},
		data: {
			labels: <?php echo json_encode($label); ?>,
			datasets: [{
				label: 'Unggahan Pengguna',
				data: <?php
						if (empty($jumlah_prod)) {
							echo json_encode($jumlah_produk);
						} else {
							echo json_encode($jumlah_prod);
						}

						?>,
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						userCallback: function(label, index, labels) {
							// when the floored value is the same as the value we have a whole number
							if (Math.floor(label) === label) {
								return label;
							}

						},
					}
				}]
			}
		}
	});
</script>
<!-- ajax grafik -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
	$(document).ready(function() {

		$('#yeartahun').change(function() {
			var thn = $(this).val();
			$.ajax({
				url: "<?= base_url('admin/dashboard/jumlah_produk'); ?>",
				method: "POST",
				data: {
					thn: thn
				},
				async: true,
				success: function(data) {
					console.log(data);
					var value = [];
					// for (var i in data) {
					// 	value.push(data[i].<?= json_encode($jumlah_produk) ?>);
					// }
					$('#myChartArea').html(data);
					value.push(data);

					var ctx = document.getElementById("myChartArea").getContext('2d');
					var myChart = new Chart(ctx, {
						type: 'bar',
						// options: {
						// 	maintainAspectRatio: false
						// },
						data: {
							labels: <?php echo json_encode($label); ?>,
							datasets: [{
								label: 'Unggahan Pengguna',
								data: value,
							}]
						},
						options: {
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true,
										userCallback: function(label, index, labels) {
											// when the floored value is the same as the value we have a whole number
											if (Math.floor(label) === label) {
												return label;
											}

										},
									}
								}]
							}
						}
					});
				}
			});
			return false;
		});

	});
</script>
<script>
	// $(document).ready(function() {

	// 	$('#yeartahun').change(function() {
	// 		var thn = $(this).val();
	// 		$.ajax({
	// 			url: "<?= base_url('admin/dashboard/jumlah_produk'); ?>",
	// 			method: "POST",
	// 			data: {
	// 				thn: thn
	// 			},
	// 			async: true,
	// 			success: function(data) {

	// 				$('#myChartArea').html(data);

	// 			}
	// 		});
	// 		return false;
	// 	});

	// });
</script>