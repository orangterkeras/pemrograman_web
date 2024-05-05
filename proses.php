<!-- PROSES INPUTAN DARI FORM PENDAFTARAN -->
<?php 
    $errnama = $errgender = $errtempat_lahir = $errtanggal_lahir = $erralamat = $errasal = $errupload_ijazah = $errupload_resi = "";
    $vnama = $vgender = $vtempat_lahir = $vtanggal_lahir = $valamat = $vasal = "";
    $error = false;
  
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if (empty($_POST['nama'])) {
        $errnama = "nama lengkap wajib di isi!";
        $error = true;
      } else {
        $vnama = $_POST['nama'];
      }
  
      if (empty($_POST['gender'])) {
        $errgender = "jenis kelamin wajib di isi!";
        $error = true;
      } else {
        $vgender = $_POST['gender'];
      }
  
      if (empty($_POST['tempat_lahir'])) {
        $errtempat_lahir = "tempat lahir wajib di isi!";
        $error = true;
      } else {
        $vtempat_lahir = $_POST['tempat_lahir'];
      }
  
      if (empty($_POST['tanggal_lahir'])) {
        $errtanggal_lahir = "tanggal lahir wajib di isi!";
        $error = true;
      } else {
        $vtanggal_lahir = $_POST['tanggal_lahir'];
      }
  
      if (empty($_POST['alamat'])) {
        $erralamat = "alamat wajib di isi!";
        $error = true;
      } else {
        $valamat = $_POST['alamat'];
      }
  
      if (empty($_POST['asal'])) {
        $errasal = "asal sekolah wajib di isi!";
        $error = true;
      } else {
        $vasal = $_POST['asal'];
      }
  
      if (empty($_FILES['upload_ijazah']['name'])) {
        $errupload_ijazah = "file ijazah wajib di isi!";
        $error = true;
      } else {
        $vupload_ijazah = $_FILES['upload_ijazah']['name'];
      }
  
      if (empty($_FILES['upload_resi']['name'])) {
        $errupload_resi = "file resi Pembayaran wajib di isi!";
        $error = true;
      } else {
        $vupload_resi = $_FILES['upload_resi']['name'];
      }
      if ($error == 0) {
        include ("./services/config.php");
        $nama = $_POST['nama'];
        $gender = $_POST['gender'];
        // Menggunakan $tmpt_tgl_lahir yang telah digabungkan
        $tempat_tanggal_lahir = $tmpt_tgl_lahir;
        $asal = $_POST['asal'];
        $upload_ijazah = $_FILES['upload_ijazah']['name'];
        $upload_resi = $_FILES['upload_resi']['name'];
  
        // Menyimpan data ke database
        $sql = "INSERT INTO pendaftaran_siswa (nama, gender, tmpt_tglLahir, asal_sekolah, ijazah, bukti_bayar, status) VALUES ('$nama', '$gender', '$tempat_tanggal_lahir', '$asal', '$upload_ijazah', '$upload_resi', 'pending')";
  
        $result = $conn->query($sql);
        if ($result) {
          echo "<h5>Berhasil Simpan Data!</h5>";
          // echo "<a href='index.php'>Lihat Data</a>";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
    }
?>