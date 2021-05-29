<?php 
session_start();
include 'koneksi.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
			 <div class="panel panel-default">
			 	<div class="panel-heading">
			 		<h3 class="panel-title">Login Pelanggan</h3>
			 	</div>
			 	<div class="panel-body">
			 		<form method="post">
			 			<div class="form-group">
			 				<label>Email</label>
			 				<input type="email" name="email" class="form-control">
			 			</div>
			 			<div class="form-group">
			 				<label>Password</label>
			 				<input type="password" name="password" class="form-control">
			 			</div>
			 			<button class="btn btn-primary" name="login">Login</button>
			 			<hr />
						Not registered ? <a href="daftar.php">click here</a>
			 		</form>
			 	</div>

			 	<?php 
				//jika ada tombol simpan(tombol ditekan)
				if (isset($_POST["login"])) {
					$email = $_POST["email"];
					$password = $_POST["password"];
					#lakukan query mengecek akun ditabel pelanggan pada db
					$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND pass_pelanggan='$password'");

					//hitung akun yang terambil
					$akuncocok = $ambil->num_rows;

					//jika 1 akun yang cocok, maka login
					if ($akuncocok==1) {
						//anda sudah login
						//mendapatkan akun dalam bentuk array
						$akun = $ambil->fetch_assoc();
						//simpan di session pelanggan
						$_SESSION["pelanggan"] = $akun;
						echo "<div class='alert alert-info'>Login Sukses</div>";
						// echo "<script>alert('Anda sukses login');</script>";

						// jika sudah belanja
						if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) 
						{
							echo "<script>location='checkout.php';</script>";
						}
						else
						{
							echo "<script>location='riwayat.php';</script>";
						}
					}
					else{
						//anda gagal login
						echo "<script>alert('Anda gagal login, periksa kembali akun Anda');</script>";
						echo "<script>location='login.php';</script>";
					}
				}

				?>

			 </div>
		</div>
	</div>
</div>

</body>
</html>