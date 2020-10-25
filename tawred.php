<?php

	ob_start();

	session_start();

	$pageTitle = ' أوامر التوريد';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page

		if ($do == 'Manage') { // Manage Members Page

			// Select All Users Except Admin

					$stmt = $con->prepare("SELECT
												supplayorders.*,
												supplayorders.SupplySource AS subbly_source,
												supplayorders.TotalText AS total ,
												supplystats.SupplyStat AS supply_state ,
													supplayorders.supplyorder_id AS arrange

											FROM
												supplayorders
											INNER JOIN
												supplystats
											ON
												supplayorders.supplystatN = supplystats.SupplyStatN
											ORDER BY
												supplayorders.supplyorder_id DESC");


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
												  <th> رقم أمـر التوريـد </th>
										   <th>  أمـر التوريـد </th>
										  <th> جهه التوريد    </th>
										  <th>الأجمالــى     </th>
										  <th> حالـــه التوريد  </th>
										  <th>التحكم </th>
										   </tr>
										   </thead>

										   <tbody>
										   <?php

										   foreach ($items as $item) {
	   echo "<td>" . $item['arrange'] . "</td>";
											   echo "<td>" . $item['SupplyOrderN'] . "</td>";
											   echo "<td>" . $item['subbly_source'] . "</td>";
											   echo "<td>" . $item['total'] . "</td>";
											   echo "<td>" . $item['supply_state'] . "</td>";
											   echo "<td>
												 <a href='items.php?do=Edit&itemid=" . $item['SupplyOrderN'] . "' class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
										 	 	<a href='items.php?do=Delete&itemid=" . $item['SupplyOrderN'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>
											    <a href='tawred_items.php?do=additems&comid=' class='btn btn-warning ><i class='fa fa-plus'></i>أضافه   أصناف الى امر التوريد    </a>";
										   echo "</td>";
											   echo "</tr>";
										   } ?>
										   </tbody>

									   </table>
								   </div>

											   <a  href="tawred.php?do=Add" class="btn btn-primary">أضافه  امر توريد  جديد  <i class="fa fa-plus"></i></a>


							   </div>
						   </div>
					   </div>


			<?php } else {

				echo '<div class="container">';
					echo '<div class="nice-message">لا يوجد اى  توريد   حالى  </div>';
				echo '</div>';

			} ?>

		<?php

		} elseif ($do == 'Add') { // Add Page ?>

<div class="col-sm-9">
				 <div class="card">
					 <div class="card-body">
					  <div class="card-header"><div class="card-title text-center">أضافه   بيانات  توريد جديد  </div></div>
				  <div class="container ">
					<form class="form-horizontal" action="?do=Insert" method="POST">
						<input type="hidden" name="comid" value="<?php echo $comid ?>" />
						<!-- Start Comment Field -->
						<div class="form-group form-group-lg  text-right">
							<label class="col-sm-2 control-label">رقم  امر  التوريد   </label>
							<div class="col-sm-10 col-md-12">
								<input type="text" class="form-control  text-right" name="amr_num">
							</div>
						</div>
						<div class="form-group form-group-lg text-right">
							<label class="col-sm-2 control-label ">   تاريخ التوريد     </label>
							<div class="col-sm-10 col-md-12">
								<input type="date" class="form-control text-right"  name="tawred_date">
							</div>
						</div>
						<div class="form-group form-group-lg  text-right">
							<label class="col-sm-2 control-label">جهه التوريد   </label>
							<div class="col-sm-10 col-md-12">
								<input type="text" class="form-control  text-right" name="unit_name">
							</div>
						</div>
						<div class="form-group form-group-lg  text-right">
							 <label class="col-sm-2 control-label">حاله   التوريد   </label>
							 <div class="col-sm-10 col-md-12">
								<select name="state" class="form-control">
									<option value="1">جاري التوريد </option>
									<option value="2">تحت الفحص </option>
									<option value="3">تم الاستلام </option>
								</select>
							 </div>
						 </div>
						<!-- End Comment Field -->
						<!-- Start Submit Field -->
						<div class=" card-footer form-group form-group-lg">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="أدراج امر التوريد    " class="btn btn-primary" />
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




				$amr_num	        =     $_POST['amr_num'];
			 	$tawred_date 	    =     $_POST['tawred_date'];
					$unit_name          =     $_POST['unit_name'];
						$state	      =     $_POST['state'];



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


						$stmt = $con->prepare("INSERT INTO
															supplayorders(SupplyOrderN, SupplySource ,supplystatN )
														VALUES(:znum, :zsource , :zsupply)");
						$stmt->execute(array(

							'znum' =>  $amr_num,
							'zsource' => $unit_name ,
						 'zsupply' =>	$state



						));

						// Echo Success Message

						$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . 'تم  أضافه امر  التوريد بنجاح </div>';

						redirectHome($theMsg, 'back');

					}



			}

			echo "</div>";

		} elseif ($do == 'Edit') {

			// Check If Get Request comid Is Numeric & Get Its Integer Value

			$comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM tawred  WHERE id = ?");

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
					  <div class="card-header"><div class="card-title text-center">تعديل  بيانات  التوريد  </div></div>
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
							<label class="col-sm-2 control-label ">  تاريخ التوريد    </label>
							<div class="col-sm-10 col-md-12">
								<input class="form-control text-right" value="<?php  echo $row['tawred_date'] ?>" name="tawred_date">
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

				$theMsg = '<div class="alert alert-danger">لا يوجد  اى توريد    حالى  </div>';

				redirectHome($theMsg);

				echo "</div>";

			}

		} elseif ($do == 'Update') {

			echo "<div class='container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form

				$comid 		        =     $_POST['comid'];
				$unite_name         =     $_POST['unite_name'];
				$tawred_date        =     $_POST['tawred_date'];


				// Update The Database With This Info

				$stmt = $con->prepare("UPDATE tawred SET unite_name = ? ,tawred_date = ?  WHERE id = ?");

				$stmt->execute(array($unite_name , $tawred_date , $comid));

				// Echo Success Message

				$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . 'تم  تعديل   بيانات  التوريد   بنجاح </div>';

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

				$check = checkItem('id', 'tawred', $comid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM tawred WHERE id = :zid");

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
