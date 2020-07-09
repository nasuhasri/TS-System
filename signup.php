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
			$empfname = mysqli_escape_string($conn, $_POST['empFName']);
			$emplname = mysqli_escape_string($conn, $_POST['empLName']);
			$empeml = mysqli_escape_string($conn, $_POST['empEml']);
			$emptell = mysqli_escape_string($conn, $_POST['empTell']);
			$empsal = mysqli_escape_string($conn, $_POST['empSal']);
			$emppass = mysqli_escape_string($conn, $_POST['password']);

			function validate($form_data)
			{
				$form_data = trim( stripcslashes( htmlspecialchars($form_data) ) );
				return $form_data;
			}

			$vuserid = validate($empid);
			$vuserfname = validate($empfname);
			$vuserlname = validate($emplname);
			$vuseremail = validate($empeml);
			$vusertell = validate($emptell);
			$vusersalary = validate($empsal);
			$vuserpass = validate($emppass);

			if(!empty($vuserid) && !empty($vuserfname) && !empty($vuserlname) && !empty($vuseremail) && !empty($vusertell)  && !empty($vusersalary) && !empty($vuserpass))
			{

				$pass = password_hash($vuserpass, PASSWORD_BCRYPT);

				$insert = "INSERT INTO `employee`(`empid`,`empfname`,`emplname`,`empEmail`,`emptellno`,`empsalary`,`emppwd`) VALUES('$vuserid','$vuserfname','$vuserlname','$vuseremail','$vusertell','$vusersalary','$vuserpass')";

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
<title>Register User</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">


<div class="container">
	<div class="row justify-content-center">
		<div class="col-5">
			<h1>Register Now</h1>
			<form method="post">
				<div class="form-group">
					<label>User ID</label>
					<input type="text" name="empID" placeholder="Enter ID" class="form-control">
				</div>
				<div class="form-group">
					<label>User First Name</label>
					<input type="text" name="empFName" placeholder="Enter First Name" class="form-control">
				</div>
				<div class="form-group">
					<label>User Last Name</label>
					<input type="text" name="empLName" placeholder="Enter Last Name" class="form-control">
				</div>
				<div class="form-group">
					<label>User Email</label>
					<input type="text" name="empEml" placeholder="Enter Email" class="form-control">
				</div>
				<div class="form-group">
					<label>User Telephone Number</label>
					<input type="text" name="empTell" placeholder="Enter Telephone Number" class="form-control">
				</div>
				<div class="form-group">
					<label>User Salary</label>
					<input type="text" name="empSal" placeholder="Enter Salary" class="form-control">
				</div>
				<div class="form-group">
					<label>User Password</label>
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