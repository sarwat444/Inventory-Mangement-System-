<?php

	ob_start(); 

	session_start();

	$pageTitle = 'اضافه الاصناف ';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		$comid =isset($_GET['comid']) ? $_GET['comid'] : 1;
		// Start Manage Page
	  if ($do =='additems') { // Add Page ?>
			
			<div class="col-sm-9">
							 <div class="card">
								 <div class="card-body">
								  <div class="card-header"><div class="card-title text-center"> أضافه بيانات  الاصناف  المدرجه  تحت امر  الصرف      </div></div>
							  <div class="container ">
								<form class="form-horizontal" action="?do=Insert" method="POST">
									<input type="hidden" name="comid" value="<?php echo $comid ?>" />
									<!-- Start Comment Field -->
									<div class="form-group form-group-lg text-right">
									<label class="col-sm-2 control-label">أسم الصنف   </label>
									<div class="col-sm-10 col-md-12">
										<select name="unite_name" class="form-control text-right">
											<?php
												$allgovernorate = getAllFrom("*", "items", "", "", "id");
												foreach ($allgovernorate as $governorate) {
													echo "<option value='" . $governorate['id'] . "'"; 
												
													echo ">" . $governorate['name'] . "</option>";
												}
											?>
										</select>
									</div>
								</div>
									<div class="form-group form-group-lg text-right">
										<label class="col-sm-2 control-label ">   الكميه       </label>
										<div class="col-sm-10 col-md-12">
											<input type="number" class="form-control text-right"  name="quantity">
										</div>
									</div>
									<div class="form-group form-group-lg text-right">
										<label class="col-sm-2 control-label">    سعر الوحده     </label>
										<div class="col-sm-10 col-md-12">
											<input type="number" class="form-control text-right"  name="unit_price">
										</div>
									</div>
								
									<!-- End Comment Field -->
									<!-- Start Submit Field -->
									<div class=" card-footer form-group form-group-lg">
										<div class="col-sm-offset-2 col-sm-10">
											<input type="submit" value="أدراج  الأصناف     " class="btn btn-primary" />
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
							$formErrors = array();
							
							
							$sarf_id            = $_POST['comid'];
							$unit_id	        =     $_POST['unite_name'];
							$quantity 	        =     $_POST['quantity'];
							$unit_price 	    =     $_POST['unit_price'];
							$total              =     $quantity * $unit_price; 
							$available_items =  total('quantinty', 'items' , 'id' , $unit_id );

							if($available_items < $quantity ) {

								$formErrors[] = 'عفوا  لايوجد  بالمخزن هذا الكم  من الصنف  المطلوب '; 
								
							}
						
							// Validate The Form
					
						
			
							// Loop Into Errors Array And Echo It
					
							foreach($formErrors as $error) {
								echo '<div class="alert alert-danger">' . $error . '</div>';
							}
					
							// Check If There's No Error Proceed The Update Operation
					
							if (empty($formErrors)) {
					
								// Check If User Exist in Database
					
							
					
									// Insert Userinfo In Database
					
									$stmt = $con->prepare("INSERT INTO 
																		sarf_items(sarf_id, unit_id, price,quantity )
																	VALUES(:zsarfid, :zunitid, :zpriceid ,:zquant )");
									$stmt->execute(array(
							
										'zsarfid' => $sarf_id ,
										'zunitid' => $unit_id,
										'zpriceid' => $unit_price,
										'zquant'  => $quantity
								
					
									));

									$stmt2 = $con->prepare("UPDATE 
																	sarf 
																SET 
																	total = ?
																WHERE 
																	id = ?");

                                    $stmt2->execute(array($total + total('total', 'sarf' , 'id' , $sarf_id ) , $sarf_id));
								
								
								$stmt3 = $con->prepare("UPDATE 
									items 
								SET 
								quantinty = ?
								WHERE 
									id = ?");

	                         $stmt3->execute(array(total('quantinty', 'items' , 'id' , $unit_id ) - $quantity , $unit_id));
					
							$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . 'تم  أضافه امر  الصرف بنجاح </div>';
					
							redirectHome($theMsg, 'back');
					
								}
					
							
					
						}
					
						echo "</div>";
					
					}
		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}

	ob_end_flush(); // Release The Output

?>