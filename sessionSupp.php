<?php
	include 'connOrder.php';
	$conn1 = OpenCon();
	session_start();
	
	/**Value is staffid coming from supplierloginaction.php**/
	$user_check = $_SESSION['login_supplier'];
	
	$sql = "select * from supplier where supplierid = $user_check";
	
	$result = $conn1->query($sql);
	
	//output data
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$login_id = $row['supplierid'];
			$login_name = $row['suppliername'];
		}
	}
	else{
		header("location:supplierlogin.php");
		die();
	}
	
	CloseCon($conn1);
?>