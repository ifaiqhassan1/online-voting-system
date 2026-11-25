<?php
session_start();
ob_start();
if (!isset($_SESSION['id'])) {
    header("location:loginFORM.php");
    exit;
}

include("conn/conn.php");
$statusMessage = "";
$statusType = "success";

if (isset($_POST['submit'])) {
    $name = trim($_POST['name'] ?? '');
    $cnic = trim($_POST['cnic'] ?? '');
    $add  = trim($_POST['add'] ?? '');
    $area = trim($_POST['area'] ?? '');
    $rdio = trim($_POST['rdio'] ?? '');
    $prty = trim($_POST['party'] ?? '');

    if ($name === "" || $cnic === "" || $add === "" || $area === "" || $rdio === "" || $prty === "") {
        $statusMessage = "Please fill in all fields before submitting your vote.";
        $statusType = "danger";
    } else {
        $check = $conn->prepare("SELECT id FROM voter WHERE cnic = ? LIMIT 1");
        $check->execute([$cnic]);
        if ($check->fetch()) {
            $statusMessage = "A vote has already been recorded for this CNIC.";
            $statusType = "warning";
        } else {
            $sql = $conn->prepare("INSERT INTO voter (name, cnic, address, area, rdio, party) VALUES (?, ?, ?, ?, ?, ?)");
            $sql->execute([$name, $cnic, $add, $area, $rdio, $prty]);
            $statusMessage = "Your vote has been recorded successfully!";
            $statusType = "success";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cast Vote | Voting System Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Online Voting System Ballot Form" name="description">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
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
                    <?php if ($statusMessage !== ""): ?>
                        <div class="alert alert-<?php echo htmlspecialchars($statusType, ENT_QUOTES, 'UTF-8'); ?>" role="alert">
                            <?php echo htmlspecialchars($statusMessage, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    <?php endif; ?>

                    <form class="row g-3 needs-validation" method="post" enctype="multipart/form-data" novalidate>
                        <div class="col-md-12">
                            <label for="voterName" class="form-label">Voter Name</label>
                            <input type="text" name="name" class="form-control" id="voterName" placeholder="Name" required>
                        </div>
                        <div class="col-md-12">
                            <label for="voterCnic" class="form-label">CNIC</label>
                            <input type="text" name="cnic" class="form-control" id="voterCnic" placeholder="33100-1234567-1" required>
                        </div>
                        <div class="col-md-12">
                            <label for="voterAddress" class="form-label">Address</label>
                            <input type="text" name="add" class="form-control" id="voterAddress" placeholder="Address" required>
                        </div>
                        <div class="col-md-12">
                            <label for="voterArea" class="form-label">Area</label>
                            <select name="area" class="form-select" id="voterArea" required>
                                <option value="">Select Area</option>
                                <option value="Faisalabad">Faisalabad</option>
                                <option value="Lahore">Lahore</option>
                                <option value="Sheikhupura">Sheikhupura</option>
                            </select><br>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label d-block">Gender</label>
                            <input type="radio" value="male" name="rdio" id="genderMale" required> <label for="genderMale" class="me-3">Male</label>
                            <input type="radio" value="female" name="rdio" id="genderFemale" required> <label for="genderFemale">Female</label>
                        </div>

                        <div class="col-md-12">
                            <label for="Choose" class="form-label">Choose Party</label>
                            <select name="party" class="form-select" id="Choose" required>
                                <option value="">Select Party</option>
                                <option value="PMNL">PMNL</option>
                                <option value="PTI">PTI</option>
                                <option value="PPP">PPP</option>
                                <option value="TLP">TLP</option>
                            </select><br>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit Vote</button>
                        </div>
                    </form>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <script>document.write(new Date().getFullYear())</script> Voting System <span class="d-none d-sm-inline-block"><i class="mdi mdi-heart text-danger"></i> Created by Faiq and Abdullah</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="assets/js/pages/form-validation.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
