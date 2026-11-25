<?php
session_start();
ob_start();
include("conn/conn.php");

if (isset($_POST['login'])) {
    $username = trim($_POST['name'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === "" || $password === "") {
        header("location:adminlogin.php");
        exit;
    }

    $sql = $conn->prepare("SELECT id, username, password FROM admin_login WHERE username = ? LIMIT 1");
    $sql->execute([$username]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    if ($result && (password_verify($password, $result['password']) || hash_equals((string)$result['password'], (string)$password))) {
        $_SESSION['admin_id'] = $result['id'];
        $_SESSION['admin_username'] = $result['username'];
        header("location:table.php");
        exit;
    } else {
        echo "<script>alert('Invalid admin username or password.');window.location='adminlogin.php';</script>";
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Login | Voting System Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Online Voting System Admin Login" name="description">
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">
</head>
<body class="account-pages">
    <div class="accountbg" style="background: url('assets/images/bg.jpg'); background-size: cover; background-position: center;"></div>

    <div class="wrapper-page account-page-full">
        <div class="card shadow-none">
            <div class="card-block">
                <div class="account-box">
                    <div class="card-box shadow-none p-4">
                        <div class="p-2">
                            <div class="text-center mt-4">
                                <a href="Front-end-OES.php"><img src="img/voting.png" alt="Voting System" height="60"></a>
                            </div>

                            <h4 class="font-size-18 mt-5 text-center">Voting System Admin</h4>
                            <p class="text-muted text-center">Sign in to view election results.</p>

                            <form class="mt-4" method="post">
                                <div class="mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" name="name" class="form-control" id="username" placeholder="Enter username" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="userpassword">Password</label>
                                    <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password" required>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6 text-end">
                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit" name="login" value="login">Log In</button>
                                    </div>
                                </div>
                            </form>

                            <div class="mt-5 pt-4 text-center">
                                <p><script>document.write(new Date().getFullYear())</script> Voting System. Created with <i class="mdi mdi-heart text-danger"></i> by Faiq and Abdullah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
