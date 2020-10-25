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
								  <div class="card-header"><div class="card-title text-center">أضافه بيانات  الاصناف  المدرجه  تحت عرض  الممارسه       </div></div>
							  <div class="container ">
								<form class="form-horizontal" action="?do=Insert" method="POST">
									<input type="hidden" name="comid" value="<?php echo $comid ?>" />
									<!-- Start Comment Field -->
								
                                    <div class="form-group form-group-lg  text-right">
								  <label class="col-sm-2 control-label">اسم الصنف  </label>
								  <div class="col-sm-10 col-md-12">
									  <input class="form-control  text-right"  name="name">
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
							
							
							$momarsa_id            =    $_POST['comid'];
							$name	            =     $_POST['name'];
							$quantity 	        =     $_POST['quantity'];
							$unit_price 	    =     $_POST['unit_price'];
							$total              =     $quantity * $unit_price; 
						
						
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
																		momarsa_items(momarsa_id, unit_name, price,quantity )
																	VALUES(:zmomarsaid, :zunitname, :zpriceid ,:zquant )");
									$stmt->execute(array(
                                 
                                    
										'zmomarsaid' => $momarsa_id  ,
										'zunitname' => $name,
										'zpriceid' => $unit_price,
										'zquant'  => $quantity
								
					
									));

									$stmt2 = $con->prepare("UPDATE 
																	momarsa 
																SET 
																	total = ?
																WHERE 
																	id = ?");

                                    $stmt2->execute(array($total + total('total', 'momarsa' , 'id' , $momarsa_id) , $momarsa_id));
								
							
							$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . 'تم  أضافه عرض   الممارسه بنجاح </div>';
					
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