<!doctype html>
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
            <link rel="shortcut icon" href="images/favicon.ico" />
            <link rel="stylesheet" type="text/css" href="contentStyle.css">
		</head>
		
        <header>
            <?php include 'header.php'; ?>
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
                    <a class="navbar-brand" href="welcomepage.php">Tomatus Station</a> 
                </div>
				
                <!-- Logout button & register button at the top -->
                <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                    <a href="suppliersignup.php" class="btn btn-danger square-btn-adjust">Supplier Registration</a> 
					<a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
                </div>

                <div style="color: white; padding: 15px 50px 5px 50px; float: left; font-size: 16px;">
                    <a class="btn btn-danger square-btn-adjust">Order Management System</a> 
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
            
            <!-- WRAPPER CONTENT  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 style="text-align:center">Invoices</h1>
							<br>
							<br>
                        </div>

                        <!-- INNER PAGE CONTENT  -->
                        <div class = "content">			
                            <article>
                                
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Invoice ID</th>
                                            <th>Invoice Date</th>
                                            <th>Order ID</th>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Product Price(RM)</th>
                                            <th>Product Quantity</th>
                                            <th>Total Price(RM)</th>
                                        </tr>
                                    </thead>

                                <?php
                                    $conn = OpenCon();

                                    /**Value empID coming from employeeloginaction.php**/
                                    $empID = $_SESSION['login_user'];
                                    
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
                                        $page1= ($page*10)-10;
                                    }

                                    $sql = "SELECT * FROM `invoice` i, `orders` o, `order_product` op, `product` p
                                            WHERE o.orderid = i.orderid
                                            AND o.orderid = op.orderid
                                            and op.productid = p.productid
                                            and o.orderstatus = 'APPROVED'
                                            and o.empid = $empID
                                            limit $page1,4";

                                    //$sql = "SELECT * FROM `invoice` i";
                                    $result = $conn->query($sql);

                                    if($result->num_rows > 0){
                                        while($row = $result->fetch_assoc()){
                                            $invID = $row["invoiceid"];
                                            $invDate = $row["invoicedate"];
                                            $orderid = $row["orderid"];
                                            $prodID = $row["productid"];
                                            $prodNm = $row["productname"];
                                            $prodPrice = $row["productprice"];
                                            $prodQty = $row["productqty"];
                                            $totalPrice = $row["totalPrice"];

                                            echo "<tr>";
                                                echo "<td>$invID</td>";
                                                echo "<td>$invDate</td>";
                                                echo "<td>$orderid</td>";
                                                echo "<td>$prodID</td>";
                                                echo "<td>$prodNm</td>";
                                                echo "<td>$prodPrice</td>";
                                                echo "<td>$prodQty</td>";
                                                echo "<td>$totalPrice</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else{
                                        echo "<p>No invoices have been made yet. Please notify your supplier.</p>";
                                    }

                                    echo "</table>";

                                    $sql2 = "SELECT count(*) FROM `orders` o
                                            WHERE o.orderstatus = 'APPROVED'
                                            AND o.empID = $empID";
                                    $result2 = $conn->query($sql2);
                                    $row = $result2 ->fetch_row();
                                    $count = ceil($row[0]/10);
                                    for($pageno=1;$pageno<=$count;$pageno++){
                                        ?><a href="invoicesEmp.php?page=<?php echo $pageno; ?>" style="text-decoration:none"> <?php echo $pageno. " "; ?></a><?php
                                    }

                                    CloseCon($conn);
                                ?>

                                <table class="table">
                                    <tr>
                                        <td colspan="2" align="center">
                                            <input type="button" value="Back" onclick="history.back()" />
                                        </td>
                                    </tr>
                                </table>
                            </article>
                        </div>
                        <!-- End of div content -->
                    </div>
                    <!-- End of row -->
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