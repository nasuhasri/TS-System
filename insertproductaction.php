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
					<a href="tomatus.php"class="btn btn-danger square-btn-adjust">Order Management System</a> 
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
							<h1>Order Management System</h1> 
						</div>
						
						<div class="content">
							<article>
								<h2 style="text-align: center">Product Details</h2>
								<?php
									$pID = $_POST["prodID"];
									$pName = $_POST["fullname"];
									$dateManufactured = $_POST["dateManu"];
									$pPrice = $_POST["price"];
									$sID= $_POST["suppID"];

									$conn = OpenCon();
									$sql = "INSERT INTO product (productid, productname, productprice, productDManufactured, supplierid)
											VALUES ($pID, '$pName', '$pPrice', '$dateManufactured', '$sID')";
									
									if(mysqli_query($conn, $sql)) {
										//	echo "New record \n";
										//display back all the data that has been inserted.
										$sql2 ="select * from `product` p, `supplier` s 
												where p.supplierid = s.supplierid
												and p.productid = $pID";
					
										$result = $conn->query($sql2);
										if($result-> num_rows> 0) {
										//output data of each row
											while($row = $result->fetch_assoc()){

												$productid = $row["productid"];
												$productname =$row["productname"];
												$productprice = $row["productprice"];
												$productdate = $row["productDManufactured"];
												$supplierid = $row["supplierid"];
								
												echo "<table>";
												echo "<tr>";
													echo "<td>Product ID</td>";
													echo"<td>$productid</td>";
												echo"</tr>";
												echo "<tr>";
													echo "<td>Product Name</td>";
													echo"<td>$productname</td>";
												echo"</tr>";
												echo "<tr>";
													echo "<td>Product Price (RM)</td>";
													echo"<td>$productprice</td>";
												echo"</tr>";
												echo "<tr>";
													echo "<td>Date Manufactured</td>";
													echo"<td>$productdate</td>";
												echo"</tr>";
												echo "<tr>";
													echo "<td>Supplier ID</td>";
													echo"<td>$supplierid</td>";
												echo"</tr>";
												echo "</table>";
											}
										}
									}
									else {
										echo "Error : " . $sql. "<br>" . mysqli_error($conn);
									}
									CloseCon($conn);

								?>
								<table class="table">
									<tr>
										<td colspan="2" align="center">
											<input type="button" value="Home" onclick="window.location.href='homepage.php'"/>
										</td>
									</tr>
								</table>
							</article>
						</div>
						<!-- End of div content -->
					</div>
					<!-- End of div row -->
				</div>
				<!-- End Page-Inner -->
			</div>
			<!-- End Page-Wrapper -->
		</div>
		<!-- End of Wrapper -->    
	            
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
