<!DOCTYPE html>
<html lang="en">

<head>
<link rel="shortcut icon" href="images/favicon.ico" />
</head>

</html>
<?php
	
$conn = mysqli_connect("localhost","root","","order_management") or die("Database Not Connected");


if($_SERVER['REQUEST_METHOD'] == 'POST')
{

	if(isset($_POST['submit']))
	{

		if(isset($_POST['term']))
		{

			$supplierid = mysqli_escape_string($conn, $_POST['supplierid']);
			$suppliername = mysqli_escape_string($conn, $_POST['suppliername']);
			$supplieraddress = mysqli_escape_string($conn, $_POST['supplieraddress']);
			$suppliertellno = mysqli_escape_string($conn, $_POST['suppliertellno']);
			$supplieremail = mysqli_escape_string($conn, $_POST['supplieremail']);
			$supppwd = mysqli_escape_string($conn, $_POST['password']);

			function validate($form_data)
			{
				$form_data = trim( stripcslashes( htmlspecialchars($form_data) ) );
				return $form_data;
			}

			$vsupid = validate($supplierid);
			$vsupname = validate($suppliername);
			$vsupaddress = validate($supplieraddress);
			$vsuptell= validate($suppliertellno);
			$vsupemail= validate($supplieremail);
			$vsuppassword = validate($supppwd);

			if(!empty($vsupid) && !empty($vsupname) && !empty($vsupaddress) && !empty($vsuptell) && !empty($vusertell) && !empty($vsuppassword)&& !empty($vsupemail)&& !empty($vsuppassword))
			{

				$pass = password_hash($vsuppassword, PASSWORD_BCRYPT);

				$insert = "INSERT INTO `supplier`(`supplierid`,`suppliername`,`supplieraddress`,`suppliertellno`,`supplieremail`,`supppswd`) VALUES('$vsupid','$vsupname','$vsupaddress','$vsuptell','$vsupemail','$vsuppassword')";

				if(mysqli_query($conn, $insert))
				{
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

									/**Value is staffid coming from supplierloginaction.php**/
									$empid = $_SESSION['login_employee'];						

									$sql1 = "SELECT * FROM `employee` e, `supplier` s
											WHERE e.empid=s.empid";
									
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

									/* Get supplieremail and empfname from $val */
									foreach($val as $row){
										$email = $row["supplieremail"];
										$name = $row["empfname"];
									}

									try {
										//Server settings
										//$mail->SMTPDebug = 2;                                       // Enable verbose debug output
										$mail->isSMTP();                                            // Set mailer to use SMTP
										$mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
										$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
										$mail->Username   = 'nursyahirahamirahariffin@gmail.com';                     // SMTP username
										$mail->Password   = 'Incorrectpassword';                               // SMTP password
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
										echo '';
									
									}
									catch (Exception $e) {
										echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
									}
								?>
							</article>
						</div>
					</div>
					<!-- End of row -->

					<hr>
					<!-- Second row -->
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<div class="panel panel-success">
								<div class="panel-heading"> New Created Supplier Account Info</div>
								<div class="panel-body">
									<p>Details: </p>
									<?php
										echo "<p>Your account was created by: "; echo $empfname; echo "from Tomatus Station</p>";
									?>									
									<p>Your account has been successfully created<p>
								</div>
								<div class="panel-footer"> Your Satisfaction Is Our Priority </div>
							</div>
						</div>

						<div class="col-md-4 col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading"> Messages Info </div>
								<div class="panel-body">
									<p>New record created successfully for invoice</p>
									<p>Stock for the product has been updated</p>
								</div>
								<div class="panel-footer"> Your Satisfaction Is Our Priority </div>
							</div>
						</div>
					</div>
					<!-- End of Second Row -->
				}
				else
				{
					echo "<script type='text/javascript'>alert('Failed!')</script>";
				}

			}
			else
			{
				echo "<script type='text/javascript'>alert('Empty Data!')</script>";
			}

		}
		else
		{
			echo "<script type='text/javascript'>alert('Please check term and condition!')</script>";
		}

	}

}

?>
	
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Register Supplier</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">


<div class="container">
	<div class="row justify-content-center">
		<div class="col-5">
			<h1>Register Now</h1>
			<form method="post">
				<div class="form-group">
					<label>Supplier ID</label>
					<input type="text" name="supplierid" placeholder="Enter ID" class="form-control">
				</div>
				<div class="form-group">
					<label>Supplier Name</label>
					<input type="text" name="suppliername" placeholder="Enter Name" class="form-control">
				</div>
				<div class="form-group">
					<label>Supplier Address</label>
					<input type="text" name="supplieraddress" placeholder="Enter Address" class="form-control">
				</div>
				
				<div class="form-group">
					<label>Supplier Contact Number</label>
					<input type="text" name="suppliertellno" placeholder="Enter Contact Number" class="form-control">
				</div>
				
				<div class="form-group">
					<label>Supplier Email</label>
					<input type="text" name="supplieremail" placeholder="Enter Email" class="form-control">
				</div>
				
				<div class="form-group">
					<label>Supplier Password</label>
					<input type="Password" name="password" placeholder="*******" class="form-control">
				</div>
				<input type="checkbox" name="term"> I Follow All Term & Condition <br>
				<div>
				<br>
				<input type="submit" name="submit" value="Submit" class="btn btn-lg btn-primary mt-3"> <br>
				<input type="button" value="Back" class="btn btn-lg btn-primary mt-3" onclick="window.location.href='welcomepage.php'" />
				</div>
			</form>
			<h3 style="color:red;"><?php echo @$msg; ?></h3>
		</div>
	</div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>