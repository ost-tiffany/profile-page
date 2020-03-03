<?php
session_start();

include '../connect.php';

    if(isset($_POST["submitupload"])) {

    // nama product
    $namaproduct = $_POST['product_name'];

    // tipe produk
    $selectedtipeproduct = $_POST['product_type'];

    // gambarnya
    $namagambar = $_POST["nameuploadimage"];
    $jalannya = $_POST["uploadimage"];
    $nomoruser = $_SESSION["user_id"];
	$usernamenyasekarang = $_SESSION["user_name"];	
        //$target_file = $target_dir  . basename($gambarnya);
// echo $jalannya;
        $upload = "INSERT INTO products(product_name, product_type, product_image, created_by_user_id, created_by_user_name) 
        VALUES('$namaproduct','$selectedtipeproduct','$namagambar','$nomoruser','$usernamenyasekarang')"; 

        $uploadDB = $db->query($upload);
            
        $last_id = mysqli_insert_id($db);
        $target_dir = "../images/gallery/product/".$last_id."/";
        //target dir dari doUpload

            //file_exists buat ngecek file/dirnya ada/ga
            if (!file_exists($target_dir)) {
                // By default, the mode is 0777 (widest possible access).
                //mkdir bikin folder
                //TRUE on success, FALSE on failure
                mkdir($target_dir, 0777, true);
            
            }
                    // rename mirip sama move_uploaded_file. ini nunjukin jalannya 
                    //move_uploaded_file($name,$target_dir.$real_image);
                rename('../'.$jalannya, $target_dir.$namagambar);

                echo "<script>window.location.href='../uploaded.php?note=success'</script>";
            }
        
?>
        