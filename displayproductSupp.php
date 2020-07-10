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
            <?php include 'headerSupp.php'; ?>
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

                <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                    <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
                </div>

                <div style="color: white; padding: 15px 50px 5px 50px; float: left; font-size: 16px;">
                    <a class="btn btn-danger square-btn-adjust">Order Management System</a> 
                </div>
            </nav>   
            <!-- END NAV TOP  -->

            <!-- Side Navigation to make it look nicer -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <?php include 'navigationSupp.php'; ?>
                    </ul>                
                </div>            
            </nav>  
            <!-- END NAV SIDE  -->

            <div id="page-wrapper" >
                <div id="page-inner">         
                    
					<div class="content">
						<article>
							<h1 style="text-align: center">List Of Products</h1>
							<br>
							<br>

							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th>Product ID</th>
										<th>Product Name</th>
										<th>Product Price</th>
										<th>Date Manufactured</th>
										<th>Remaining Stock</th>
										<th>Supplier ID</th>
									</tr>
					        </thead>
							
							<?php
								$conn = OpenCon();
								
								/**Value supplierid coming from supplierloginaction.php**/
								$suppID = $_SESSION['login_supplier'];
								
								//get page number
								$page = 0;

								//set variable
								if(isset($_GET["page"])==true) {
									$page = ($_GET["page"]);
								}
								else {
									$page = 0;	
								}

								//algo for pagination in sql
								if ($page=="" || $page=="1"){
										$page1 = 0;
								}
								else {
									$page1= ($page*4)-4;
								}
								
								//$productid = $_GET["productID"];
								$sql= "SELECT * from `product` p, `supplier` s
										where p.supplierid = s.supplierid
										and s.supplierid = $user_check
										limit $page1,4";
										
								$result = $conn ->query($sql);

								if($result-> num_rows > 0) {
									//output data of each row
									while($row = $result->fetch_assoc()){

										$productid = $row["productid"];
										$productname =$row["productname"];
										$productprice = $row["productprice"];
										$productmanufactured = $row["productDManufactured"];
										$productstock = $row["productStock"];
										$supplierid = $row["supplierid"];
										
									echo "<tr>";
										echo "<td>$productid</td>";
										echo "<td>$productname</td>";
										echo "<td>$productprice</td>";
										echo "<td>$productmanufactured</td>";
										echo "<td>$productstock</td>";
										echo "<td>$supplierid</td>";
									echo "</tr>";
									}
								}else 
									echo "Error in fetching data";
								
								echo "</table>";

								$sql2 = "select count(*) FROM product";
								$result = $conn->query($sql2);
								$row = $result ->fetch_row();
								$count = ceil($row[0]/4);
								for($pageno=1;$pageno<=$count;$pageno++){
									?><a href="displayproductSupp.php?page=<?php echo $pageno; ?>" style="text-decoration:none"> <?php echo $pageno. " "; ?></a><?php
								}

								CloseCon($conn);
							?>
						</article> 
                </div>
                <!-- End of page-inner -->
            </div>
            <!-- End of page-wrapper -->
      
                
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
        </div>
        <!-- End of div wrapper -->
    </body>
</html>
