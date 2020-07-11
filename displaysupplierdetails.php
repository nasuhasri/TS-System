<!DOCTYPE html>
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
			<link rel="stylesheet" type="text/css" href="contentStyle.css">
		</head>
	   	<header>
			<?php include 'header.php'; ?>
		</header>
	</head>

	<body>
		<div id="wrapper">
			<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
				<div class="navbar-header">
					<a class="navbar-brand" href="homepage.php">Tomatus Station</a> 
				</div>

				<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
					<a href="suppliersignup.php" class="btn btn-danger square-btn-adjust">Supplier Registration</a> 
					<a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
				</div>

				<div style="color: white; padding: 15px 50px 5px 50px; float: left; font-size: 16px;">
					<a href="homepage.php"class="btn btn-danger square-btn-adjust">Order Management System</a> 
				</div>
	   		</nav>   
			<!-- END NAV TOP  -->
			   
            <nav class="navbar-default navbar-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav" id="main-menu">
						<?php include 'navigation.php'; ?>
					</ul>				
				</div>            
        	</nav>  
			<!-- END NAV SIDE  -->
			
        	<div id="page-wrapper" >
				<div id="page-inner">
					<div class="row">
						<div class="col-md-12">
							<h1 style="text-align:center">Supplier Details From Database</h1>
							<br>
							<br>
						</div>
        
						<div class="content">
				 			<article>
								<table class="table">
									<tr>
										<th> Supplier ID </th>
										<th> Supplier Name </th>
										<th> Supplier Address </th>                   
										<th> Supplier Tell No </th>
									</tr>
								<?php 				
									$conn = OpenCon();
									$supplierid = $_GET["supplierID"];
									$sql= "select * from supplier where supplierID = $supplierid";
									$result = $conn->query($sql);

									if($result-> num_rows > 0) {
										//output data of each row
										while($row = $result->fetch_assoc()){

											$supplierid = $row["supplierid"];
											$suppliername =$row["suppliername"];
											$supplieraddress = $row["supplieraddress"];
											$supplierno = $row["suppliertellno"];
											
											//echo "<table align=center border=1 cellspacing=0 cellpading=0>";
											echo "<tr>";
												//echo "<td>Supplier ID</td>";
												echo"<td>$supplierid</td>";
											//echo"</tr>";
											//echo "<tr>";
												//echo "<td>Supplier Name</td>";
												echo"<td>$suppliername</td>";
											//echo"</tr>";
											//echo "<tr>";
												//echo "<td>Supplier Address</td>";
												echo"<td>$supplieraddress</td>";
											//echo"</tr>";
											//echo "<tr>";
												//echo "<td>Phone Number</td>";
												echo"<td>$supplierno</td>";
											echo"</tr>";
										echo "</table>";
										}
									}
									
									else {
										echo "Error : " . $sql. "<br>" . mysqli_error($conn);
									}
									CloseCon($conn);
									//confirmDelete(<?php echo $studentid
								?>
			
								<table class="table">
									<tr>
										<td></td>
											<td colspan="2" align="center">
												<input type="button" value="Back" onclick="history.back()" />
											</td>
									</tr>
								</table>					
							</article>
						</div>
						<!-- End of div content  -->
					</div>
					<!-- End of div row -->
				</div>
             	<!-- END PAGE INNER  -->
            </div>
         	<!-- END PAGE WRAPPER  -->
        </div>
		<!-- END WRAPPER  -->
		 
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
