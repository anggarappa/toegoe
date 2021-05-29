<?php 
session_start();
include 'koneksi.php';

// jika tidak ada session pelanggan
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php';</script>";
	exit();	
}

// mendapatkan id pembelian dari url
$idpembelian = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpembelian'");
$detailpembelian = $ambil->fetch_assoc();

// echo "<pre>";
// echo print_r($detailpembelian);
// echo print_r($_SESSION);
// echo "</pre>";

// mendapatkan id pelanggan yang beli
$id_pelanggan_beli = $detailpembelian["id_pelanggan"];
// mendapatkan id pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !==$id_pelanggan_beli) 
{
	// echo "<script>alert('silahkan login');</script>";
	echo "<script>location='index.php';</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

	<?php include 'menu.php'; ?>


	<div class="container">
		<h2>Konfirmasi Pembayaran</h2>
		<P>Kirim bukti pembayaran disini</P>
		<div class="alert alert-info">Total tagihan Anda <strong>Rp. <?php echo number_format($detailpembelian["total_pembelian"]) ?></strong></div>

		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Penyetor</label>
				<input type="text" class="form-control" name="nama">
			</div>
			<div class="form-group">
				<label>Bank</label>
				<input type="text" class="form-control" name="bank">
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" min="1">
			</div>
			<div class="form-group">
				<label>Foto Bukti Pembayaran</label>
				<input type="file" class="form-control" name="bukti">
				<p class="text-danger">foto bukti maksimal 2MB</p>
			</div>
			<button class="btn btn-primary" name="kirim">Kirim</button>
		</form>
	</div>

<?php 
if (isset($_POST["kirim"])) 
{
	// upload foto bukti pembayaran
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafiks = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");


	// simpan pembayaran
	$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpembelian','$nama','$bank','$jumlah','$tanggal','$namafiks')");

	// update data pembelian dari pending ke sukses
	$koneksi->query("UPDATE pembelian SET status_pembelian='sukses' WHERE id_pembelian='$idpembelian'");

	echo "<script>alert('bukti pembayaran sukses terkirim');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

</body>
</html>