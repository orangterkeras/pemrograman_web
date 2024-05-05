<html>

<head>
  <title>Pendaftaran Mahasiswa Baru</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
    rel="stylesheet" />
  <!-- Feather-icons -->
  <script src="https://unpkg.com/feather-icons"></script>
  <!-- Styles -->
  <link rel="stylesheet" href="./assets/css/style.css" />
  <link id="favicon" rel="shortcut icon" href="/assets/image/fikom.jpg" />
</head>

<body>
  <!-- Navbar Start -->
  <nav class="navbar">
    <a href="#" class="navbar-logo">
      <img src="image/komputer.png" alt="Fakultas Ilmu Komputer">
      <div class="logo-text">
        <span>Universitas</span>
        <span>Methodist Indonesia</span>
      </div>
    </a>
    <div class="navbar-nav">
      <a href="#about">Info</a>
      <a href="#form">Pendaftaran</a>
      <a href="#hasil">Hasil</a>
    </div>
    <div class="navbar-extra">
      <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>
  </nav>

  <!-- Navbar End -->

  <!-- Info Section Start  -->
  <section id="about" class="about">
    <h2><span>Fakultas</span> Ilmu Komputer</h2>
    <div class="row">
      <div class="about-img">
        <img src="./assets/image/alur pmb.png" alt="alur Pendaftaran" />
      </div>
      <div class="content">
        <h3>Pendaftaran Mahasiswa/i Baru</h3>
        <p>
          (FIKOM) dengan jenjang Strata 1 (S-1) dengan program studi Teknik Informatika dan Sistem Informasi
          merupakan
          program studi yang didisain untuk menghasilkan tenaga-tenaga professional dan ahli-ahli computer
          yang nantinya
          mampu menjawab tantangan-tantangan Global berupa pembangunan system informasi yang mampu membuat dan
          mempermudah pekerjan manusia serta mampu menciptakan lapangan kerja.
        </p>
        <a href="#form" class="btn">Mulai Mendaftar</a>
      </div>
    </div>
  </section>
  <!-- Info Section End -->


  <!-- Pendaftaran Section Start -->
  <?php
  include ("backend/insert.php")
    ?>
  <section id="form" class="form">
    <h1>Form Pendaftaran Siswa Baru</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
      Nomor Pendaftaran:
      <input type="text" id="id_reg" name="id_reg" value="" readonly placeholder="code-automatic"
        style="border: 2px solid #ccc;"><br>

      <p><span style="color : red;">* </span>Nama Lengkap: <span
          style="color:red; font-style:italic; font-size: smaller;"><?php echo $errnama; ?></span></p>
      <input type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap" style="border: 2px solid #ccc;"><br>

      <p><span style="color : red;">* </span>Jenis Kelamin: <span
          style="color:red; font-style:italic; font-size: smaller;"><?php echo $errgender; ?></span></p>
      <select id="gender" name="gender" style="border : 1.5px solid #ccc">
        <option value="">Pilih Jenis Kelamin</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
        <option value="Perempuan">Lainnya</option>
      </select><br>

      <p><span style="color : red;">* </span>Tempat Lahir: <span
          style="color:red; font-style:italic; font-size: smaller; "><?php echo $errtempat_lahir; ?></span></p>
      <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir"
        style="border: 2px solid #ccc;"> <br>

      <p><span style="color : red;">* </span>Tanggal Lahir: <span
          style="color:red; font-style:italic; font-size: smaller;"><?php echo $errtanggal_lahir; ?></span></p>
      <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="tanggal_lahir"
        style="border: 2px solid #ccc;"><br>

      <p><span style="color : red;">* </span>Alamat Lengkap: <span
          style="color:red; font-style:italic; font-size: smaller;"><?php echo $erralamat; ?></span></p>
      <textarea id="alamat" name="alamat" placeholder="Masukkan Alamat Lengkap"
        style="border: 2px solid #ccc;"></textarea><br>

      <p><span style="color : red;">* </span>Asal Sekolah: <span
          style="color:red; font-style:italic; font-size: smaller;"><?php echo $errasal; ?></span></p>
      <input type="text" id="asal" name="asal" placeholder="Masukkan Asal Sekolah" style="border: 2px solid #ccc;"><br>

      <p><span style="color : red;">* </span>Upload Ijazah: <span
          style="color:red; font-style:italic; font-size: smaller;"><?php echo $errupload_ijazah; ?></span></p>
      <input type="file" id="upload_ijazah" name="upload_ijazah" accept=".pdf,.jpg,.zip"
        style="border: 2px solid #ccc; "><br>

      <p><span style="color : red;">* </span>Upload Resi Pembayaran: <span
          style="color:red; font-style:italic; font-size: smaller;"><?php echo $errupload_resi; ?></span></p>
      <input type="file" id="upload_resi" name="upload_resi" accept=".pdf,.jpg,.zip"
        style="border: 2px solid #ccc; "><br>

      <button type="submit">Daftar</button>

    </form>
  </section>
  <!-- Pendafataran Section End -->

  <!-- Hasil Section Start -->
  <?php
  include ("./services/config.php"); 
  
 
  function deleteMahasiswa($conn, $no)
  {
    $sql = "DELETE FROM mahasiswa WHERE id_reg = $no";
    if ($conn->query($sql) === TRUE) {
      return true; 
    } else {
      return false; 
    }
  }

  // Cek apakah request POST delete telah dikirim
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $idToDelete = $_POST["delete_id"];

    // Panggil fungsi deleteMahasiswa untuk menghapus data
    $deleteResult = deleteMahasiswa($conn, $idToDelete);

    if ($deleteResult) {
      echo "Data berhasil dihapus.";
    } else {
      echo "Terjadi kesalahan saat menghapus data.";
    }
  }

  // Query database untuk mendapatkan data mahasiswa
  $sql = "SELECT * FROM mahasiswa";
  $result = $conn->query($sql);
  ?>


<section id="hasil" class="hasil" style="display: block;">
    <!-- section hasil start -->
    <h1>Hasil Pendaftaran</h1>
    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>No. Pendaftaran</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat, Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Asal Sekolah</th>
                    <th>Ijazah</th>
                    <th>Bukti bayar</th>
                    <th>Status Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $data['id_reg'] . "</td>";
                    echo "<td>" . $data['nama'] . "</td>";
                    echo "<td>" . $data['gender'] . "</td>";
                    echo "<td>" . $data['tmpt_tglLahir'] . "</td>";
                    echo "<td>" . $data['alamat'] . "</td>";
                    echo "<td>" . $data['asal_sekolah'] . "</td>";
                    echo "<td>" . $data['ijazah'] . "</td>";
                    echo "<td>" . $data['bukti_bayar'] . "</td>";
                    echo "<td>" . $data['status'] . "</td>";
                    echo "<td>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='delete_id' value='" . $data['id_reg'] . "'>";
                    echo "<button type='submit' class='delete' onclick=\"return confirm('Apakah Anda yakin untuk menghapus data ini?')\">Delete</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

  

  <!-- hasil end -->
  <!-- Hasil Section End -->

  <!-- Footer Start -->
  <footer>
    <div class="socials">
      <a href="#"><i data-feather="instagram"></i></a>
      <a href="#"><i data-feather="twitter"></i></a>
      <a href="#"><i data-feather="facebook"></i></a>
    </div>
    <div class="credit">
      <p>Created by <a href="">Orang Terkeras</a>. | &copy; 2024</p>
    </div>
  </footer>
  <!-- Footer End -->

  <!-- Feather-Icons -->
  <script>
    feather.replace();
  </script>
  <!-- My JavaScript -->
  <script>
    // const navbarNav = document.querySelector(".navbar-nav");
    // document.querySelector("#hamburger-menu").onclick = (e) => {
    //   navbarNav.classList.toggle("active");
    //   e.preventDefault();
    // };


    // const hamburger = document.querySelector("#hamburger-menu");
    // document.addEventListener("click", function (e) {
    //   if (!hamburger.contains(e.target) && !hamburger.contains(e.target)) {
    //     navbarNav.classList.remove("active");
    //     e.preventDefault();
    //   }
    // });

    //DOM File
    document.addEventListener("DOMContentLoaded", function () {
      // Mendapatkan elemen-elemen yang diperlukan
      const aboutSection = document.getElementById("about");
      const formSection = document.getElementById("form");
      const hasilSection = document.getElementById("hasil");
      // 
      const aboutLink = document.querySelector(".navbar-nav a[href='#about']");
      const formLink = document.querySelector(".navbar-nav a[href='#form']");
      const hasilLink = document.querySelector(".navbar-nav a[href='#hasil']");
      const daftarLink = document.querySelector(".content a[href='#form']"); // Memperbaiki ini

      formSection.style.display = "none";

      aboutLink.addEventListener("click", function (event) {
        event.preventDefault();

        aboutSection.style.display = "block";
        formSection.style.display = "none";
        hasilSection.style.display = "none";
      });

      formLink.addEventListener("click", function (event) {
        event.preventDefault();

        formSection.style.display = "block";
        aboutSection.style.display = "none";
        hasilSection.style.display = "none";
      });

      hasilLink.addEventListener("click", function (event) {
        event.preventDefault();

        hasilSection.style.display = "block";
        aboutSection.style.display = "none";
        formSection.style.display = "none";
      });

      daftarLink.addEventListener("click", function (event) {
        event.preventDefault();
        formSection.style.display = "block";
        aboutSection.style.display = "none";
        hasilSection.style.display = "none";
      });
    });
  </script>
</body>

</html>