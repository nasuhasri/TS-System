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
            <link rel="stylesheet" type="text/css" href="contentStyle.css">
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
                    <a class="navbar-brand" href="homepageSupp.php">Tomatus Station</a> 
                </div>

                <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                    <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
                </div>

                <div style="color: white; padding: 15px 50px 5px 50px; float: left; font-size: 16px;">
                    <a href="homepageSupp.php"class="btn btn-danger square-btn-adjust">Order Management System</a> 
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
							<br>
							<br>
                        </div>

                        <div class="content">
                            <?php
                                $conn = openCon();

                                $orderid = $_GET['orderid'];

                                $sql = "delete from orders where orderid = $orderid";
                                $result = $conn->query($sql);
                                
                                if(! $result){
                                    die('Could not delete data: '. mysqli_error($conn));
                                }
                                else {
                                    //echo "\n";
                                    //echo "Order with ID: "; echo $orderid; echo " has been deleted";
                                }
                            ?>
                        </div>
                        <!-- End of div content -->

                        <div class="col-md-4 col-sm-4">
							<div class="panel panel-success">
								<div class="panel-heading"> Deleted Order Info</div>
								<div class="panel-body">
									<p>Details: </p>
									<?php
										echo "<p>Order with ID: "; echo $orderid; echo " has been successfully deleted</p>";
									?>
								</div>
								<div class="panel-footer"> Your Satisfaction Is Our Priority </div>
							</div>
                        </div>

                        <table class="table">
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="button" value="Homepage" onclick="window.location.href='homepageSupp.php'" />
                                </td>
                            </tr>
                        </table>
                    </div>              
                    <!-- END OF ROW  -->
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
