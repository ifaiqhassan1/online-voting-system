<?php
session_start();
ob_start();
include("conn/conn.php");

if (isset($_POST['submit'])) {
    $uname = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';
    $imgName = "";

    if ($uname === "" || $email === "" || $pass === "") {
        echo "<script>alert('Please fill in all required fields.');window.location='registerationform.php';</script>";
        exit;
    }

    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $folder = "usersimg/";
        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }
        $ext = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext, $allowed, true)) {
            $safeName = uniqid('user_', true) . '.' . $ext;
            if (move_uploaded_file($_FILES['img']['tmp_name'], $folder . $safeName)) {
                $imgName = $safeName;
            }
        }
    }

    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = $conn->prepare("INSERT INTO register (name, email, pass, img) VALUES (?, ?, ?, ?)");
    $sql->execute([$uname, $email, $hashedPass, $imgName]);

    echo "<script>alert('Registration successful! Please sign in.');window.location='loginFORM.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Voter Registration | Online Voting System</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/an.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <a class="navbar-brand" href="Front-end-OES.php"><img src="voting.png" style="height: 135px; width: 175px; float: left;" alt="Online Voting System"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav mr-auto" style="float: right; margin-left: 200px;">
          <li class="nav-item active" style="padding: 50px;">
            <a class="nav-link" href="Front-end-OES.php"><b><i>HOME</i></b></a>
          </li>
          <li class="nav-item active" style="padding: 50px;">
            <a class="nav-link" href="info.php"><b><i>INFO</i></b></a>
          </li>
          <li class="nav-item active" style="padding: 50px;">
            <a class="nav-link" href="Contact.php"><b><i>CONTACT</i></b></a>
          </li>
          <li class="nav-item active" style="padding: 50px;">
            <a class="nav-link" href="loginFORM.php"><b><i>SIGN IN</i></b></a>
          </li>
          <li class="nav-item active" style="padding: 50px;">
            <a class="nav-link" href="registerationform.php"><b><i>SIGN UP</i></b></a>
          </li>
        </ul>
      </div>
    </nav>

<center>
<div style="float: right; padding-right: 180px;">
    <h3 style="font-size: 50px; margin-top: 110px;"><b>REGISTRATION</b></h3>

    <form class="form" method="post" enctype="multipart/form-data">
        <input type="text" class="login-input" required name="username" placeholder="Username"><br><br>
        <input type="email" class="login-input" name="email" required placeholder="Email Address"><br><br>
        <input type="password" class="login-input" required name="password" placeholder="Password"><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" class="login-input" name="img" accept="image/*"><br><br>
        <input type="submit" name="submit" value="Submit" class="login-button"><br><br>
    </form>
</div>
</center>

<div>
<h3 style="padding: 60px; padding-top: 250px; font-size: 40px;"><b>Purpose of an online voting system?</b></h3>

<p style="padding: 60px; padding-top: 1px; margin-bottom: 150px; font-size: 30px;">Online voting tools and online election voting systems<br> help you make important decisions by gathering the input of<br> your group in a way that’s systematic and verifiable. Oftentimes,<br> these decisions are made on a yearly basis - during an event (e.g. your organization’s AGM)<br> or at a particular time of the year. Or you might run ongoing polls amongst your group (e.g. anonymous employee feedback surveys).<br><br>It’s a good idea to use an online voting system to:</p>
</div>

<script src="js/jquery-slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
