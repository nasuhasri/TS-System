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
				<?php include 'navigation.php'; ?>
			</nav>
			
			<article>
				<h2 style="text-align:center">Supplier Registration Form</h2>
				<form action="insertsupplieraction.php " id="form" method="POST">
				<table>
				<tr> 
					<td>Supplier ID</td>
					<td><input type="text" name="suppID" maxlength="50" placeholder="1" required></td>
				</tr>
				<tr> 
					<td>Supplier Name</td>
					<td><input type="text" name="suppName" maxlength="50" placeholder="Choco Koki Sdn Bhd"></td>
				</tr>
				<tr> 
					<td>Supplier Address</td>
					<td> <textarea name="suppAdd" rows="5" cols="20" placeholder="Lot 50 Bayan Lepas, Pulau Pinang" required></textarea></td>
				</tr>
				<tr> 
					<td>Phone Number</td>
					<td><input type="text" name="suppNo" maxlength="50" placeholder="0179872300" required></td>
				</tr>
				<table>
				<tr>
				    <td></td>
					<td colspan="2" align="center">
					<input type="submit" value="Submit">
					<input type="reset" value="Reset">
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