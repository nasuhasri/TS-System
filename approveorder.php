<!doctype html>
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
			
			 <!-- /. NAV SIDE  -->
			 <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Order Management System</h1>
            </div>
			
			<div class="">
				<article>
					<h2 style="text-align:center">Approve Order</h2>
					<?php
						$conn = OpenCon();

						//take order id from url
						$orderid = $_GET["orderid"];
						
						$sql = "UPDATE `orders` o
								SET o.orderstatus='APPROVED'
								WHERE o.orderid=$orderid";
						$result = $conn->query($sql);
						
						if(! $result){
							die('Could not update data: '. mysqli_error($conn));
						}
						else {
							echo "Order with ID: "; echo $orderid; echo " has been approved";
						}

						/* Insert data into table invoice */
						/* Get orderID using rand method */
						$invID = rand(100000,999999);
						/*Change the line below to our timezone!*/
						date_default_timezone_set('Asia/Kuala_Lumpur');
						$invDate = date("yy/m/d");

						$sqlInv = "INSERT INTO `invoice`(invoiceid, invoicedate, orderid)
									VALUES ($invID, '$invDate', $orderid)";

						/* Using if else to know either the sql statement successful or not */
						if (mysqli_query($conn, $sqlInv)) {
							echo "<br>Table invoice: New record created successfully \n";
						}
						else {
							echo "Error: " . $sqlInv . "<br>" . mysqli_error($conn);
						}

						use PHPMailer\PHPMailer\PHPMailer;
						use PHPMailer\PHPMailer\Exception;
						
						/* Exception class. */
						require 'PHPMailer-master\src\Exception.php';
						
						/* The main PHPMailer class. */
						require 'PHPMailer-master\src\PHPMailer.php';
						
						/* SMTP class, needed if you want to use SMTP. */
						require 'PHPMailer-master\src\SMTP.php';
						
						/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
						$mail = new PHPMailer(TRUE);

						/**Value is supplierid coming from supplierloginaction.php**/
						$suppID = $_SESSION['login_supplier'];						

						$sql1 = "SELECT * FROM `employee` e, `orders` o
								WHERE o.empid=e.empid
								AND o.orderid = $orderid";
						
						$result1 = $conn->query($sql1);

						$val = array();

						/* Retrieve data from db. Cannot use fetch_assoc() */
						if($result1->num_rows > 0){
							while($row = mysqli_fetch_array($result1)){
								$val[] = $row;
							}						
						}
						else {
							$val = [];
						}

						/* Get empEmail and empfname from $val */
						foreach($val as $row){
							$email = $row["empEmail"];
							$name = $row["empfname"];
						}

						try {
							//Server settings
							//$mail->SMTPDebug = 2;                                       // Enable verbose debug output
							$mail->isSMTP();                                            // Set mailer to use SMTP
							$mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
							$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
							$mail->Username   = 'nasuhasri00@gmail.com';                     // SMTP username
							$mail->Password   = 'Android00';                               // SMTP password
							$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
							$mail->Port       = 587;                                    // TCP port to connect to
						
							//Recipients
							$mail->setFrom('admin@example.com', $suppID);
							$mail->addAddress($email, $name); 
						
							// Attachments
							//$mail->addAttachment('/home/cpanelusername/attachment.txt');         // Add attachments
							//$mail->addAttachment('/home/cpanelusername/image.jpg', 'new.jpg');    // Optional name
							//$mail->addAttachment('email.html');  
						
							// Content
							$mail->isHTML(true);                                  // Set email format to HTML
							$mail->Subject = 'Order Approved';
							$mail->Body    = file_get_contents('email.html');
							//$mail->Body    = include('email.html');
							$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
							//$headers .= "MIME-Version: 1.0\r\n";
							//$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

							$mail->send();
							echo '<br>Message has been sent';
						
						} catch (Exception $e) {
							echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						}

						
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