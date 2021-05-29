<h2>Selamat Datang Admin</h2>
<?php
include '../koneksi.php';
 
 $ip      = $_SERVER['REMOTE_ADDR']; 
 $tanggal = date("Ymd"); 
 $waktu   = time(); 
  
 $s = mysqli_query($koneksi, "SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
 
 
 if(mysqli_num_rows($s) == 0){
     mysqli_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
 }
 else{
     mysqli_query($koneksi,"UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
 }
 
 $pengunjung       = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip")); 
 $bataswaktu       = time() - 300;
 $pengunjungonline = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM statistik WHERE online > '$bataswaktu'")); 
 ?> 
 
 <h4>Pengunjung Hari ini : <strong> <?php echo $pengunjung; ?> </strong></h4><br>
 <h4> Pengunjung Online : <strong> <?php echo $pengunjungonline; ?> </strong></h4>
 <?php
    //Simpan Data Statistik Website
    $ip      = $_SERVER['REMOTE_ADDR']; 
    $tanggal = date("Ymd");
    $waktu   = time();  

    $s = mysqli_query($koneksi,"SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
    // jika belum ada, simpan data user ke database
    if(mysqli_num_rows($s) == 0){
    mysqli_query($koneksi,"INSERT INTO statistik (ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
    } 
    else{
    mysqli_query($koneksi,"UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
    }
?>
<!-- <pre><?php print_r($_SESSION); ?></pre> -->