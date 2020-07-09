<!DOCTYPE html>
<html lang="en">

<head>
<link rel="shortcut icon" href="images/favicon.ico" />
</head>

<head>

<title>Tomatus Station</title>

<!--

Template 2099 Scenic

http://www.tooplate.com/view/2099-scenic

-->

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/magnific-popup.css">

<link rel="stylesheet" href="css/owl.theme.css">
<link rel="stylesheet" href="css/owl.carousel.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="css/tooplate-style.css">

</head>


<body>

<!-- PRE LOADER -->
<div class="preloader">
     <div class="spinner">
          <span class="sk-inner-circle"></span>
     </div>
</div>


<!-- MENU -->
<div class="navbar custom-navbar navbar-fixed-top" role="navigation">
     <div class="container">

          <!-- NAVBAR HEADER -->
          <div class="navbar-header">
               <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
               </button>
               <!-- lOGO -->
               <a href="welcomepage.php" class="navbar-brand">Tomatus Station Melaka</a>
          </div>

          <!-- MENU LINKS -->
          <div class="collapse navbar-collapse">
               <ul class="nav navbar-nav navbar-right">
                    <li><a href="#more" class="smoothScroll">About</a></li>  
                    <li><a href="#more" class="dropdown">Contact</a></li>
               </ul>
          </div>

     </div>
</div>


<!-- HOME -->
<section id="home" class="parallax-section">
     <div class="overlay"></div>
     <div class="container">
          <div class="row">

               <div class="col-md-8 col-sm-12">
                    <div class="home-text">
						 <article>
							<h1 style="text-align:left">Supplier Login</h1>
							<form action="supplierloginaction.php" id="form" method="POST">
								
								
								<div class="container">
									
											<h4 style="color:white" for="supplierID"><b>Supplier ID</b></h4>
											<input type="text" placeholder="Enter ID" name="supplierID" required>

											<h4 style="color:white" for="supplierPassword"><b>Password</b></h4>
											<input type="password" placeholder="Enter Password" name="supplierPassword" required>
											<br></br>
											<br></br>
									
								<table>
									<tr>
										 <td>
										 <input type="submit" style="background-color:green;color:white;width:150px; height:40px;" value="Login">
										 <input type="button" onclick="history.back()" style="background-color:red;color:white;width:150px; height:40px;" value="Back">
										</td>
									</tr>
								</table> 
							</div>				
						</article>
                    </div>
               </div>

          </div>
     </div>

     <!-- Video -->
     <video controls autoplay loop muted>
          <source src="videos/video.mp4" type="video/mp4">
          Your browser does not support the video tag.
     </video>
</section>


<!-- SUPPLIER LOGIN -->
<section id="supplierlogin" class="parallax-section">
     <div class="container">
          <div class="row">

               <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="about-info">
   
                    </div>
               </div>

          </div>
     </div>
</section>

<footer>
<?php include 'footer.php';?>
</footer>

<!-- SCRIPTS -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.parallax.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/magnific-popup-options.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/custom.js"></script>

</body>
</html>