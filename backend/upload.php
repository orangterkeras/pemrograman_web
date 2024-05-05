<html>
<head></head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $folder = "backend/upload/";
        $tmp_name = $_FILES['foto']['tmp_name'];
        $nama_file = $_FILES['foto']['name'];
        $target_file = $folder . $nama_file;
        $tipe_file = strtolower(
            pathinfo(
                $target_file,
                PATHINFO_EXTENSION
            )
        );
        if ($_FILES['foto']['size'] >= 500000) {
            echo "File Terlalu Besar!";
        } else {
            if ($tipe_file != 'jpg') {
                echo "File harus bertipe jpg!";
            } else {
                move_uploaded_file($tmp_name, $target_file);
                echo "File Berhasil diupload!";
            }
        }
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        Unggah Foto : <br>
        <input type="file" name="foto"><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
