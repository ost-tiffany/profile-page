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
		$idusersekarang = $_SESSION["user_id"];
		$usernamesekarang = $_SESSION["user_name"];	

		if(isset($_POST["namedituploadimage"]))
		{
			// kalau gambarnya yang baru
			$file_name_temp = $_POST["namedituploadimage"];
			// include filename
			$path_temp = $_POST["edituploadimage"];

			//gambar lama
			$old_file_name = $_POST["oldimage"];
			//location == $target_dir
			$delete_folder = "../images/gallery/product/delete/";
			$uploadedit = "UPDATE products SET 
						product_name = '$namaproduct', 
						product_type = '$selectedtipeproduct', 
						product_image = '$file_name_temp', 
						updated_by_user_id = '$idusersekarang', 
						updated_by_user_name = '$usernamesekarang'
						WHERE product_id = '$idproduct'"; 
			//newlocation
			$target_dir = "../images/gallery/product/".$idproduct."/";
			//target dir dari doUpload
				
			//file_exists buat ngecek file/dirnya ada/ga
			if (!file_exists($target_dir)) {
				// By default, the mode is 0777 (widest possible access).
				//mkdir bikin folder
				//TRUE on success, FALSE on failure
				mkdir($target_dir, 0777, true);
							
			}
				// rename mirip sama move_uploaded_file. ini nunjukin jalannya , bedanya move uploadded ya buat file "FILE" aja
				//move_uploaded_file($name,$target_dir.$real_image);
				//rename yang lama
				// upload -> delete
				copy($target_dir.$old_file_name, $delete_folder.$old_file_name);
				unlink($target_dir.$old_file_name);
				//rename($target_dir.$old_file_name,$delete_folder);
				//temp->upload
				copy('../'.$path_temp, $target_dir.$file_name_temp);
				unlink('../'.$path_temp); //kek ilangin sesuatu dari sini
			
		} else {
			$uploadedit = "UPDATE products SET 
						product_name = '$namaproduct', 
						product_type = '$selectedtipeproduct', 
						updated_by_user_id = '$idusersekarang', 
						updated_by_user_name = '$usernamesekarang'
						WHERE product_id = '$idproduct'"; 
						
		}
		$uploadDB = $db->query($uploadedit);
		echo "<script>window.location.href='../gallery.php?note=success'</script>";
    } else {
		echo "invalid access!";
	}
        
?>
        