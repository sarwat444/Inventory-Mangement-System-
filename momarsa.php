<?php

	ob_start(); 

	session_start();

	$pageTitle = 'عروض  الممارسه ';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page

		if ($do == 'Manage') { // Manage Members Page

			// Select All Users Except Admin 

		
			$stmt = $con->prepare("SELECT * FROM momarsa   ORDER BY id DESC");


			// Execute The Statement

			$stmt->execute();

			// Assign To Variable 

			$items = $stmt->fetchAll();

			if (! empty($items)) {

			?>
			<div class="main-content-inner">
                       
					   <div class="col-sm-9">
							   <div class="card">
								   <div class="card-body">
									   <div class="data-tables datatable-primary">
										   <table id="dataTable1" class="text-center">
											   <thead class="text-capitalize">
										   <tr>
										   <th>رقم العرض </th>
										  <th> اسم الوحده    </th>
										  <th>تاريخ عرض  الممارسه    </th>
										  <th> الحاله </th>										  
										  <th>التحكم </th>
										   </tr>
										   </thead>

										   <tbody>
										   <?php

										   foreach ($items as $item) {
											   echo "<tr id=".$item['id'].">";
											   echo "<td>" . $item['id'] . "</td>";
											   echo "<td>" . $item['unite_name'] . "</td>";
											   echo "<td>" . $item['momarsa_date'] . "</td>";
											   echo "<td>" ;
											   
											  if( $item['status']  == 0 ){
												  echo 'لم  يتخذ اى  أجراء ' ;
											  }
											  elseif($item['status'] == 1){
												  echo  'تم الموافقه على عرض  الممارسه  '  ; 
											  }
											  elseif($item['status'] == 2){
												echo  'تم الرفض  على عرض  الممارسه  '  ; 
											}
											 
											   
											 echo   "</td>";
											   echo "<td>

											   <a href='momarsa.php?do=Edit&comid=" . $item['id'] . "' class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
											   <a href='momarsa.php?do=Delete&comid=" . $item['id'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف  </a>
											    <a href='momarsa_items.php?do=additems&comid=" . $item['id'] . "' class='btn btn-warning ><i class='fa fa-plus'></i>أضافه   أصناف الى عروض  الممارسه  </a>";
										   echo "</td>";
											   echo "</tr>";
										   } ?>
										   </tbody>
										  
									   </table>
								   </div>
								  
											   <a  href="momarsa.php?do=Add" class="btn btn-primary">أضافه  عرض ممارسه  جديد  <i class="fa fa-plus"></i></a>
											
								
							   </div>
						   </div>
					   </div>
	

			<?php } else {

				echo '<div class="container">';
					echo '<div class="nice-message">لا يوجد اى عرض ممارسه حالى  </div>';
				echo '</div>';

			} ?>

		<?php 

		} elseif ($do == 'Add') { // Add Page ?>

<div class="col-sm-9">
				 <div class="card">
					 <div class="card-body">
					  <div class="card-header"><div class="card-title text-center">أضافه   بيانات  ممارسه  جديده  </div></div>
				  <div class="container ">
					<form class="form-horizontal" action="?do=Insert" method="POST">
						<input type="hidden" name="comid" value="<?php echo $comid ?>" />
						<!-- Start Comment Field -->
						<div class="form-group form-group-lg  text-right">
							<label class="col-sm-2 control-label">اسم الوحده   </label>
							<div class="col-sm-10 col-md-12">
								<input class="form-control  text-right" name="unite_name">
							</div>
						</div>
						<div class="form-group form-group-lg text-right">
							<label class="col-sm-2 control-label ">   تاريخ عرض الممارسه      </label>
							<div class="col-sm-10 col-md-12">
								<input type="date" class="form-control text-right"  name="momarsa_date">
							</div>
						</div>
				
						<div class="form-group form-group-lg text-right">
						<label class="col-sm-2 control-label">  موقف اللجنه    </label>
							<div class="col-sm-10 col-md-12">
								<select name="status" class="form-control text-right">
								<option value="1">الموافقه  على العرض </option>
									<option value="2">رفض  العرض</option>
								</select>
							</div>
						</div>
						<!-- End Comment Field -->
						<!-- Start Submit Field -->
						<div class=" card-footer form-group form-group-lg">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="أدراج  بيانات  الممارسه     " class="btn btn-primary" />
							</div>
						</div>
						<!-- End Submit Field -->
					</form>
				</div>
			</div>
		 </div>
			<?php
		
		} elseif ($do == 'Insert') {
		
			// Insert Member Page
		
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
				echo "<div class='container'>";
		
				// Get Variables From The Form
	
				$unit_name	            =     $_POST['unite_name'];
				$momarsa_date 	        =     $_POST['momarsa_date'];
				$status 	            =     $_POST['status'];
			

				// Validate The Form
		
				$formErrors = array();
		
				if (strlen($unit_name) < 2) {
					$formErrors[] = 'لابد ان يحتوى  على  حرفين على  الاقل </strong>';
				}
		

				// Loop Into Errors Array And Echo It
		
				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}
		
				// Check If There's No Error Proceed The Update Operation
		
				if (empty($formErrors)) {
		
					// Check If User Exist in Database
		
				
		
						// Insert Userinfo In Database

				
		
						$stmt = $con->prepare("INSERT INTO 
															momarsa(unite_name, momarsa_date, status )
														VALUES(:zname, :zmomarsad, :zsarfre )");
						$stmt->execute(array(
		
							'zname' =>  $unit_name,
							'zmomarsad' => $momarsa_date,
							'zsarfre' => $status 
						));
		
						// Echo Success Message
		
						$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . 'تم  أضافه عرض الممارسه  بنجاح </div>';
		
						redirectHome($theMsg, 'back');
		
					}
		
				
		
			}
		
			echo "</div>";
		
		} elseif ($do == 'Edit') {

			// Check If Get Request comid Is Numeric & Get Its Integer Value

			$comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM momarsa  WHERE id = ?");

			// Execute Query

			$stmt->execute(array($comid));

			// Fetch The Data

			$row = $stmt->fetch();

			// The Row Count

			$count = $stmt->rowCount();

			// If There's Such ID Show The Form

			if ($count > 0) { ?>
        <div class="col-sm-9">
				 <div class="card">
					 <div class="card-body">
					  <div class="card-header"><div class="card-title text-center">تعديل  بيانات  الممارسه   </div></div>
				  <div class="container ">
					<form class="form-horizontal" action="?do=Update" method="POST">
						<input type="hidden" name="comid" value="<?php echo $comid ?>" />
						<!-- Start Comment Field -->
						<div class="form-group form-group-lg  text-right">
							<label class="col-sm-2 control-label">اسم الوحده    </label>
							<div class="col-sm-10 col-md-12">
								<input class="form-control  text-right" value="<?php  echo $row['unite_name'] ?>" name="unite_name">
							</div>
						</div>
						<div class="form-group form-group-lg text-right">
							<label class="col-sm-2 control-label ">  تاريخ عرض الممارسه    </label>
							<div class="col-sm-10 col-md-12">
								<input type="date" class="form-control text-right" value="<?php  echo $row['momarsa_date'] ?>" name="momarsa_date">
							</div>
						</div>
						<div class="form-group form-group-lg text-right">
						<label class="col-sm-2 control-label">  موقف اللجنه    </label>
							<div class="col-sm-10 col-md-12">
								<select name="status" class="form-control text-right">
								<option value="1">الموافقه  على العرض </option>
									<option value="2">رفض  العرض</option>
								</select>
							</div>
						</div>
					
						<!-- End Comment Field -->
						<!-- Start Submit Field -->
						<div class=" card-footer form-group form-group-lg">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="حفظ  التعديلات " class="btn btn-primary" />
							</div>
						</div>
						<!-- End Submit Field -->
					</form>
				</div>
			</div>
		 </div>
			<?php

			// If There's No Such ID Show Error Message

			} else {

				echo "<div class='container'>";

				$theMsg = '<div class="alert alert-danger">لا يوجد  اى ممارسه حاليه      </div>';

				redirectHome($theMsg);

				echo "</div>";

			}

		} elseif ($do == 'Update') { 

			echo "<div class='container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form

				$comid 		        =     $_POST['comid'];
				$unite_name         =     $_POST['unite_name'];
				$momarsa_date        =     $_POST['momarsa_date'];
                $status             =      $_POST['status'];


				// Update The Database With This Info

				$stmt = $con->prepare("UPDATE momarsa SET unite_name = ? ,momarsa_date = ? ,  status = ? WHERE id = ?");

				$stmt->execute(array($unite_name , $momarsa_date , $status , $comid));

				// Echo Success Message

				$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . 'تم  تعديل   بيانات  الممارسه   بنجاح </div>';

				redirectHome($theMsg, 'back');

			} else {

				$theMsg = '<div class="alert alert-danger">ناسف  لا تستطيع الوصول  للصفحه  مباشره </div>';

				redirectHome($theMsg);

			}

			echo "</div>";

		} elseif ($do == 'Delete') { // Delete Page

			echo "<div class='container'>";

				// Check If Get Request comid Is Numeric & Get The Integer Value Of It

				$comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('id', 'momarsa', $comid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM momarsa WHERE id = :zid");

					$stmt->bindParam(":zid", $comid);

					$stmt->execute();

					$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . ' لقد تم حذف العنصر  بنجاح</div>';

					redirectHome($theMsg, 'back');

				} else {

					$theMsg = '<div class="alert alert-danger col-md-5">هذا العنصر  غير  موجود  </div>';

					redirectHome($theMsg);

				}

			echo '</div>';

		} 

		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}

	ob_end_flush(); // Release The Output

?>