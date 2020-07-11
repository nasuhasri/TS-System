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
		</head>
	   	<header>
			<?php include 'header.php'; ?>
		</header>
	</head>

	<body>
    	<div id="wrapper">
			<!-- Top Navigation -->
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
			<!-- END NAV TOP  -->
			
			<!-- Side Navigation -->
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
								<h2 style = "text-align:center">Insert Order Data into Database</h2>
								<?php
									$conn = OpenCon();
									/*Change the line below to our timezone!*/
									date_default_timezone_set('Asia/Kuala_Lumpur');
									
									/* Get orderID using rand method */
									$orderID = date("yy") .rand(100000,999999);
									/* Get orderDate and orderTime using date method */
									$orderDate = date("yy/m/d");
									$orderTime = date("H:i:s");
									
									/* Get data from orderform.php using method POST */
									$orderProduct = $_POST["productname"];
									$productqty = $_POST["productqty"];

									/**$login_id coming from session.php**/
									$empid = $login_id;
									
									/* This is code to select all columns from table 'product' */
									$sqlP="select * from `product` p
											where p.productname = '$orderProduct'";

									$result = $conn->query($sqlP);

									/* This is to retrieve data from database if $result==1 */
									if($result->num_rows > 0){
										/* Fetch data from database */
										while($row = $result->fetch_assoc()){
											$productid = $row["productid"];
											$productname = $row['productname'];
											$productprice = $row['productprice'];
											$supplierid = $row['supplierid'];
											
											/* Insert sql into table order_product */
											$sql2 = "INSERT INTO `order_product` (orderid, productid, productqty)
												VALUES ($orderID, $productid, $productqty)";

											/* Using if else to know either the sql statement successful or not */
											if (mysqli_query($conn, $sql2)) {
												echo "";
											}
											else {
												echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
											}

											/* Calculate the totalPrice from data that has been retrieved from database */
											$totalPrice = $productqty * $productprice;
										}
									}

									/* Insert all data to table 'orders' */
									$sql = "INSERT INTO `orders` (orderid, orderdate, ordertime, orderproduct, totalPrice, empid)
											VALUES ($orderID, '$orderDate', '$orderTime', '$orderProduct', '$totalPrice', $empid)";
									
									/* Using if else to know either the sql statement successful or not */
									if(mysqli_query($conn, $sql)){
										echo "";
									}
									else {						
										echo "Error: " . $sql . "<br>" . mysqli_error($conn);
									}
									
									CloseCon($conn);
								?>
							</article> 
						</div>
					</div>
					<!-- End of div row -->
					
					<hr>
					<!-- Second row -->
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<div class="panel panel-success">
								<div class="panel-heading"> Order Messages </div>
								<div class="panel-body">
									<p> New record created successfully. Please be patience. 
										Your order will be processed.
									</p>
								</div>
								<div class="panel-footer"> Thank you for your order! </div>
							</div>
						</div>

						<div class="col-md-5 col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading"> Order Info </div>
								<div class="panel-body">
									<p>Here is your order details: </p>
									<?php
										$conn = OpenCon();
										$sql = "SELECT * FROM `orders` ord, `order_product` op 
												where ord.orderid = op.orderid
												and ord.orderid = $orderID";
										
										$result = $conn->query($sql);
										
										if ($result->num_rows > 0) {
											//output data of each row
																
											while($row = $result->fetch_assoc()){
																		
												$orderid = $row["orderid"];
												$date = $row["orderdate"];
												$time = $row["ordertime"];
												$product = $row["orderproduct"];
												$proID = $row["productid"];
												$proQty = $row["productqty"];
												$status = $row["orderstatus"];

												echo "<table>";
													echo "<tr>";
														echo "<td> Order ID </td>";
														echo "<td></td>";
														echo "<td> $orderid </td>";
													echo "<tr>";

													echo "<tr>";
														echo "<td> Order Date </td>";
														echo "<td></td>";
														echo "<td> $date </td>";
													echo "<tr>";

													echo "<tr>";
														echo "<td> Order Time </td>";
														echo "<td></td>";
														echo "<td> $time </td>";
													echo "<tr>";

													echo "<tr>";
														echo "<td> Product ID </td>";
														echo "<td></td>";
														echo "<td> $proID </td>";
													echo "<tr>";

													echo "<tr>";
														echo "<td> Product Name </td>";
														echo "<td></td>";
														echo "<td> $product </td>";
													echo "<tr>";

													echo "<tr>";
														echo "<td> Product Quantity </td>";
														echo "<td></td>";
														echo "<td> $proQty </td>";
													echo "<tr>";

													echo "<tr>";
														echo "<td> Order Status </td>";
														echo "<td> $status </td>";
													echo "<tr>";
												echo "</table>";
											}
										}
										else {
											echo "Order cannot been displayed!";
										}
									?>
								</div>
								<div class="panel-footer"> Thank you for choosing us! </div>
							</div>
						</div>
					</div>													
					<!-- End of second row -->

					<table class="table">
						<tr>
							<td colspan="2" align="center">
								<input type="button" value="Homepage" onclick="window.location.href='homepage.php'" />
							</td>
						</tr>
					</table>
				</div>
				<!-- END PAGE INNER  -->
			</div>
			<!-- END PAGE WRAPPER  -->
    	</div>
		<!-- END DIV WRAPPER  -->
		 
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
