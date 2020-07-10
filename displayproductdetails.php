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
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">Tomatus Station</a> 
				</div>

				<div style="color: white; padding: 15px 50px 5px 50px; float: right;font-size: 16px;">
					<a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
					  <a href="" class="btn btn-danger square-btn-adjust">Register</a> 
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
							<h1 style="text-align:center">Product Details From Database</h1>  
							<br>
							<br>
						</div>
        
						<div class="content">
				 			<article>
								<table class="table">
									<tr>
										<th> Product ID </th>
										<th> Product Name </th>
										<th> Product Price </th>                   
										<th> Date Manufactured </th>
										<th> Supplier ID </th>
										<th> Supplier Name </th>
									</tr>
									
								<?php
									$conn = OpenCon();
									$productid = $_GET["productID"];
									$sql= "SELECT * from `product` p, `supplier` s
											where p.supplierid = s.supplierid
											and p.productid = $productid";
									$result = $conn->query($sql);

									if($result-> num_rows > 0) {
										//output data of each row
										while($row = $result->fetch_assoc()){

											$productid = $row["productid"];
											$productname =$row["productname"];
											$productprice = $row["productprice"];
											$dateManu = $row["productDManufactured"];
											$supplierid = $row["supplierid"];
											$suppliername = $row["suppliername"];
											
											//echo "<table align=center border=1 cellspacing=0 cellpading=0>";
											echo "<tr>";
												//echo"<td>Product ID</td>";
												echo"<td>$productid</td>";
											//echo"</tr>";
											//echo "<tr>";
												//echo "<td>Product Name</td>";
												echo"<td>$productname</td>";
											//echo"</tr>";
											//echo "<tr>";
												//echo "<td>Product Price</td>";
												echo"<td>$productprice</td>";
											//echo"</tr>";
											//echo "<tr>";
												//echo "<td>Product Date Manufactured</td>";
												echo"<td>$dateManu</td>";
											//echo"</tr>";
											//echo "<tr>";
												//echo "<td>Supplier ID</td>";
												echo"<td>$supplierid</td>";
											//echo"</tr>";
											//echo "<tr>";
												//echo "<td>Supplier Name</td>";
												echo"<td>$suppliername</td>";
											echo"</tr>";
										echo "</table>";
										}
									}
									
									else {
										echo "Error : " . $sql. "<br>" . mysqli_error($conn);
									}
									CloseCon($conn);
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
						<!-- End of div content -->
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
