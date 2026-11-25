<?php
session_start();
ob_start();
include("conn/conn.php");

if (isset($_POST['login'])) {
    $username = trim($_POST['name'] ?? '');
    $password = $_POST['pass'] ?? '';

    if ($username === "" || $password === "") {
        header("location:loginFORM.php");
        exit;
    }

    $sql = $conn->prepare("SELECT id, name, pass FROM register WHERE name = ? LIMIT 1");
    $sql->execute([$username]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    if ($result && (password_verify($password, $result['pass']) || hash_equals((string)$result['pass'], (string)$password))) {
        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $result['name'];
        header("location:index.php");
        exit;
    } else {
        echo "<script>alert('Invalid username or password.');window.location='loginFORM.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Voter Login | Online Voting System</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/an.css">
</head>
<body style="background-image: url('Back.png'); background-size: 100% 100%; height: auto; width: 100%; display: inline-block;">
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
<div>
<div style="float: right; padding-right: 180px;">
<h3 style="font-size: 40px; margin-top: 110px;"><b>LOGIN</b></h3>

<form method="post" enctype="multipart/form-data">
    <input type="text" required name="name" placeholder="Username"><br><br>
    <input type="password" required name="pass" placeholder="Password"><br><br>
    <button style="padding: 5px; margin: 10px; border-radius: 5px; width: 120px" type="submit" name="login" value="submit">Submit</button>
</form>
</div>
</div>
</center>

<h3 style="padding: 60px; padding-top: 250px; font-size: 40px;"><b>What is an online voting system?</b></h3>

<p style="padding: 60px; padding-top: 1px; margin-bottom: 150px; font-size: 30px;">An online voting system is a software platform that allows<br> groups to securely conduct votes and elections. High-quality<br> online voting systems balance ballot security, accessibility,<br> and the overall requirements of an organization's voting event.</p>

<script src="js/jquery-slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
