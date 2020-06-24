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
							
							/* Insert sql into database */
							$sql2 = "INSERT INTO `order_product` (orderid, productid, productqty)
								VALUES ($orderID, $productid, $productqty)";

							/* Using if else to know either the sql statement successful or not */
							if (mysqli_query($conn, $sql2)) {
								echo "Table order_product: New record created successfully \n";
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
						echo "Insert into table orders successful!";
					}
					else {						
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
					
					CloseCon($conn);
				?>
				
				<table>
					<tr>
						<td colspan="2" align="center">
							<input type="button" value="Display Order" onclick="window.location.href='displayorderfromdb.php'" />
						</td>
					</tr>
				</table>
			</article> 
			</div>
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
