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
            background-size : 100%;
        }
       </style>
       <div class="section">
        <div class="container">
            <div class="box">
             <h3>Tambah Data Kategori</h3>
               <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" required>
                    <input type="submit" name="submit" value="Add Data" class="btn">
               </form>
               <?php
                if(isset($_POST['submit'])){
                    $nama = ucwords($_POST['nama']);

                    $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (
                                        null,
                                        '".$nama."') ");
                    
                    if($insert){
                        echo '<script>alert("Data added successfully")</script>';
                        echo '<script>window.location="data-kategori.php"</script>';
                    }else{
                        echo 'Failed '.mysqli_error($conn);
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
    </body>
</html>