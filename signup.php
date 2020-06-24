<?php
	
$conn = mysqli_connect("localhost","root","","order_management") or die("Database Not Connected");


if($_SERVER['REQUEST_METHOD'] == 'POST')
{

	if(isset($_POST['submit']))
	{

		if(isset($_POST['term']))
		{

			$empid = mysqli_escape_string($conn, $_POST['empID']);
			$empfname = mysqli_escape_string($conn, $_POST['empFName']);
			$emplname = mysqli_escape_string($conn, $_POST['empLName']);
			$empeml = mysqli_escape_string($conn, $_POST['empEml']);
			$emptell = mysqli_escape_string($conn, $_POST['empTell']);
			$empsal = mysqli_escape_string($conn, $_POST['empSal']);
			$emppass = mysqli_escape_string($conn, $_POST['password']);

			function validate($form_data)
			{
				$form_data = trim( stripcslashes( htmlspecialchars($form_data) ) );
				return $form_data;
			}

			$vuserid = validate($empid);
			$vuserfname = validate($empfname);
			$vuserlname = validate($emplname);
			$vuseremail = validate($empeml);
			$vusertell = validate($emptell);
			$vusersalary = validate($empsal);
			$vuserpass = validate($emppass);

			if(!empty($vuserid) && !empty($vuserfname) && !empty($vuserlname) && !empty($vuseremail) && !empty($vusertell)  && !empty($vusersalary) && !empty($vuserpass))
			{

				$pass = password_hash($vuserpass, PASSWORD_BCRYPT);

				$insert = "INSERT INTO `employee`(`empid`,`empfname`,`emplname`,`empEmail`,`emptellno`,`empsalary`,`emppwd`) VALUES('$vuserid','$vuserfname','$vuserlname','$vuseremail','$vusertell','$vusersalary','$pass')";

				if(mysqli_query($conn, $insert))
				{
					$msg = "User Inserted";
				}
				else
				{
					$msg = "Not Inserted";
				}

			}
			else
			{
				$msg = "Empty Field Found";
			}

		}
		else
		{
			$msg = "Please Check Term And Condition";
		}

	}

}

?><!DOCTYPE html>
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
               <a href="index.html" class="navbar-brand">Tomatus Station Melaka</a>
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
							<h1 style="text-align:left">Hello, Welcome</h1>
							
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


<!-- ABOUT -->
<section id="about" class="parallax-section">
     <div class="container">
          <div class="row">

               <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="about-info">
							<form method="POST">
								<div class="form-group">
									<label>User ID</label>
									<input type="text" name="empID" placeholder="Enter ID" class="form-control">
								</div>
								<div class="form-group">
									<label>User First Name</label>
									<input type="text" name="empFName" placeholder="Enter First Name" class="form-control">
								</div>
								<div class="form-group">
									<label>User Last Name</label>
									<input type="text" name="empLName" placeholder="Enter Last Name" class="form-control">
								</div>
								<div class="form-group">
									<label>User Email</label>
									<input type="text" name="empEml" placeholder="Enter Email" class="form-control">
								</div>
								<div class="form-group">
									<label>User Telephone Number</label>
									<input type="text" name="empTell" placeholder="Enter Telephone Number" class="form-control">
								</div>
								<div class="form-group">
									<label>User Salary</label>
									<input type="text" name="empSal" placeholder="Enter Salary" class="form-control">
								</div>
								<div class="form-group">
									<label>User Password</label>
									<input type="Password" name="password" placeholder="*******" class="form-control">
								</div>
								<input type="checkbox" name="term"> I Follow All Term & Condition <br>
								
								<table>
										<tr>
											<td>
											<input type="submit"style="background-color:blue;color:white;width:150px; height:40px;" value="Submit">
											<input type="button" onclick="history.back()" style="background-color:red;color:white;width:150px; height:40px;" value="Back">
											</td>
										</tr>
									</table>
							</form>
							<h3 style="color:red;"><?php echo @$msg; ?></h3>
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