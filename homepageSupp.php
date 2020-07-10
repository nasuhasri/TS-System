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
                    <div class="row">
                        <div class="col-md-12">
                        <h1>Order Management System</h1>   
                            <nav>
                                <p style="font-size:25px; color: Black;"><?php echo "Hello " .$login_name. " (Supplier ID: " .$login_id. ")";?></p>
                            </nav>
                        </div>
                    </div>              
                    <!-- /. ROW  -->

                    <hr/>              
                    <div class="row">
                        <!-- First TexBox (Completed Order) -->
					    <div class="col-md-5 col-sm-10 col-xs-10">           
				            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-check-square-o"></i>
                                </span>
                    
                                <div class="text-box" >
                                    <?php
                                        /* remove -> include 'conn.php'; bcs
                                        we have put connection inside header page */
                                        $conn = OpenCon();

                                        $suppID = $_SESSION['login_supplier'];
                                                        
                                        $sql = "select count(op.orderid) as totalorder
                                                from `order_product` op, `product` p, `orders` o, `supplier` s
                                                where op.productid = p.productid
                                                and o.orderid = op.orderid
                                                and p.supplierid = s.supplierid
                                                and o.orderstatus = 'APPROVED'
                                                and s.supplierid = $suppID";
                                        $result = $conn->query($sql);
                                        
                                        if ($result->num_rows > 0) {
                                            //output data of each row
                                                                
                                            while($row = $result->fetch_assoc())
                                            {                              
                                                    $approve = $row["totalorder"];
                                            }
                                        }
                                        else {
                                            echo "Error in fetching data";
                                        }
                                        
                                        CloseCon($conn);			
                                    ?>
                                    <p class="main-text"><?php echo "<a href=displayapproveorderSupp.php>Completed Order</a>" ?></p>      
                                    <p class="main-text"><?php echo $approve ?></p>
                                </div>
				            </div>
				        </div>
                        
                        <!-- Second TextBox (Total Sales) -->
                        <div class="col-md-5 col-sm-10 col-xs-10">           
				            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-dollar"></i>
                                </span>
                                
                                <div class="text-box">
                                    <?php
                                        $conn = OpenCon();

                                        $sql= "SELECT SUM(totalPrice) AS totalsales
                                                FROM orders";
                                        $sql2 = "SELECT SUM(totalPrice) AS totalsales
                                                from `order_product` op, `product` p, `orders` o, `supplier` s
                                                where op.productid = p.productid
                                                and o.orderproduct = p.productname
                                                and p.supplierid = s.supplierid
                                                and s.supplierid = $suppID
                                                and o.orderstatus = 'APPROVED'";
                                        $result = $conn->query($sql2);

                                        if($result-> num_rows > 0) {
                                            //output data of each row
                                            while($row = $result->fetch_assoc()){
                                                
                                                    $sales = $row["totalsales"];
                                            }
                                        }						
				                        CloseCon($conn);
                                    ?>                                    
                                    <p class="main-text">Total Sales</p>
                                    <p class="main-text"><?php echo "RM ", $sales ?></p>
					            </div>
				            </div>
                        </div>
                    </div>
                    <!-- End of div row -->

                    <!-- Second row -->
                    <div class="row">
                        <!-- First text-box (Pending Order)  -->
                        <div class="col-md-5 col-sm-10 col-xs-10">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                <div class="text-box" >
                                    <?php
                                        /* remove -> include 'conn.php'; bcs
                                        we have put connection inside header page */
                                        $conn = OpenCon();

                                        $suppID = $_SESSION['login_supplier'];
                                                        
                                        $sql = "select count(op.orderid) as pendingorder
                                                from `order_product` op, `product` p, `orders` o, `supplier` s
                                                where op.productid = p.productid
                                                and o.orderid = op.orderid
                                                and p.supplierid = s.supplierid
                                                and o.orderstatus = 'PENDING'
                                                and s.supplierid = $suppID";
                                        $result = $conn->query($sql);
                                        
                                        if ($result->num_rows > 0) {
                                            //output data of each row
                                                                
                                            while($row = $result->fetch_assoc())
                                            {                              
                                                    $pending = $row["pendingorder"];
                                            }
                                        }
                                        else {
                                            echo "Error in fetching data";
                                        }
                                        
                                            CloseCon($conn);			
                                    ?>
                                    <p class="main-text"><?php echo "<a href=displaypendingorderSupp.php>Pending Order</a>" ?></p>                                   
                                    <p class="main-text"><?php echo $pending; ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Second text-box (Rejected Order)  -->
                        <div class="col-md-5 col-sm-10 col-xs-10">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-minus-circle"></i>
                                </span>
                                <div class="text-box">
                                    <?php
                                        $conn = OpenCon();

                                        $sql = "select count(op.orderid) as totalreject
                                                from `order_product` op, `product` p, `orders` o, `supplier` s
                                                where op.productid = p.productid
                                                and o.orderid = op.orderid
                                                and p.supplierid = s.supplierid
                                                and o.orderstatus = 'REJECTED'
                                                and s.supplierid = $suppID";
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
                                    <p class="main-text"><?php echo "<a href=displayrejectorderSupp.php>Rejected Order</a>" ?></p>
                                    <p class="main-text"><?php echo $reject; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
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
