<?php
    if(isset($_POST["supplier"])) 
    {
        /* Insert file connOrder.php */
        include 'connOrder.php';
        //Capture selected supplier
        $supplier = $_POST["supplier"];

        //Define supplier and product array
        // $supplierArr = array (
        //                 "Melaka Kaya Raya" => array("Roti Gardenia Coklat", "Roti Gardenia Jagung", "Roti Gardenia Butter"),
        //                 "Johor Maju" =>array("Nestle", "Milo", "Kopi"),
        //                 "Selangor" => array("Aiskrim Walls Coklat", "Aiskrim Walls Vanilla", "Aiskrim Walls Jagung")
        //             );
        
        /* Open connection and chose suppliername and productname */
        $conn = OpenCon();
        $sql = "select suppliername, productname 
                from `supplier` s, `product` p
                where s.suppliername = p.productsupplier
                and s.suppliername = '$supplier'";
         $result = $conn->query($sql);

         if($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 $suppName = $row["suppliername"];
                 $prodName = $row["productname"];

                 

                 if($suppName != 'Select') {
                     echo "<select>";
                        foreach($suppName as $value) {
                            echo "<option>" . $value . "</option>";
                        }
                    echo "</select>";
                 }

                

                 
             }
         }

        //Display product dropdown based on supplier name
        // if($supplier != 'Select') {
        //     //echo "<label> Product Name </label>";
        //     echo "<select>";
        //         foreach($supplierArr[$supplier] as $value) {
        //             echo "<option>" . $value . "</option>";
        //         }
        //     echo "</select>";
       // }

       CloseCon($conn);
    }
?>