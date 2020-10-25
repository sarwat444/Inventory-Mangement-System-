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
								  <div class="card-header"><div class="card-title text-center"> أضافه بيانات  الاصناف  المدرجه  تحت امر  التوريد       </div></div>
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
								  <label class="col-sm-2 control-label ">   الشركه المصنعه   </label>
								  <div class="col-sm-10 col-md-12">
									  <input class="form-control text-right" name="company_name">
								  </div>
							  </div>
							  <div class="form-group form-group-lg text-right">
								  <label class="col-sm-2 control-label ">   رقم الموديل   </label>
								  <div class="col-sm-10 col-md-12">
									  <input class="form-control text-right" name="model_no">
								  </div>
							  </div>
							  <div class="form-group form-group-lg text-right">
								  <label class="col-sm-2 control-label ">   سعر الوحده   </label>
								  <div class="col-sm-10 col-md-12">
									  <input class="form-control text-right" name="unit_price">
								  </div>
							  </div>
							  
							  <div class="form-group form-group-lg text-right">
								  <label class="col-sm-2 control-label ">    الكميه   </label>
								  <div class="col-sm-10 col-md-12">
									  <input class="form-control text-right" name="quantity">
								  </div>
							  </div>
							  <div class="form-group form-group-lg text-right">
								  <label class="col-sm-2 control-label"> بلد الصنع  </label>
								  <div class="col-sm-10 col-md-12">
									  <input class="form-control text-right" name="country">
								  </div>
							  </div>
							  <div class="form-group form-group-lg text-right">
								  <label class="col-sm-2 control-label">نوع  الصنف   </label>
								  <div class="col-sm-10 col-md-12">
									  <select name="category" class="form-control text-right">
										  <?php
											  $allgovernorate = getAllFrom("*", "category", "", "", "id");
											  foreach ($allgovernorate as $governorate) {
												  echo "<option value='" . $governorate['id'] . "'"; 
											  
												  echo ">" . $governorate['name'] . "</option>";
											  }
										  ?>
									  </select>
								  </div>
							  </div>
							  <!-- End Comment Field -->
							  <!-- Start Submit Field -->
							  <div class=" card-footer form-group form-group-lg">
								  <div class="col-sm-offset-2 col-sm-10">
									  <input type="submit" value=" ادراج الصنف    " class="btn btn-primary" />
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
							$tawred_id            =    $_POST['comid'];		
			              	$name	= $_POST['name'];
				           $company_name	= $_POST['company_name'];
			            	$unit_price 	    =     $_POST['unit_price'];
			         	 $model_no	= $_POST['model_no'];
			          	$quantity 	=   $_POST['quantity'];
			           	$country 	= $_POST['country'];
			          	$category 	= $_POST['category'];

							$total              =     $quantity * $unit_price; 
							//$available_items =  total('quantinty', 'items' , 'id' , $unit_id );

						/*	if($available_items < $quantity ) {

								$formErrors[] = 'عفوا  لايوجد  بالمخزن هذا الكم  من الصنف  المطلوب '; 
								
							}
						*/
							// Validate The Form
					
						
			
							// Loop Into Errors Array And Echo It
					
							foreach($formErrors as $error) {
								echo '<div class="alert alert-danger">' . $error . '</div>';
							}
					
							// Check If There's No Error Proceed The Update Operation
					
							if (empty($formErrors)) {
					
								// Check If User Exist in Database
					
							
					
									// Insert Userinfo In Database
									$check = checkItem("name", "items", $name);
									
								 if ($check == 1) {

									$stmt2 = $con->prepare("UPDATE 
																tawred 
															SET 
																total = ?
															WHERE 
																id = ?");

									$stmt2->execute(array($total + total('total', 'tawred' , 'id' , $tawred_id ) ,$tawred_id ));


								$stmt3 = $con->prepare("UPDATE 
									items 
								SET 
								quantinty = ?
								WHERE 
									name  = ?");

								$stmt3->execute(array(total('quantinty', 'items' , 'name' , $name) + $quantity , $name));

								$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt3->rowCount() . 'تم  أضافه امر  الصرف بنجاح </div>';

								redirectHome($theMsg, 'back');


								 }else{

									$stmt = $con->prepare("INSERT INTO 
															items(name , model_no , company_name, made_in , quantinty ,cat_id , tawred_id)
														VALUES(:zname,:zmod ,  :zcom, :zmad, :zquan , :zcat  ,:ztawred)");
						$stmt->execute(array(

						
							'zname' => $name,
							'zcom' =>  $company_name,
							'zmad' =>  $country,
							'zquan' => $quantity ,
							'zcat' =>  $category ,
							'zmod' =>  $model_no ,
							'ztawred'=>$tawred_id

		
						));
									$stmt2 = $con->prepare("UPDATE 
																	tawred 
																SET 
																	total = ?
																WHERE 
																	id = ?");

                                    $stmt2->execute(array($total + total('total', 'tawred' , 'id' , $tawred_id ) ,$tawred_id ));
								
								
								$stmt3 = $con->prepare("UPDATE 
									items 
								SET 
								quantinty = ?
								WHERE 
									name  = ?");

	                         $stmt3->execute(array(total('quantinty', 'items' , 'name' , $name) + $quantity , $name));
					
							$theMsg = "<div class='alert alert-success col-md-5'>" . $stmt->rowCount() . 'تم  أضافه امر  الصرف بنجاح </div>';
					
							redirectHome($theMsg, 'back');
					
								}
					
							
					
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