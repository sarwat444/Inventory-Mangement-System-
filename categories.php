<?php

	ob_start(); 

	session_start();

	$pageTitle = 'الاصناف  الرئيسيه  ';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page

		if ($do == 'Manage') { // Manage Members Page

			// Select All Users Except Admin 

			$stmt = $con->prepare("SELECT 
										*
									FROM 
									category
									
									ORDER BY 
										id DESC");

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
										   <th>الكود</th>
										  <th>  الاصناف الرئيسيه  </th>
										  <th>الكميه </th>
										  <th>التحكم </th>
											  
										   </tr>
										   </thead>

										   <tbody>
										   <?php

										   foreach ($items as $item) {
											   echo "<tr id=".$item['id'].">";
											   echo "<td>" . $item['id'] . "</td>";
											   echo "<td>" . $item['name'] . "</td>";
											   echo "<td>" . $item['quantinty'] . "</td>";
											   echo "<td>
											   <a href='categories.php?do=Edit&comid=" . $item['id'] . "' class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
											   <a href='categories.php?do=Delete&comid=" . $item['id'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف  </a>";
											 
										   echo "</td>";
											   echo "</tr>";
										   } ?>
										   </tbody>
										  
									   </table>
								   </div>
								  
											   <a  href="categories.php?do=Add" class="btn btn-primary">أضافه صنف رئيسى  جديد  <i class="fa fa-plus"></i></a>
								
							   </div>
						   </div>
					   </div>
	

			<?php } else {

				echo '<div class="container">';
					echo '<div class="nice-message">لا يوجد اى  صنف  حاليه </div>';
				echo '</div>';

			} ?>

		<?php 

		} elseif ($do == 'Add') { // Add Page ?>

<div class="col-sm-9">
				 <div class="card">
					 <div class="card-body">
					  <div class="card-header"><div class="card-title text-center">أضافه   بيانات  صنف رئيسى  جديد  </div></div>
				  <div class="container ">
					<form class="form-horizontal" action="?do=Insert" method="POST">
						<input type="hidden" name="comid" value="<?php echo $comid ?>" />
						<!-- Start Comment Field -->
						<div class="form-group form-group-lg  text-right">
							<label class="col-sm-2 control-label">اسم الصنف  </label>
							<div class="col-sm-10 col-md-12">
								<input class="form-control  text-right" placeholder="لابد ان يكون  البلده حرفين على  الاقل  " name="name">
							</div>
						</div>
						<div class="form-group form-group-lg  text-right">
							<label class="col-sm-2 control-label"> الكميه  </label>
							<div class="col-sm-10 col-md-12">
								<input class="form-control  text-right" placeholder="لابد ان يكون  البلده حرفين على  الاقل  " name="quantity">
							</div>
						</div>
						

						<!-- End Comment Field -->
						<!-- Start Submit Field -->
						<div class=" card-footer form-group form-group-lg">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="أدراج الصنف  الرئيسى      " class="btn btn-primary" />
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
		
				$name	  = $_POST['name'];
				$quantity = $_POST['quantity'];
		
		

		
				// Validate The Form
		
				$formErrors = array();
		
				if (strlen($name) < 2) {
					$formErrors[] = 'لابد ان يحتوى  على  حرفين على  الاقل </strong>';
				}
		
		
		

				// Loop Into Errors Array And Echo It
		
				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}
		
				// Check If There's No Error Proceed The Update Operation
		
				if (empty($formErrors)) {
		
					// Check If User Exist in Database
		
					$check = checkItem("name", "category", $name);
		
					if ($check == 1) {
		
						$theMsg = '<div class="alert alert-danger">هذه الصنف موجوده بالفعل </div>';
		
						redirectHome($theMsg, 'back');
		
					} else {
		
						// Insert Userinfo In Database
		
						$stmt = $con->prepare("INSERT INTO 
															category(name, quantinty )
														VALUES(:zname, :zquant )");
						$stmt->execute(array(
		
							'zname' => $name,
							'zquant' => $quantity
					
					
		
						));
		
						// Echo Success Message
		
						$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . 'تم  أضافه الصنف بنجاح </div>';
		
						redirectHome($theMsg, 'back');
		
					}
		
				}
		
			} else {
		
				echo "<div class='container'>";
		
				$theMsg = '<div class="alert alert-danger">لا يمكن  تصفح هذه الصفحه بصوره مباشره </div>';
		
				redirectHome($theMsg);
		
				echo "</div>";
		
			}
		
			echo "</div>";
		
		} elseif ($do == 'Edit') {

			// Check If Get Request comid Is Numeric & Get Its Integer Value

			$comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM category  WHERE id = ?");

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
					  <div class="card-header"><div class="card-title text-center">تعديل  بيانات  الاصناف   </div></div>
				  <div class="container ">
					<form class="form-horizontal" action="?do=Update" method="POST">
						<input type="hidden" name="comid" value="<?php echo $comid ?>" />
						<!-- Start Comment Field -->
						<div class="form-group form-group-lg  text-right">
							<label class="col-sm-2 control-label">اسم الصنف  </label>
							<div class="col-sm-10 col-md-12">
								<input class="form-control  text-right" value="<?php  echo $row['name'] ?>" name="name">
							</div>
						</div>
						<div class="form-group form-group-lg text-right">
							<label class="col-sm-2 control-label ">   الكميه   </label>
							<div class="col-sm-10 col-md-12">
								<input class="form-control text-right" value="<?php  echo $row['quantinty'] ?>" name="quantinty">
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

				$theMsg = '<div class="alert alert-danger">لا يوجد  اى  مدينه  حاليه </div>';

				redirectHome($theMsg);

				echo "</div>";

			}

		} elseif ($do == 'Update') { 

			echo "<div class='container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form

				$comid 		= $_POST['comid'];
				$name       = $_POST['name'];
				$quantinty        = $_POST['quantinty'];
             
		

				// Update The Database With This Info

				$stmt = $con->prepare("UPDATE category SET name = ? ,  quantinty = ?  WHERE id = ?");

				$stmt->execute(array($name , $quantinty , $comid));

				// Echo Success Message

				$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . 'تم  تعديل   بيانات  الصنف    بنجاح </div>';

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

				$check = checkItem('id', 'category', $comid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM category WHERE id = :zid");

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