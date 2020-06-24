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
			<script src="//code.jquery.com/jquery-1.12.4.js"></script>
			<script type="text/javascript">
				function confirmSubmit()
				{
					if(confirm('Are you sure you want to submit the order'))
					{
						window.location.href= 'insertorderaction.php';
					}
					else {
						return false;
					}
				}			
			</script>
			<script>
				$(document).ready(function() {
					$("#supplier").change(function() {
						var supplierid = $(this).children("option:selected").val();
						if(supplierid != "") { 
							// Dekat sini kita ada buat ajax, 
							// kita pass value suppiler yang selected
							// ke orderform.php
							console.log(supplierid);
							$.ajax({
								url: "orderformajax.php",
								type: "post",
								data: {supplier: supplierid},
								success: function(response) {
									$("#productname").html(response);
								}
							});
						} else {
							$("#show-product").html('<option>No values</option>');
						}
					});
				});
			</script>
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
				<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
					<a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
					<a href="" class="btn btn-danger square-btn-adjust">Register</a> 
				</div>

				<div style="color: white; padding: 15px 50px 5px 50px; float: left; font-size: 16px;">
					<a href="tomatus.php"class="btn btn-danger square-btn-adjust">Order Management System</a> 
				</div>
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
			
			<div class="">
				<article>
					<h2 style = "text-align: center"> Order Product Form</h2> <br>
					<form action="insertorderaction.php" id="form" method="POST">					
					<table style="text-align: left">
						<tr>
							<td>Supplier</td>
							<td>
								<select id="supplier" name="supplier">
									<option>Select</option>
									<?php
										$conn = OpenCon();
										$sql = "select * from supplier s";
										$result = $conn->query($sql);
	
										while($row = $result->fetch_assoc()) {
											echo "<option value= '". $row['supplierid'] ."'>" .$row['suppliername']. "</option>";
										}
									?>
								</select>						
							</td>
						</tr>

						<tr>
							<td>Product Name</td>
							<td>
								<select id="productname" name="productname">
									<option>Select</option>
									<option id="show-product" name="selectedProduct">
										
									</option>
								</select> <br>
							</td>
						</tr>
						<tr>
							<td>Product Quantity</td>
							<td><input type="int" name="productqty" maxlength="10" placeholder="10" required><br></td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<input type="submit" value="Submit" name="submit" onclick="confirmSubmit()">
								<input type="reset" value="Reset">
							</td>
						</tr>					
					</table>				
				</article>
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
