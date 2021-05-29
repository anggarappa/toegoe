<?php  
session_start();
include 'koneksi.php';
?>
<?php

// jika tidak ada session pelanggan
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php';</script>";
	exit();	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

	<?php include 'menu.php'; ?>


<section class="riwayat">
	<div class="container">
		<h3>Profile <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3><br>

				<?php 
				// mendapatkan id pelanggan yang login dari session
				$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
				$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
				while($pecah = $ambil->fetch_assoc()){
				?>

			<div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h5 class="mb-0">Nama Lengkap</h5>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <h5><?php echo $pecah["nama_pelanggan"] ?></h5>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h5 class="mb-0">Email</h5>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <h5><?php echo $pecah["email_pelanggan"] ?></h5>
                    </div>
                  </div>
                  <hr>
                  <!-- <div class="row">
                    <div class="col-sm-3">
                      <h5 class="mb-0">Password</h5>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <h5><?php // echo $pecah["pass_pelanggan"] ?></h5>
                    </div>
                  </div>
                  <hr> -->
                  <div class="row">
                    <div class="col-sm-3">
                      <h5 class="mb-0">Telepon</h5>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <h5><?php echo $pecah["telepon_pelanggan"] ?></h5>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h5 class="mb-0">Alamat</h5>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <h5><?php echo $pecah["alamat_pelanggan"] ?></h5>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " href="editprofil.php?&id=<?php echo $pecah['id_pelanggan']; ?>">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
				
				<?php } ?>
	</div>
</section>

</body>
</html>