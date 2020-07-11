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

			$empid = mysqli_escape_string($conn, $_POST['empID']);
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

			$vuserid = validate($empid);
			$vsupid = validate($supplierid);
			$vsupname = validate($suppliername);
			$vsupaddress = validate($supplieraddress);
			$vsuptell= validate($suppliertellno);
			$vsupemail= validate($supplieremail);
			$vsuppassword = validate($supppwd);

			if(!empty($vuserid) && !empty($vsupid) && !empty($vsupname) && !empty($vsupaddress) && !empty($vsuptell) && !empty($vusertell) && !empty($vsuppassword)&& !empty($vsupemail)&& !empty($vsuppassword))
			{

				$pass = password_hash($vsuppassword, PASSWORD_BCRYPT);

				$insert = "INSERT INTO `supplier`(`empid`,`supplierid`,`suppliername`,`supplieraddress`,`suppliertellno`,`supplieremail`,`supppwd`) VALUES('$vuserid','$vsupid','$vsupname','$vsupaddress','$vsuptell','$vsupemail','$vsuppassword')";

				if(mysqli_query($conn, $insert))
				{
					echo "<script type='text/javascript'>alert('Registered successfully!')</script>";
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
					<label>Employee ID</label>
					<input type="text" name="empID" placeholder="Enter ID" class="form-control">
				</div>
				
				<div class="form-group">
					<label>Supplier ID</label>
					<input type="text" name="supplierid" placeholder="Enter Supplier ID" class="form-control">
				</div>
				<div class="form-group">
					<label>Supplier Name</label>
					<input type="text" name="suppliername" placeholder="Enter Supplier Name" class="form-control">
				</div>
				<div class="form-group">
					<label>Supplier Address</label>
					<input type="text" name="supplieraddress" placeholder="Enter Supplier Address" class="form-control">
				</div>
				
				<div class="form-group">
					<label>Supplier Contact Number</label>
					<input type="text" name="suppliertellno" placeholder="Enter Supplier Contact Number" class="form-control">
				</div>
				
				<div class="form-group">
					<label>Supplier Email</label>
					<input type="text" name="supplieremail" placeholder="Enter Supplier Email" class="form-control">
				</div>
				
				<div class="form-group">
					<label>Supplier Password</label>
					<input type="Password" name="password" placeholder="*******" class="form-control">
				</div>
				<input type="checkbox" name="term"> I Follow All Term & Condition <br>
				<div>
				<br>
				<input type="submit"style="background-color:blue;color:white;width:150px; height:40px;" value="Submit">
											<input type="button" onclick="history.back()" style="background-color:red;color:white;width:150px; height:40px;" value="Back">
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