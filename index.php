<?php require'connect.php' ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<!-- responsive meta tag -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Index</title>

	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	
	<!-- css biasa -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Bad+Script&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap" rel="stylesheet"> 
	
		<!-- Javascript -->
	<script type="text/javascript" src="bootstrap/js/jquery-3.4.1.slim.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>

</head>
<body>

	<!-- nav -->
	<ul class="nav justify-content-center navbars">
	  <li class="nav-item">
	    <a class="nav-link" href="index.php">Home</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="gallery.php" target="_blank">Gallery</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="message.php" target="_blank">Contact</a>
	  </li>
	</ul>

	 <hr style="width: 1000px; margin-bottom: 5px">

	 <!-- greeting -->
	 <p>your data profile  : <br>
	 	<?= $row["nickname"]; ?>
	 	<?= $row["user_name"]; ?>
	 	<?= $row["email"]; ?>
	 	</p>

	<!-- banner -->
	<img src="images/banner1.png" class="img-fluid banner" alt="forest">


	<!-- content -->
	<h1  class="col-md-6 offset-md-3 head">Lorem Ipsum</h1>


	<div class="row justify-content-center text-justify">
	    <div class="col-4">
	     <p class="text-uppercase font-weight-bold">What is Lorem Ipsum?</p>	

		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

	    </div>
	    <div class="col-4">
	    <p class="text-uppercase font-weight-bold">Why do we use it?</p>

		<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). </p>
	     
	    </div>
  	</div>

  	<div class="row justify-content-center text-justify">
	    <div class="col-4">
	    	<p class="text-uppercase font-weight-bold">Where does it come from?</p>

			<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

			The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. </p>
	    </div>

		<div class="col-4">
			<p class="text-uppercase font-weight-bold">Where can I get some?</p>	

		<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
	    </div>
  	</div>


  		<!-- Log-out -->
	<p class="text-center"><a href="login.php">Log-out</a>.</p>

	<!-- footer -->
   <section>
     <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <hr style="width: 1000px; margin-bottom: 10px">
          <p> &copy 2020 </p>
        </div>
      </div>
   </section>



</body>
</html>