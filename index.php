<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:loginFORM.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Voting System Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Online Voting System Voter Dashboard" name="description">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/libs/chartist/chartist.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">
</head>
<body data-sidebar="dark">
    <div id="layout-wrapper">
        <?php include("include/sidebar.php"); ?>

        <header>
            <div>
                <a href="Front-end-OES.php"><img src="img/voting.png" alt="Voting System" height="70" width="200"></a>
            </div>
        </header>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <h4 class="page-title">Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Voter', ENT_QUOTES, 'UTF-8'); ?></h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Voter Actions</h4>
                                    <p class="card-title-desc">Use the sidebar or the buttons below to cast your vote or sign out.</p>
                                    <a href="voter.php" class="btn btn-primary me-2">Cast Your Vote</a>
                                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                                </div>
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
    <script src="assets/libs/peity/jquery.peity.min.js"></script>
    <script src="assets/libs/chartist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/js/pages/dashboard.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
