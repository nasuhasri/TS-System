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
				<h2 style = "text-align: center">Display All Order From Database</h2>
				<?php
					 /* remove -> include 'conn.php'; bcs
                    we have put connection inside header page */
                    $conn = OpenCon();
                                    
                    //get page number
                    $page = 0;
                                    
                    //set variable
                    if(isset($_GET["page"])==true){
                        $page = $_GET["page"];					
                    }
                                    
                    else{
                        $page=0;
                    }
                                    
                    //algo for pagination in sql
                    if($page=="" || $page=="1"){
                        $page1=0;
                    }
                    else {
                        $page1 = ($page*4)-4;						
                    }
                                    
                    $sql = "select * 
                            from `orders` ord, `order_product` op 
                            where ord.orderid = op.orderid
                            limit $page1, 4";
                    $result = $conn->query($sql);
                                    
                    echo "<table>";
                        echo "<tr>";
                        echo "<th> Order ID </th>";
                        echo "<th> Order Date </th>";
                        echo "<th> Order Time </th>";
                        echo "<th> Product ID </th>";                        
                        echo "<th> Product Name </th>";
                        echo "<th> Product Quantity </th>";
                        echo "<th> Order Status </th>";
                    echo "</tr>";
                                    
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
                                                    
                            echo "<tr>";
                                echo "<td> $orderid </td>";
                                // echo "<td><a href=displayorderdetails.php?orderid=$orderid>$orderid</a></td>";
                                echo "<td> $date </td>";
                                echo "<td> $time </td>";
                                echo "<td> $proID </td>";
                                echo "<td> $product </td>";
                                echo "<td> $proQty </td>";
                                echo "<td> $status </td>";
                            echo "</tr>";
                        }
                    }
                    else {
                        echo "Error in fetching data";
                    }
                    
                
                                    
                    echo "</table>";
                                    
                        //count number of record
                        //to calc the possible page we may have
                        $sql2 = "select count(*) FROM `orders`";
                        $result = $conn->query($sql2);
                        $row = $result->fetch_row();
                        $count = ceil($row[0]/4);
                                    
                        //insert into url
                        for($pageno=1; $pageno<=$count; $pageno++){
                            ?><a href = "displayorderfromdb1.php?page=<?php echo $pageno;?>"style="text-decoration: none"><?php echo $pageno. " "; ?></a><?php		
                        }
                                    
                                
                        CloseCon($conn);				
					
				?>
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
