<?php

	ob_start(); 

	session_start();

	$pageTitle = '  أوامر  الصرف     ';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page

		if ($do == 'Manage') { // Manage Members Page

			// Select All Users Except Admin 

		
			$stmt = $con->prepare("SELECT  TransactionOrder.TransactionOrderN, TransactionOrder.TODate, TransactionOrder.BossSignature, TransactionOrder.ManagerSignature, TransactionOrder.ReserveN, 
                         TakenUnit.UnitName, GivenReasons.ReasonName, TransactionOrder.FollowedUnitCode, TransactionOrder.IsPlanned
FROM            TransactionOrder INNER JOIN
                         TakenUnit ON TransactionOrder.UnitCode = TakenUnit.UnitCode
                          INNER JOIN
                     
                         GivenReasons ON TransactionOrder.ReasonN = GivenReasons.ReasonN
ORDER BY TransactionOrder.TODate DESC, TransactionOrder.TransactionOrderN DESC");


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
										   <th>رقم  امر الصرف</th>
										  <th> اسم الوحده    </th>
										  <th> تاريخ الصرف    </th>

										  <th>سبب الصرف </th>								  
										  <th>التحكم </th>
											  
										   </tr>
										   </thead>

										   <tbody>
										   <?php

										   foreach ($items as $item) {
											   echo "<tr id=".$item['TransactionOrderN'].">";
											   echo "<td>" . $item['TransactionOrderN'] . "</td>";
											   echo "<td>" . $item['UnitName'] . "</td>";
											   echo "<td>" . $item['TODate'] . "</td>";
											   //echo "<td>" . $item['total'] . " <i class='fa fa-money'></i></td>";
											   echo "<td>" . $item['ReasonName'] . "</td>";
										
											   echo "<td>

											   <a href='sarf.php?do=Edit&comid=" . $item['TransactionOrderN'] . "' class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
											   <a href='sarf.php?do=Delete&comid=" . $item['TransactionOrderN'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف  </a>
											   <a href='sarf_items.php?do=additems&comid=" . $item['TransactionOrderN'] . "' class='btn btn-primary'>أضافه اصناف الى  امر الصرف    <i class='fa fa-plus'></i> </a>";
										   echo "</td>";
											   echo "</tr>";
										   } ?>
										   </tbody>
										  
									   </table>
								   </div>
								  
											
											   <a  href="sarf.php?do=Add" class="btn btn-primary">  أضافه أمر صرف جديد <i class="fa fa-plus"></i></a>
								
							   </div>
						   </div>
					   </div>
	

			<?php } else {

				echo '<div class="container">';
				
					echo '<div class="nice-message">لا يوجد اى  صرف   حالى  </div>';
					?>
					<a  href="sarf.php?do=Add" class="btn btn-primary">  أضافه أمر صرف جديد <i class="fa fa-plus"></i></a>
					<?php
				echo '</div>';

			} ?>

		<?php 

		} elseif ($do == 'Add') { // Add Page ?>

<div class="col-sm-9">
				 <div class="card">
					 <div class="card-body">
					  <div class="card-header"><div class="card-title text-center">أضافه   بيانات  صرف جديد  </div></div>
				  <div class="container ">
					<form class="form-horizontal" action="?do=Insert" method="POST">

						<!-- Start Comment Field -->

                        <div class="form-group form-group-lg text-right">
                            <label class="col-sm-2 control-label ">   fdfsfd    </label>
                            <div class="col-sm-10 col-md-12">
                                <input type="number" class="form-control text-right"  name="ordernum">
                            </div>
                        </div>

                        <div class="form-group form-group-lg text-right">
                            <label class="col-sm-2 control-label ">    رقم امر الصرف     </label>
                            <div class="col-sm-10 col-md-12">
                                <input type="number" class="form-control text-right"  name="orderfrom">
                            </div>
                        </div>



                        <select  class="col-md-5" class="takenunit" name="takenunit"   id="takenunit">
                            <label class="col-sm-2 control-label ">    أسم الوحده التابع لها      </label>
                            <option value="0">...</option>
                            <?php
                            $allMembers = getAllFrom("*", "takenunit", "", "", "UnitCode");
                            foreach ($allMembers as $user) {
                                echo "<option value='" . $user['UnitCode'] . "'>" . $user['UnitName'] . "</option>";
                            }
                            ?>
                        </select>

						<div class="form-group form-group-lg text-right">
							<label class="col-sm-2 control-label ">   تاريخ الصرف     </label>
							<div class="col-sm-10 col-md-12">
								<input type="date" class="form-control text-right" placeholder="لابد ان  يحتوى   على  @example  " name="sarf_date">
							</div>
						</div>
                        <div class="form-group form-group-lg text-right">
                            <label class="col-sm-2 control-label ">ضمن المخطط </label>
                            <div class="col-sm-10 col-md-12">
                                <input type="checkbox" class="form-control" name="is_planned" value="1">
                            </div>
                        </div>

                        <select  class="col-md-5" class="category_id" name="sarf_reason"   id="sarf_reason">
                            <label class="col-sm-2 control-label ">   سبب الصرف     </label>
                            <option value="0">...</option>
                            <?php
                            $allMembers = getAllFrom("*", "givenreasons", "", "", "ReasonN");
                            foreach ($allMembers as $user) {
                                echo "<option value='" . $user['ReasonN'] . "'>" . $user['ReasonName'] . "</option>";
                            }
                            ?>
                        </select>



						<!-- End Comment Field -->
						<!-- Start Submit Field -->
						<div class=" card-footer form-group form-group-lg">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="أدراج امر الصرف    " class="btn btn-primary" />
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
                $ordernum =              $_POST['ordernum'];
                $sarf_reason 	    =     $_POST['sarf_reason'];
                $orderfrom  = $_POST['orderfrom'];
				$takenunit       =     $_POST['takenunit'];
				$sarf_date 	        =     $_POST['sarf_date'];
			     $is_planned =         $_POST['is_planned'] ;

                $formErrors = array();
		

		

				// Loop Into Errors Array And Echo It
		
				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}
		
				// Check If There's No Error Proceed The Update Operation
		
				if (empty($formErrors)) {
		
					// Check If User Exist in Database
                    $stmt = $con->prepare("INSERT INTO 
			TransactionOrder( TransactionOrderN , ReasonN,  UnitCode, OrderFromN ,TODate,  IsPlanned )
                            VALUES(:ordern ,:ReasonN , :UnitCode,:OrderFromN , :TODate  , :isplanned   )");





						$stmt->execute(array(

                            'ordern' => $ordernum,
							'ReasonN' => $sarf_reason ,
							'UnitCode' =>  $takenunit  ,
                            'OrderFromN' => $orderfrom ,
                            'TODate' =>  $sarf_date ,
                            'IsPlanned' =>  $is_planned

                        ));
		
						// Echo Success Message
		
						$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . 'تم  أضافه امر  الصرف بنجاح </div>';
		
						redirectHome($theMsg, 'back');
		
					}
		
				
		
			}
		
			echo "</div>";
		
		} elseif ($do == 'Edit') {

			// Check If Get Request comid Is Numeric & Get Its Integer Value

			$comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM sarf  WHERE id = ?");

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
					  <div class="card-header"><div class="card-title text-center">تعديل  بيانات  الصرف  </div></div>
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
							<label class="col-sm-2 control-label ">  تاريخ الصرف    </label>
							<div class="col-sm-10 col-md-12">
								<input class="form-control text-right" value="<?php  echo $row['sarf_date'] ?>" name="sarf_date">
							</div>
						</div>
						<div class="form-group form-group-lg text-right">
							<label class="col-sm-2 control-label">سبب  الصرف  </label>
							<div class="col-sm-10 col-md-12">
								<input class="form-control text-right" value="<?php  echo $row['sarf_reason'] ?>" name="sarf_reason">
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

				$theMsg = '<div class="alert alert-danger">لا يوجد  اى  صرف    حالى  </div>';

				redirectHome($theMsg);

				echo "</div>";

			}

		} elseif ($do == 'Update') { 

			echo "<div class='container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form

				$comid 		        =     $_POST['comid'];
				$unite_name         =  $_POST['unite_name'];
				$sarf_date          =     $_POST['sarf_date'];
                $sarf_reason        =     $_POST['sarf_reason'];


				// Update The Database With This Info

				$stmt = $con->prepare("UPDATE sarf SET unite_name = ? ,  sarf_date = ? ,  sarf_reason = ? WHERE id = ?");

				$stmt->execute(array($unite_name , $sarf_date , $sarf_reason , $comid));

				// Echo Success Message

				$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . 'تم  تعديل   بيانات  الصرف   بنجاح </div>';

				redirectHome($theMsg, 'back');

			} else {

				$theMsg = '<div class="alert alert-danger">ناسف  لا تستطيع الوصول  للصفحه  مباشره </div>';

				redirectHome($theMsg);

			}

			echo "</div>";

		} 
		
	
		elseif ($do == 'Delete') { // Delete Page

			echo "<div class='container'>";

				// Check If Get Request comid Is Numeric & Get The Integer Value Of It

				$comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('id', 'sarf', $comid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM sarf WHERE id = :zid");

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