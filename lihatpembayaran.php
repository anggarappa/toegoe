<?php  
session_start();
include 'koneksi.php';

$id_pembelian = $_GET['id'];

$get = $koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
	WHERE pembelian.id_pembelian='$id_pembelian'");
$detailbayar = $get->fetch_assoc();

// echo "<pre>";
// print_r($detailbayar);
// echo "</pre>";


// jika belum ada data pembayaran
if (empty($detailbayar)) 
{
	echo "<script>alert('data pembayaran tidak ada')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

// jika data pelanggan yang bayar tidak sesuai dengan yang login
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

if ($_SESSION['pelanggan']['id_pelanggan'] !==$detailbayar["id_pelanggan"]) 
{
	echo "<script>alert('data pembayaran bukan milik anda')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lihat Pembayaran</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

	<?php include 'menu.php'; ?>

	<div class="container">
		<h3>Lihat Pembayaran</h3>
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<tr>
						<th>Nama</th>
						<td><?php echo $detailbayar['nama'] ?></td>
					</tr>
					<tr>
						<th>Bank</th>
						<td><?php echo $detailbayar['bank'] ?></td>
					</tr>
					<tr>
						<th>Tanggal</th>
						<td><?php echo $detailbayar['tanggal'] ?></td>
					</tr>
					<tr>
						<th>Jumlah</th>
						<td>Rp. <?php echo number_format($detailbayar['jumlah']); ?></td>
					</tr>

				</table>
			</div>
			<div class="col-md-6">
				<img src="bukti_pembayaran/<?php echo $detailbayar["bukti"] ?>" alt="" class="img-responsive">
			</div>
		</div>
	</div>

</body>
</html>