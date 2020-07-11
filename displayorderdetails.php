<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"></html>
<html>
	<!-- Sidebar CSS -->
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
            <link rel="shortcut icon" href="images/favicon.ico">
			<link rel="stylesheet" type="text/css" href="contentStyle.css">
        </head>
        <header>
            <?php include 'headerSupp.php'; ?>
        </header>
    </head>
	
	<body>
		<div id="wrapper">
			<!--TOP NAVIGATION -->
			<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="homepage.php">Tomatus Station</a> 
                </div>
                <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                    <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
                </div>

                <div style="color: white; padding: 15px 50px 5px 50px; float: left; font-size: 16px;">
                    <a href="homepage.php"class="btn btn-danger square-btn-adjust">Order Management System</a> 
                </div>
			</nav>
			
			<!-- SIDEBAR NAVIGATION  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <?php include 'navigationSupp.php'; ?>
                    </ul>
                </div>                    
			</nav>

			<!-- WRAPPER CONTENT  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 style="text-align:center">Order Details From Database</h1>
			
							<!-- INNER PAGE CONTENT  -->
							<div class = "content">
								
								<br>
								<table class="table">
									<tr>
										<th> Order ID </th>
										<th> Order Date </th>
										<th> Order Time </th>                   
										<th> Product Name </th>
										<th> Product Quantity </th>
										<th> Total Price(RM) </th>
										<th> Order Status </th>
										<th> Staff-In-Charge </th>
									</tr>
									<?php					
										$conn = OpenCon();
										/* $orderid get from orderReq.php */
										$orderid = $_GET["orderid"];
										$sql= "SELECT * from `orders` o, `order_product` op
												where o.orderid = op.orderid
												and o.orderid = $orderid";
										$result = $conn->query($sql);

										if($result-> num_rows > 0) {
											//output data of each row
											while($row = $result->fetch_assoc()){

												$orderid = $row["orderid"];
												$orderdate =$row["orderdate"];
												$ordertime = $row["ordertime"];
												$orderproduct = $row["orderproduct"];
												$proQty = $row["productqty"];
												$totalPrice = $row["totalPrice"];								
												$orderstatus = $row["orderstatus"];
												$empid = $row["empid"];
												// echo "<table>";
												echo "<tr>";
												// 	echo "<td>Order ID</td>";
													echo"<td>$orderid</td>";
												// echo"</tr>";
												// echo "<tr>";
												// 	echo "<td>Order Date</td>";
													echo"<td>$orderdate</td>";
												// echo"</tr>";
												// echo "<tr>";
												// 	echo "<td>Order Time</td>";
													echo"<td>$ordertime</td>";
												// echo"</tr>";
												// echo "<tr>";
												// 	echo "<td>Order Product</td>";
													echo"<td>$orderproduct</td>";
													echo"<td>$proQty</td>";
												// echo"</tr>";
												// echo "<tr>";
												// 	echo "<td>Total Price(RM)</td>";
													echo"<td>$totalPrice</td>";
												// echo"</tr>";
												// echo "<tr>";
												// 	echo "<td>Order Status</td>";
													echo"<td>$orderstatus</td>";
												// echo"</tr>";
												// echo "<tr>";
												// 	echo "<td>Staff-In-Charge</td>";
													echo"<td>$empid</td>";
												echo"</tr>";
											echo "</table>";
											}
										}
										
										else {
											echo "Error : " . $sql. "<br>" . mysqli_error($conn);
										}
										CloseCon($conn);
									?>

								<table>
									<tr>
										<td></td>
											<td colspan="2" align="center">
												<input type="button" value="Back" onclick="history.back()" />
											</td>
									</tr>
								</table>
							</div>
							<!-- End of inner page content -->

				
				</article>
			<!-- PAGE INNER  -->
			</div>
		<!-- PAGE WRAPPER  -->
		</div>
	</body>
</html>