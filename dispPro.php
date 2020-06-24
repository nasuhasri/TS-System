<html>
	<head>
		<title>ORDER PRODUCT MANAGEMENT SYSTEM</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <!-- Bootstrap -->
        <link rel="stylesheet" type=text/css href="library/bootstrap/bootstrap-4.5.0-dist/css/bootstrap.min.css">
        <!-- Javascript Code for Bootstrap -->
        <script src="library/jquery/jquery-3.5.1.min.js">  </script>
        <script src="library/popper/node_modules/@popperjs/core/dist/umd/popper.min.js"> </script>
		<script src="library/bootstrap/bootstrap.min.js"> </script>
		
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
                <h2 style="text-align: center">List Of Products</h2>
                <?php
                    $conn = OpenCon();
                    //get page number
                    $page = 0;
    
                    //set variable
                    if(isset($_GET["page"])==true) {
                        $page = ($_GET["page"]);
                    }
                    else {
                        $page = 0;	
                    }
    
                    //algo for pagination in sql
                    if ($page=="" || $page=="1"){
                            $page1 = 0;
                    }
                    else {
                        $page1= ($page*4)-4;
                    }

                    $sql = "SELECT * FROM `product` limit $page1,4";
                    $result = $conn->query($sql);
                    
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $val[] = $row;
                        }
                    }
                    else {
                        $val = [];
                    }

                    //print_r($val);                
                ?>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th><b>Product ID</th>
                                <th><b>Product Name</th>
                                <th><b>Product Price</th>
                                <th><b>Date Manufactured</th>
                                <th><b>Supplier ID</th>
                            </tr>
                        </thead>
                        <!-- For coding -->
                        <?php foreach($val as $row) { ?>
                            <tr class="table-dark">
                                <td><b><?= $row["productid"]; ?></td>
                                <td><b><?= $row["productname"] ?></td>
                                <td><b><?= $row["productprice"] ?></td>
                                <td><b><?= $row["productDManufactured"] ?></td>
                                <td><b><?= $row["supplierid"] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </article>
        </section>

        <footer>
			<?php include 'footer.php'; ?>
		</footer>
    </body>
</html>