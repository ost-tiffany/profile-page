<?php
session_start();

include '../connect.php';

    if(isset($_POST["submitupload"])) {

    //idproduct 
    $idproduct = $_POST["product_id"];

    // nama product
    $namaproduct = $_POST['product_name'];

    // tipe produk
    $selectedtipeproduct = $_POST['product_type'];

     // gambarnya yang baru
     $namagambar = $_POST["namedituploadimag"];
     $jalannya = $_POST["edituploadimage"];
     $idusersekarang = $_SESSION["user_id"];
     $usernamesekarang = $_SESSION["user_name"];	
         
     //gambar lama
     $gambarlama = $_POST["oldimage"];
     $lokasigambarlama = '../images/gallery/product/'.$idproduct.'/';
     $target_dirlama = "../images/gallery/product/delete/";
    
        $uploadedit = "UPDATE products SET 
                    product_name = '$namaproduct', 
                    product_type = '$selectedtipeproduct', 
                    product_image = '$namagambar', 
                    updated_by_user_id = '$idusersekarang', 
                    updated_by_user_name = '$usernamesekarang'
                    WHERE product_id = '$idproduct'"; 

        $uploadDB = $db->query($uploadedit);
            
        $target_dir = "../images/gallery/product/".$idproduct."/";
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
                
                
                //rename yang baru
                rename('../'.$jalannya, $target_dir.$namagambar);

                //rename yang lama
                rename($lokasigambarlama,$target_dirlama);

                echo "<script>window.location.href='../gallery.php?note=success'</script>";
            }
        
?>
        