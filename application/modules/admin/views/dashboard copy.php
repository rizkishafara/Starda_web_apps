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
					<select class="form-select" aria-label="Default select example" name="users" onchange="showUser(this.value)">
						<option selected><?php echo date("Y"); ?></option>
						<?php foreach ($tahun as $year) { ?>
							<option value="<?= $year->year ?>"><?= $year->year?></option>
						<?php } ?>
					</select>

				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="chart-area">
						<canvas id="myChartArea"></canvas>
					</div>
				</div>
			</div>
		</div>

		<!-- Pie Chart -->
		<div class="col-xl-4 col-lg-5">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
					<div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
							<div class="dropdown-header">Dropdown Header:</div>
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="chart-pie pt-4 pb-2">
						<canvas id="myPieChart"></canvas>
					</div>
					<div class="mt-4 text-center small">
						<span class="mr-2">
							<i class="fas fa-circle text-primary"></i> Direct
						</span>
						<span class="mr-2">
							<i class="fas fa-circle text-success"></i> Social
						</span>
						<span class="mr-2">
							<i class="fas fa-circle text-info"></i> Referral
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php
	$label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

	for ($bulan = 1; $bulan < 13; $bulan++) {
		// $query = "SELECT sum(jumlah) as jumlah from tb_penjualan where MONTH(tgl_penjualan)='$bulan'";
		$query = "SELECT * FROM user_produk WHERE YEAR(upload_date) ='2022'AND MONTH(upload_date) = $bulan";
		$jumlah_produk[] = $this->db->query($query)->num_rows();
	}
	// $query = "SELECT COUNT(*) FROM user_produk WHERE MONTH(upload_date) ='2'";
	// $jumlah_produk= $this->db->query($query)->result();
	?>
</div>
<!-- /.container-fluid -->
<script type="text/javascript" src="<?= base_url('assets/chart.js/chart.js') ?>"></script>
<script>
	var ctx = document.getElementById("myChartArea").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: <?php echo json_encode($label); ?>,
			datasets: [{
				label: 'Unggahan Pengguna',
				data: <?php echo json_encode($jumlah_produk); ?>,
				borderWidth: 1
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