<?php
    session_start();
    include 'db.php';

    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale=1">
        <title>Sports.id</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Roboto:wght@900&display=swap" rel="stylesheet">
        <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
    </head>
    <body>
       <!-- header -->
       <header>
            <div class="container">
            <a href="dashboard.php"><img src="logosport.jpg" alt="Image Load Error" width="80" ></a>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="data-kategori.php">Kategori</a></li>
                    <li><a href="data-produk.php">Produk</a></li>
                    <li><a href="logout.php">Keluar</a></li>
                </ul>
            </div>
       </header>

       <!-- content -->
       <style>
        body {
            background-image : url("bg1.jpg");
            background-size : cover;
        }
       </style>
       <div class="section">
        <div class="container">
            <div class="box">
             <h3>Tambah Data Produk</h3>
               <form action="" method="POST" enctype="multipart/form-data">
                    <Select class="input-control" name="kategori" required>
                        <option value="">--Pilih--</option>
                        <?php
                   $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                   while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                        <?php } ?>    
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Active</option>
                        <option value="0">Non Active</option>
                    </select>
                    <input type="submit" name="submit" value="Add Data" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                         // print_r($_FILES['gambar']);  

                         // nampung inputan form
                        $kategori = $_POST ['kategori'];
                        $nama = $_POST ['nama'];
                        $harga = $_POST ['harga'];
                        $deskripsi = $_POST ['deskripsi'];
                        $status = $_POST ['status'];

                         // nampung data file upload
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'produk'.time().'.'.$type2;

                         // namput format file yang diizinkan
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                         // validasi format file
                         if(!in_array($type2, $tipe_diizinkan)){

                            echo '<script>alert("Format file tidak didukung")</script>';

                         }else{
                            // jika format diizinkan
                            // proses dan insert database
                            move_uploaded_file($tmp_name, './img_produk/' .$newname);

                            $insert = mysqli_query($conn, "INSERT INTO tb_produk Values (
                                        null,
                                        '".$kategori."',
                                        '".$nama."',
                                        '".$harga."',
                                        '".$deskripsi."',
                                        '".$newname."',
                                        '".$status."',
                                        null
                                            ) ");

                            if($insert){
                                echo '<script>alert("Save is complete")</script>';
                                echo '<script>window.location="data-produk.php"</script>';

                            }else{
                                echo 'gagal '.mysqli_error($conn);
                            }
                         }

                         

                    }
                ?>
            </div>

        </div>
       </div>

       <!-- footer -->
       <footer>
        <div class="container">
            <small>Copyright &copy; 2022 - Sports.id.</small>
        </div>
       </footer>
            <script>
                CKEDITOR.replace( 'deskripsi' );
            </script>
    </body>
</html>