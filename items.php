<?php

	ob_start(); 

	session_start();

	$pageTitle = 'الاصناف ';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page

		if ($do == 'Manage') { // Manage Members Page

			?>
			<div class="main-content-inner">
                       
					   <div class="col-sm-9">
							   <div class="card">



                                   <select  class="col-md-5" class="category_id" name="category_id"   id="category_id">
                                       <option value="0">...</option>
                                       <?php
                                       $allMembers = getAllFrom("*", "givenitemname", "", "", "GItemCode");
                                       foreach ($allMembers as $user) {
                                           echo "<option value='" . $user['GItemCode'] . "'>" . $user['GItemName'] . "</option>";
                                       }
                                       ?>
                                   </select>


								   <div class="card-body">
									   <div class="data-tables datatable-primary">
										   <table id="dataTable1" class="text-center">
											   <thead class="text-capitalize">
										   <tr>
										  <th>الكود</th>
										  <th>رقم المويديل</th>

										  <th>اسم الصنف  </th>

										  <th>  نوع الصنف  </th>
										  <th>الشركه المصنعه </th>
										  <th>الكميه </th>
										  <th> بلد الصنع  </th>
										
										  <th>التحكم </th>
											  
										   </tr>
										   </thead>

										   <tbody>

										   </tbody>
										  
									   </table>
								   </div>
								  

								
							   </div>
						   </div>
					   </div>
	

		<?php 

		}



		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}

	ob_end_flush(); // Release The Output

?>