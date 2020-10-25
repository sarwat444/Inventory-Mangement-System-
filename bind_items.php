<?php
include 'connect.php';

ob_start();

session_start();
if (isset($_SESSION['Username'])) {
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $category_id =  $_POST['category_id']   ;

         $stmt = $con->prepare("SELECT 
										items.*, 
										givenitemname.GItemCode AS category_Code
                                            FROM 
                                            items
                                            INNER JOIN 
                                            givenitemname 
                                            ON 
                                            items.GItemCode = givenitemname.GItemCode
                                            WHERE  
                                             items.GItemCode =  '$category_id'
                                            ORDER BY 
										items.ItemCode ASC");

			// Execute The Statement

			$stmt->execute();

			// Assign To Variable

			$items = $stmt->fetchAll();


			$output = "" ;
			foreach($items as  $item) {
                echo  "<tr>
          <td>$item[ItemCode]</td>
             <td>$item[SuppliedItemName]</td>
             <td>$item[ItemDafterNo]</td>
              <td>$item[ItemCode]</td>
             <td>$item[ItemCode]</td>
             <td>$item[ItemDafterNo]</td>
              <td>$item[ItemCode]</td>
             <td>$item[ItemCode]</td>
             
          </tr>";
            }

         print_r($output) ;

        }

        }
         
         


