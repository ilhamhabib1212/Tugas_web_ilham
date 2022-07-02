<?php
    session_start();
    include 'db.php';

    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."'");
    $d = mysqli_fetch_object($query);
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
             <h3>Profile</h3>
               <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                    <input type="text" name="hp" placeholder="No. Hp" class="input-control" value="<?php echo $d->admin_telp ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
                    <input type="text" name="alamat" placeholder="Address" class="input-control" value="<?php echo $d->admin_address ?>" required>
                    <input type="submit" name="submit" value="Change Profil" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])){
                        include 'db.php';

                        $nama   = ucwords($_POST['nama']);
                        $user   = $_POST['user'];
                        $hp     = $_POST['hp'];
                        $email  = $_POST['email'];
                        $alamat = ucwords($_POST['alamat']);
                    
                        session_start();
                        $update = mysqli_query($conn, "UPDATE tb_admin SET
                                    admin_name = '".$nama."',
                                    username = '".$user."',
                                    admin_telp = '".$hp."',
                                    admin_email = '".$email."',
                                    admin_address = '".$alamat."'
                                    WHERE admin_id = '".$d->admin_id."' ");
                        if($update){
                            echo '<script>alert("Change successful")</script>';
                            echo '<script>window.location="dashboard.php"</script>';
                        }
                        else{
                            echo 'gagal '.mysqli_error($conn);
                        }

                    }
               ?>
            </div>

            <div class="box">
             <h3>Change Password</h3>
               <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="New Password" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Confirm New Password" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Change Password" class="btn">
               </form>
               <?php
                    if(isset($_POST['ubah_password'])){
                        include 'db.php';

                        $pass1   = $_POST['pass1'];
                        $pass2   = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("The password that you have entered is incorrect.")</script>';
                        }else{

                            $u_pass = mysqli_query($conn, "UPDATE tb_admin SET
                                        password = '".MD5($pass1)."'
                                        WHERE admin_id = '".$d->admin_id."' ");
                            if($u_pass){
                                echo '<script>alert("Password has been changed.")</script>';
                                echo '<script>window.location="dashboard.php"</script>';
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
    </body>
</html>