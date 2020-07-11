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
				/* Function to validate the form */
				function validateForm(){
					var supplier =  document.forms["orderForm"]["supplier"];
					var prodNm =  document.forms["orderForm"]["productname"];
					var prodQty = document.forms["orderForm"]["productqty"];

					if (supplier.selectedIndex < 1)                  
					{ 
						alert("Please enter your supplier."); 
						supplier.focus(); 
						return false;
					}

					if (prodNm.selectedIndex < 1)                  
					{ 
						alert("Please enter your product."); 
						prodNm.focus(); 
						return false; 
					}

					if (prodQty == "null" || prodQty < 0)                  
					{ 
						alert("Please enter your quantity."); 
						prodQty.focus(); 
						return false; 
					}

					return true;
				}
				/* End function to validate the form */

				function confirmSubmit()
				{
					if(confirm('Are you sure you want to submit the order')){
						/* No need to put window.location here as user will be only
						   go to insertorderaction.php if everything is true */

						// window.location.href= 'insertorderaction.php';
					}
					else {
						return false;
					}
				}					
			</script>

			<!-- Function to create dependent dropdown box -->
			<script>
				$(document).ready(function() {
					$("#supplier").change(function() {
						var supplierid = $(this).children("option:selected").val();
						if(supplierid != "") { 
							/* Dekat sini kita ada buat ajax, 
							   kita pass value supplier yang selected
							   ke orderform.php */
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
							$("#show-product").html('<option>Select supplier first</option>');
						}
					});
				});
			</script>
			<!-- End of function dependent dropdown box -->
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
					<a class="navbar-brand" href="welcomepage.php">Tomatus Station</a> 
				</div>
				
				<!-- Logout button & register button at the top -->
                <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                    <a href="signup.php" class="btn btn-danger square-btn-adjust">Employee Registration</a> 
					<a href="suppliersignup.php" class="btn btn-danger square-btn-adjust">Supplier Registration</a> 
					<a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
                </div>

				<div style="color: white; padding: 15px 50px 5px 50px; float: left; font-size: 16px;">
					<a class="btn btn-danger square-btn-adjust">Order Management System</a> 
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
							<h1 style = "text-align: center"> Order Product Form</h1>
							<br> 
							<br>
						
						</div>
			
						<div class="content">
							<article>								
								<form action="insertorderaction.php" id="form" name="orderForm" method="POST" onsubmit="return (validateForm())">					
								<table class="table table-borderless">
									<tr>
										<td colspan="2" align="center">Supplier</td>
										<td>
											<select id="supplier" name="supplier">
												<option value="0">Select Supplier</option>
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
										<td colspan="2" align="center">Product Name</td>
										<td>
											<select id="productname" name="productname">
												<option value="0">Select Supplier First</option>
												<option id="show-product" name="selectedProduct"></option>
											</select> <br>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="center">Product Quantity</td>
										<td><input type="number" min="0" name="productqty" maxlength="10" placeholder="150" required><br></td>
									</tr>
								</table>

								<table class="table table-borderless">
									<tr>
										<td colspan="2" align="center">
											<!-- onclick="confirmSubmit()" -->
											<input type="submit" value="Submit" name="submit" onclick="confirmSubmit()">
											<input type="reset" value="Reset">
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
