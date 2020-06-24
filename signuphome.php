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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tomatus Station</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>



<head>
		<head>
			<link rel="shortcut icon" href="images/favicon.ico" />
		</head>
	   <header>
			<?php include 'header.php'; ?>
		</header>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Tomatus Station</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
				  <a href="" class="btn btn-danger square-btn-adjust">Register</a> </div>

<div style="color: white;
padding: 15px 50px 5px 50px;
float: left;
font-size: 16px;"><a href="tomatus.php"class="btn btn-danger square-btn-adjust">Order Management System</a> </div>
	   </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<?php include 'navigation.php'; ?>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h1>Order Management System</h1>   
                   
                    </div>
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
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
