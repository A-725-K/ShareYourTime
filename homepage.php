<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
 	<head>
    	<?php require ('header/header.html'); ?>
    	<link rel="stylesheet" type="text/css" href="homepage.css"/>
	    <link rel="stylesheet" type="text/css" href="navBar/navBar.css"/> 
		<link rel="stylesheet" type="text/css" href="footer/footer.css"/>
	</head>
	
	<body>

    <?php require ('navBar/navBar.php'); ?>



	<section id="home">
		<div id="showMenu" onmouseover="showMenu('menu');hideMenu('showMenu');">
		</div>
		<div id="menu" onmouseout="showMenu('showMenu');hideMenu('menu');">
		</div>
	</section>
    <?php require ('footer/footer.php'); ?>
    

	

    <!-- BOOTSTRAP -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  
	<script type="text/javascript" src="js/homepage.js"></script>

    </body>
</html>