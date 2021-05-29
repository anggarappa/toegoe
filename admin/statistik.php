<?php
 // skrip koneksi database
include '../koneksi.php';
 
 $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
 $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
 $waktu   = time(); //
  
 // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini
 $s = mysqli_query($koneksi, "SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
 
 
 // Kalau belum ada, simpan data user tersebut ke database
 if(mysqli_num_rows($s) == 0){
     mysqli_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
 }
 // Jika sudah ada, update
 else{
     mysqli_query($koneksi,"UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
 }
 
 $pengunjung       = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip")); // Hitung jumlah pengunjung
//  $totalpengunjung  = mysqli_num_rows(mysqli_query($koneksi,"SELECT COUNT(hits) FROM statistik"), 0); // hitung total pengunjung
 $bataswaktu       = time() - 300;
 $pengunjungonline = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM statistik WHERE online > '$bataswaktu'")); // hitung pengunjung online
 ?> 
 
 <h2><span class="badge badge-secondary">Pengunjung Hari ini : <?php echo $pengunjung; ?> </span></h2><br>
 <!-- Total : <?php echo $totalpengunjung; ?> -->
 <strong> <h2> Pengunjung Online : <?php echo $pengunjungonline; ?> </h2></strong>
 <?php
    //Simpan Data Statistik Website
    $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
    $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
    $waktu   = time(); // 
    // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
    $s = mysqli_query($koneksi,"SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
    // Kalau belum ada, simpan data user tersebut ke database
    if(mysqli_num_rows($s) == 0){
    mysqli_query($koneksi,"INSERT INTO statistik (ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
    } 
    else{
    mysqli_query($koneksi,"UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
    }
?>