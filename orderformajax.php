<?php 
    include 'connOrder.php'; 

    if(isset($_POST["supplier"])) {
        $supplierid = $_POST["supplier"];
        $conn = OpenCon();
        $sqlP = "SELECT * FROM supplier s 
                JOIN product p ON s.supplierid = p.supplierid 
                WHERE p.supplierid = $supplierid";
        $resultP = $conn->query($sqlP);

        if($resultP->num_rows > 0){
            echo '<option value="-1">Select Product</option>';

            while($row = $resultP->fetch_assoc()) {
                echo "<option value= '". $row['productname'] ."'>" .$row['productname']. "</option>";
            }
        }
        
    }
?>