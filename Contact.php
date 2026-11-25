<?php
session_start();
ob_start();
include("conn/conn.php");

if (isset($_POST['submit'])) {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $sub   = trim($_POST['subject'] ?? '');
    $msg   = trim($_POST['msg'] ?? '');

    if ($name !== "" && $email !== "" && $sub !== "" && $msg !== "") {
        $sql = $conn->prepare("INSERT INTO contact (name, email, sub, msg) VALUES (?, ?, ?, ?)");
        $sql->execute([$name, $email, $sub, $msg]);
        echo "<script>alert('Thank you! Your message has been sent.');window.location='Contact.php';</script>";
        exit;
    } else {
        echo "<script>alert('Please fill in all fields.');window.location='Contact.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contact Us | Online Voting System</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/an.css">
<style>
.main {
    background-image: url(lp.jpg);
}
.head {
    font-size: 90px;
    margin-left: 500px;
    padding-top: 5px;
    font-family: cursive;
}
.border {
    border: 4px solid black;
    height: 620px;
    width: 30%;
    margin-left: 250px;
    margin-top: 25px;
    float: left;
    border-radius: 50px;
}
.box {
    margin-left: 40px;
    padding-top: 10px;
    float: left;
    margin-top: 15px;
    font-size: 25px;
}
.btn {
    border-radius: 5px;
}
.nav {
    height: 230px;
}
.line {
    font-size: 30px;
    margin-left: 500px;
}
.box2 {
    float: right;
    border: 4px solid black;
    width: 30%;
    padding-bottom: 76px;
    margin-top: 25px;
    margin-right: 50px;
    padding-left: 50px;
    border-radius: 50px;
}
.mail {
    color: black;
}
.text {
    font-size: 20px;
    color: black;
}
.Describe {
    font-size: 20px;
}
</style>
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

    <h1 class="head">CONTACT US</h1>
    <p class="line">Questions? Comments? Send us a message!</p>

    <div class="border">
        <form class="box" method="post" enctype="multipart/form-data">
            <label for="contactName" class="AM">Name:</label><br>
            <input type="text" class="form-control" id="contactName" placeholder="Enter Name" name="name" size="40" required><br>

            <label for="contactEmail" class="AM">Email:</label><br>
            <input type="email" class="form-control" id="contactEmail" placeholder="Enter Email" name="email" size="40" required><br>

            <label for="contactSubject" class="AM">Subject:</label><br>
            <input type="text" class="form-control" id="contactSubject" placeholder="Enter Subject" name="subject" size="40" required><br>

            <label for="contactMsg" class="AM">Send a message:</label><br>
            <input type="text" class="form-control" id="contactMsg" placeholder="Send a message" name="msg" size="40" required><br><br>

            <button type="submit" name="submit" value="submit">Submit</button>
        </form>
    </div>

    <div class="box2">
        <h1>Contact us</h1>
        <div class="mail">
            <div class="Describe">
                <p><b>We are available Monday - Friday, 9am to 4pm CST. Average response time during business hours is 8 minutes.</b></p>
            </div>
            <h3>Email:</h3>
            <div class="text">
                <h3>i.faiqhassan1@gmail.com</h3>
            </div>
        </div>
    </div>

    <script src="js/jquery-slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
