<?php include 'koneksi.php'; 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Profil</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

	<?php include 'menu.php'; ?>

	<?php 
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();

	// echo "<prev>";
	// print_r($pecah);
	// echo "</prev>";
?>

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Edit Profil <?php echo $id_pelanggan = $_SESSION["pelanggan"]["nama_pelanggan"]; ?></h3>
					</div>
					<div class="panel-body">
						<form method="post" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-3">Nama</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_pelanggan']; ?>">
								</div>
							</div>
							<!-- <fieldset enable>
								<div class="form-group">
								<label class="control-label col-md-3">Email</label>
								<div class="col-md-7">
									<label for="disabledTextInput"></label>
									<input type="text" id="disabledTextInput" class="form-control" value="<?php //echo $pecah['email_pelanggan']; ?>">
								</div>
							</div>
							</fieldset> -->
							
							<div class="form-group">
								<label class="control-label col-md-3">Alamat</label>
								<div class="col-md-7">
									<textarea class="form-control" rows="4" name="alamat">
										<?php echo $pecah['alamat_pelanggan']; ?>
									</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Telp/HP</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="telepon" value="<?php echo $pecah['telepon_pelanggan']; ?>">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-7 col-md-offset-3">
									<button class="btn btn-primary" name="edit">Ubah</button>
								</div>
							</div>
						</form>
						<?php 
						// jika tombol edit ditekan
						if (isset($_POST["edit"])) 
						{
							// mengambil nama,email,password,alamat,telepon
							$nama = $_POST['nama'];
							//$email = $_POST['email'];
							// $password = $_POST['password'];
							$alamat = $_POST['alamat'];
							$telepon = $_POST['telepon'];

								// update data
								$koneksi->query("UPDATE pelanggan SET nama_pelanggan='$_POST[nama]', telepon_pelanggan='$_POST[telepon]', alamat_pelanggan='$_POST[alamat]' WHERE id_pelanggan='$_GET[id]'");

								echo "<script>alert('ubah data berhasil');</script>";
								echo "<script>location='profil.php';</script>";
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>