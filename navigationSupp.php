<!--Data coming from session.php-->
<b>
	<?php
		//include 'connOrder.php';
		//$conn1 = OpenCon();
		//session_start();
		
		/**Value is staffid coming from employeeloginaction.php**/
		// $user_check = $_SESSION['login_user'];
		
		// $sql = "select * from employee where empid = $user_check";
		
		// $result = $conn1->query($sql);
		
		// //output data
		// if($result->num_rows > 0){
		// 	while($row = $result->fetch_assoc()){
		// 		$login_id = $row['empid'];
		// 		$login_name = $row['empfname'];
		// 	}
		// }
		// else{
		// 	header("location:employeelogin.php");
		// 	die();
		// }
	?>
	
	
	
</br>
 <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					<p style="font-size:18; font-color:white;"><?php echo " " .$login_name. " (Supplier ID: " .$login_id. ")";?></p>
				</li>
                <li>
                    <a class="active-menu"  href="homepageSupp.php"><i class="fa fa-dashboard fa-3x"></i> Home</a>
				</li>				
                <li>
                    <a  href="orderReq.php"><i class="fa fa-desktop fa-3x"></i>Order Request</a>
                </li>                    
                <li>
                    <a  href="invoicesSupp.php"><i class="fa fa-edit fa-3x"></i> Invoices </a>
                </li>			
            </ul>               
		</div>
    </nav>
