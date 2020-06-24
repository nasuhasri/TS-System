<!DOCTYPE html>

<html>
	<head>
		<title>ORDER PRODUCT MANAGEMENT SYSTEM</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		
		<header>
			<?php include 'header.php'; ?>	
		</header>
		
		<section>
			<nav>
				<ul>
					<?php include 'navigation.php'; ?>
				</ul>
			</nav>
			
			<article>
				<h2 style="text-align: center">Supplier Details</h2>
				<?php
					$sID = $_POST["suppID"];
					$sName = $_POST["suppName"];
					$sAdd = $_POST["suppAdd"];
					$sNum = $_POST["suppNo"];

					$conn = OpenCon();
					$sql = "INSERT INTO supplier (supplierID, supplierName, supplierAddress, supplierTellNo)
							VALUES ($sID, '$sName', '$sAdd', '$sNum')";
					   
					if(mysqli_query($conn, $sql)) {
						//	echo "New record \n";
						//display back all the data that has been inserted.
					$sql2 ="select * from supplier where supplierID = $sID";
					
					$result = $conn->query($sql2);
					if($result-> num_rows> 0) {
						//output data of each row
						while($row = $result->fetch_assoc()){

							$supplierid = $row["supplierID"];
							$suppliername =$row["supplierName"];
							$supplieraddress = $row["supplierAddress"];
							$suppliernumber = $row["supplierTellNo"];
							
							echo "<table>";
							echo "<tr>";
								echo "<td>Supplier ID</td>";
								echo"<td>$supplierid</td>";
							echo"</tr>";
							echo "<tr>";
								echo "<td>Supplier Name</td>";
								echo"<td>$suppliername</td>";
							echo"</tr>";
							echo "<tr>";
								echo "<td>Supplier Address</td>";
								echo"<td>$supplieraddress</td>";
							echo"</tr>";
							echo "<tr>";
								echo "<td>Phone Number</td>";
								echo"<td>$suppliernumber</td>";
							echo"</tr>";
						echo "</table>";
						}
					}
					}
					else {
						echo "Error : " . $sql. "<br>" . mysqli_error($conn);
					}
					CloseCon($conn);

			   ?>
			   <table>
			   <tr>
					<td colspan="2" align="center">
				    <input type="button" value="Home" onclick="window.location.href='homepage.php'"/>
					</td>
				</tr>
				</table>
			</article>
		</section>
		
		<footer>
			<?php include 'footer.php'; ?>
		</footer>	
		
		
	</body>
</html>