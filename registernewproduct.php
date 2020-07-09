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
            <?php include 'header.php'; ?>
        </header>
    </head>

    <body>
        <div id="wrapper">
            <!-- Navigation at the top -->
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
            <!-- END NAV SIDE  -->
        
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Order Management System</h1>  
                        </div>
        
                        <div class="content">
                            <article>
                                <h2 style="text-align:center">Product Registration Form</h2> <br>
                                <form action="insertproductaction.php " id="form" method="POST">
                                <!-- style for table padding:2px; border-spacing:20px;  -->
                                <!-- style="border:1px solid black; margin-left:auto; margin-right:auto;" -->
								<table class="table table-borderless">
                                    <tr> 
                                        <td colspan="2" align="center">Product ID</td>
                                        <td><input type="text" name="prodID" maxlength="50" placeholder="2001322" required></td>
                                    </tr>
									<tr> 
										<td colspan="2" align="center">Product Name</td>
										<td><input type="text" name="fullname" maxlength="50" placeholder="Choco Jar"></td>
									</tr>
									<tr> 
										<td colspan="2" align="center">Product Price</td>
										<td> <input type="decimal" name="price" maxlength="100" placeholder="23.50"></td>
									</tr>
									<tr> 
										<td colspan="2" align="center">Product Date Manufactured</td>
										<td> <input type="date" name="dateManu" required></td>
									</tr>
									<tr>
										<td colspan="2" align="center">Supplier ID</td>
										<td><input type="text" name="suppID" maxlength="50" placeholder="1" required></td>
                                    </tr>
								</table>
                                <br>
								<table style="margin-left:auto; margin-right:auto;">
                                    <tr>
                                        <td colspan="2" align="center">
                                        <input type="submit" value="Submit">
                                        <input type="reset" value="Reset">
                                        </td>
                                    </tr>
								</table>
                            </article>
                        </div>
                        <!-- End of div content   -->
                    </div>
                    <!-- End of div row -->
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
