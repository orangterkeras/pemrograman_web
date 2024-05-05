<?php
$errnama = $errgender = $errtempat_lahir = $errtanggal_lahir = $erralamat = $errasal = $errupload_ijazah = $errupload_resi = "";
$vnama = $vgender = $vtempat_lahir = $vtanggal_lahir = $valamat = $vasal = "";
$error = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (empty($_POST['nama'])) {
    $errnama = "Nama Lengkap Harus Diisi!";
    $error = true;
  } else {
    $vnama = $_POST['nama'];
  }

  if (empty($_POST['gender'])) {
    $errgender = "Jenis Kelamin Harus Diisi!";
    $error = true;
  } else {
    $vgender = $_POST['gender'];
  }

  if (empty($_POST['tempat_lahir'])) {
    $errtempat_lahir = "Tempat Lahir Harus Diisi!";
    $error = true;
  } else {
    $vtempat_lahir = $_POST['tempat_lahir'];
  }

  if (empty($_POST['tanggal_lahir'])) {
    $errtanggal_lahir = "Tanggal Lahir Harus Diisi!";
    $error = true;
  } else {
    $vtanggal_lahir = $_POST['tanggal_lahir'];
  }

  if (empty($_POST['alamat'])) {
    $erralamat = "Alamat Harus Diisi!";
    $error = true;
  } else {
    $valamat = $_POST['alamat'];
  }

  if (empty($_POST['asal'])) {
    $errasal = "Asal Sekolah Harus Diisi!";
    $error = true;
  } else {
    $vasal = $_POST['asal'];
  }

  if (empty($_FILES['upload_ijazah']['name'])) {
    $errupload_ijazah = "File Ijazah Harus Diisi!";
    $error = true;
  } else {
    $vupload_ijazah = $_FILES['upload_ijazah']['name'];
  }

  if (empty($_FILES['upload_resi']['name'])) {
    $errupload_resi = "File Resi Pembayaran Harus Diisi!";
    $error = true;
  } else {
    $vupload_resi = $_FILES['upload_resi']['name'];
  }


  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include ("services/config.php");
    $q = mysqli_query($conn, "SELECT id_reg FROM mahasiswa ORDER BY id_reg DESC LIMIT 1");
    $datax = mysqli_fetch_array($q);

    if ($datax) {
      $no_terakhir = substr($datax['id_reg'], -3);
      $no = $no_terakhir + 1;
      $new_no = sprintf('%03d', $no);
      $tahun = date('Y');
      $kode = "INV-" . $tahun . '-' . $new_no;
    } else {
      $kode = "INV-" . date('Y') . '-001';
    }
    $no = $kode;
    if ($error == 0) {
      $nama = $_POST['nama'];
      $gender = $_POST['gender'];
      $tempat_lahir = $_POST['tempat_lahir'];
      $tanggal_lahir = $_POST['tanggal_lahir'];
      $alamat = $_POST['alamat'];
      $asal_sekolah = $_POST['asal'];
      $folder = "backend/upload/";
      $nama_file_ijazah = $_FILES['upload_ijazah']['name'];
      $nama_file_pembayaran = $_FILES['upload_resi']['name'];
      $tmp_file_ijazah = $_FILES['upload_ijazah']['tmp_name'];
      $tmp_file_pembayaran = $_FILES['upload_resi']['tmp_name'];
      move_uploaded_file($tmp_file_ijazah, $folder . $nama_file_ijazah);
      move_uploaded_file($tmp_file_pembayaran, $folder . $nama_file_pembayaran);
      if ($_FILES['upload_ijazah']['size'] >= 500000 || $_FILES['upload_resi']['size'] >= 500000) {
        $k1 =  "File Terlalu Besar!";
    } else {
        $tipe_ijazah = strtolower(pathinfo($_FILES['upload_ijazah']['name'], PATHINFO_EXTENSION));
        $tipe_resi = strtolower(pathinfo($_FILES['upload_resi']['name'], PATHINFO_EXTENSION));
    
        if ($tipe_ijazah != 'jpg' || $tipe_resi != 'jpg') {
            $k2 = "File harus bertipe jpg";
        } else {
            move_uploaded_file($_FILES['upload_ijazah']['tmp_name'], $target_ijazah);
            move_uploaded_file($_FILES['upload_resi']['tmp_name'], $target_resi);
            $k3 = "File Berhasil diupload!";
        }
    }
    
    
    $tempat_tanggal_lahir = $tempat_lahir . ' - ' . $tanggal_lahir;
    $sql = "INSERT INTO mahasiswa (id_reg, nama, gender, tmpt_tglLahir, alamat,  asal_sekolah, ijazah, bukti_bayar) 
        VALUES ('$no', '$nama', '$gender', '$tempat_tanggal_lahir', '$alamat', '$asal_sekolah', '$nama_file_ijazah', '$nama_file_pembayaran')";
    if (mysqli_query($conn, $sql)) {
      // echo "Data berhasil disimpan.";
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
  }
}
}