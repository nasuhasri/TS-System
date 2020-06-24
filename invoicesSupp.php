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
            <link rel="shortcut icon" href="images/favicon.ico">
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
                    <a class="navbar-brand" href="index.html">Tomatus Station</a> 
                </div>
                <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                    <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
                </div>

                <div style="color: white; padding: 15px 50px 5px 50px; float: left; font-size: 16px;">
                    <a href="tomatus.php"class="btn btn-danger square-btn-adjust">Order Management System</a> 
                </div>
            </nav>

            <!-- /. NAV TOP  -->
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
                            <h1>Order Management System</h1>
            </div>

            <!-- INNER PAGE CONTENT  -->
			<div class = "">			
                <article>
                    <h2 style="text-align:center">Invoices</h2>
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

                        $sql = "SELECT * FROM `invoice` i, `orders` o, `order_product` op, `product` p
                                WHERE o.orderid = i.orderid
                                AND o.orderid = op.orderid
                                and op.productid = p.productid
                                and p.supplierid = $suppID
                                limit $page1,4";

                        //$sql = "SELECT * FROM `invoice` i";
                        $result = $conn->query($sql);

                        echo "<table>";
                            echo "<tr>";
                                echo "<th>Invoice ID</th>";
                                echo "<th>Invoice Date</th>";
                                echo "<th>Order ID</th>";
                                echo "<th>Product ID</th>";
                                echo "<th>Product Name</th>";
                                echo "<th>Product Price(RM)</th>";
                                echo "<th>Product Quantity</th>";
                                echo "<th>Total Price(RM)</th>";
                            echo"</tr>";

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
                            echo "Error in fetching data";
                        }

                        echo "</table>";

                        $sql2 = "select count(*) FROM invoice";
                        $result2 = $conn->query($sql2);
                        $row = $result2 ->fetch_row();
                        $count = ceil($row[0]/4);
                        for($pageno=1;$pageno<=$count;$pageno++){
                            ?><a href="invoicesSupp.php?page=<?php echo $pageno; ?>" style="text-decoration:none"> <?php echo $pageno. " "; ?></a><?php
                        }

                        CloseCon($conn);
                    ?>
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