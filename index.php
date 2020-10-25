
<?php
session_start();
$noNavbar = '';
$pageTitle = 'Login';

if (isset($_SESSION['Username'])) {
    header('Location: items.php'); // Redirect To Dashboard Page
}

include 'init.php';

// Check If User Coming From HTTP Post Request

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check If The User Exist In Database

    $stmt = $con->prepare("SELECT
									ID, UserName, Password
								FROM
									login
								WHERE
								UserName = ?
								AND
								Password = ?

								LIMIT 1");

    $stmt->execute(array($username, 	$password ));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    // If Count > 0 This Mean The Database Contain Record About This Username

    if ($count > 0) {
        $_SESSION['Username'] = $username; // Register Session Name
        $_SESSION['ID'] = $row['UserID']; // Register Session ID
        header('Location: items.php'); // Redirect To Dashboard Page
        exit();
    }

}

?>

<!-- preloader area start -->
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- preloader area end -->
<!-- login area start -->
<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="login-form-head">
                    <h4>تسجيل  الدخول </h4>

                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="exampleInputEmail1">الايميل </label>
                        <input name="username" type="text" id="exampleInputEmail1">
                        <i class="ti-email"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputPassword1">الرقم السري </label>
                        <input name="password" type="password" id="exampleInputPassword1">
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="row mb-4 rmber-area">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                <label class="custom-control-label" for="customControlAutosizing">تذكرنى </label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="#">نسيت الباسورد?</a>
                        </div>
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" name="login" type="submit">تسجيل  الدخول  <i class="ti-arrow-right"></i></button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- login area end -->


<?php include $tpl . 'footer.php'; ?>




