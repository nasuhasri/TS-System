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
                <!-- Navigation header at the top -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="homepage.php">Tomatus Station</a> 
                </div>
                
                <!-- Logout button & register button at the top -->
                <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                    
					<a href="suppliersignup.php" class="btn btn-danger square-btn-adjust">Supplier Registration</a> 
					<a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
                </div>
                
                <!-- Order Management button at the top -->
                <div style="color: white; padding: 15px 50px 5px 50px; float: left; font-size: 16px;">
                    <a href="homepage.php"class="btn btn-danger square-btn-adjust">Order Management System</a> 
                </div>
            </nav>
               
            <!-- NAV TOP & sidebar -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <?php include 'navigation.php'; ?>
                    </ul>                
                </div>
            </nav>

            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Order Management System</h1>   
                            <nav>
                                <p style="font-size:25px; color: black;"><?php echo "Hello " .$login_name. " (Staff ID: " .$login_id. ")";?></p>
                            </nav>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr>

                    <!-- First row -->
                    <div class="row">
                        <!-- First column (Total Order) -->
                        <div class="col-md-5 col-sm-10 col-xs-10">           
				            <div class="panel panel-back noti-box">
					            <span class="icon-box bg-color-blue set-icon">
						            <i class="fa fa-bars"></i>
                                </span>
                                
					            <div class="text-box">
						                <?php
                                            /* remove -> include 'conn.php'; bcs
                                            we have put connection inside header page */
                                            $conn = OpenCon();

                                            /**Value is supplierid coming from supplierloginaction.php**/
                                            $empID = $_SESSION['login_user'];
                                    
                                            $sql = "SELECT count(o.orderid) AS totalorder
                                                    FROM `order_product` op, `product` p, `orders` o
                                                    WHERE op.productid = p.productid
                                                    AND o.orderid = op.orderid
                                                    AND o.empID = $empID";
                                            $result = $conn->query($sql);
                                    
                                            if ($result->num_rows > 0) {
                                                //output data of each row
                                                                    
                                                while($row = $result->fetch_assoc())
                                                {                              
                                                        //echo "<br>" . $row["totalorder"] . "<br>";
                                                        $totalorder = $row["totalorder"];
                                                }
                                            }
                                            else {
                                                echo "Error in fetching data";
                                            }
                                            
                                            CloseCon($conn);			
                                        ?>
                                        <p class="main-text"><?php echo "<a href=displayorderfromdb.php>$totalorder Request</a>" ?></p>
                                        <p class="">Orders</p>
					            </div>
				            </div>
                        </div>
                        
                        <!-- Second column (Total Invoice) -->
                        <div class="col-md-5 col-sm-10 col-xs-10">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-green set-icon">
                                    <i class="fa fa-check-square-o"></i>
                                </span>
                            
                            <div class="text-box" >
                                <?php
                                    $conn = OpenCon();
                                    
                                    $sql = "SELECT count(i.invoiceid) AS totalinvoice
                                            FROM `orders` o, `invoice` i
                                            WHERE o.orderid = i.orderid
                                            AND o.orderstatus = 'APPROVED'
                                            AND o.empID = $empID";
                                    $result = $conn->query($sql);

                                    if($result-> num_rows > 0) {
                                        //output data of each row
                                        while($row = $result->fetch_assoc()){                                        
                                            //echo "<br>" .$row["totalinvoice"] . "</br>";
                                            $invoice = $row["totalinvoice"];
                                        }
                                    }                                        
                                    CloseCon($conn);
                                ?>
                                <p class="main-text"><?php echo "<a href=invoicesEmp.php>$invoice Completed</a>" ?></p>                                
                                <p class="">Orders</p>
                            </div>
                        </div>
                        <!-- Row first -->
                    </div>

                    <!-- Second row -->
                    <div class="row">
                        <!-- Third column (Total Pending Order) -->
                        <div class="col-md-5 col-sm-10 col-xs-10">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-brown set-icon">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                <div class="text-box" >
                                    <?php
                                        $conn = OpenCon();

                                        $sql = "SELECT count(o.orderid) AS totalpending
                                                FROM `orders` o
                                                WHERE o.orderstatus = 'PENDING'
                                                AND o.empID = $empID";
                                        $result = $conn->query($sql);

                                        if($result-> num_rows > 0) {
                                            //output data of each row
                                            while($row = $result->fetch_assoc()){                                        
                                                //echo "<br>" .$row["totalpending"] . "</br>";
                                                $pending = $row["totalpending"];
                                            }
                                        }                                            
                                        CloseCon($conn);
                                    ?>
                                    <p class="main-text"><?php echo "<a href=pendingorder.php>$pending Pending</a>" ?></p>
                                    <p class="">Orders</p>
                                </div>
                            </div>
                        </div>

                        <!-- Fourth column (Total Rejected Order) -->
                        <div class="col-md-5 col-sm-10 col-xs-10">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-minus-circle"></i>
                                </span>
                            
                            <div class="text-box">
                                <?php
                                    $conn = OpenCon();

                                    $sql = "SELECT count(o.orderid) AS totalreject
                                            FROM `orders` o
                                            WHERE o.orderstatus = 'REJECTED'
                                            AND o.empID = $empID";
                                    $result = $conn->query($sql);

                                    if($result-> num_rows > 0) {
                                        //output data of each row
                                        while($row = $result->fetch_assoc()){                                        
                                            //echo "<br>" .$row["totalreject"] . "</br>";
                                            $reject = $row["totalreject"];
                                        }
                                    }                                        
                                    CloseCon($conn);
                                ?>
                                <p class="main-text"><?php echo "<a href=rejectedorder.php>$reject Rejected</a>" ?></p>
                                <p class="">Orders</p>
                            </div>
                        </div>                        
                    </div>
                    <!-- End Row kedua -->
                </div>
                <!-- End of Page inner -->
            </div>
            <!-- End of Page wrapper -->
        </div>
        <!-- End of Wrapper  -->

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
