<?php
	include 'connOrder.php';
	$conn1 = OpenCon();
	session_start();
	
	 /**Value is staffid coming from employeeloginaction.php**/
	$user_check = $_SESSION['login_user'];
	
	$sql = "select * from employee where empid = $user_check";
	
	$result = $conn1->query($sql);
	
	//output data
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$login_id = $row['empid'];
			$login_name = $row['empfname'];
		}
	}
	else{
		header("location:employeelogin.php");
		die();
	}
	
	CloseCon($conn1);
?>