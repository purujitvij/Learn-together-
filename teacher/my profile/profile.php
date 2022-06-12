

<html>
<head>
  <link href="./my profile/profile.css" rel="stylesheet">
</head>
<body>
  <div class="bar">
  <p> University Institute Of Information Technology</p>
  <div class="nav">
        <a href="../teacher/main.php">Home</a>
        <a href="../teacher/main.php?reques=5112">My Profile</a>
        <a href="../teacher/main.php?reques=5113">About</a>
      </div>
    </div>
      <div class="dropdown">
      <img src="./my profile/dropArrow.png">
      <div class="drop">
        <a href="logout.php">Sign Out</a>
        <a href="../teacher/main.php?reque=4111">Contact Office</a>
      </div>
    </div>
    <div class="top">
    <img src="./my profile/profile.png">
  </div>
  <div class="name">
    <p><?php echo $_SESSION['name']; ?></p>
  </div>
  <div class="up"></div>
  <p class="about">About</p>
  <div class="data">
    <p> Phone Number</p>
    <p> Username</p>
  </div>
  <div class="data2">
    <p class="phone"><?php echo $_SESSION['phoneno']; ?></p>
    <p class="Username"><?php echo $_SESSION['user_name']; ?></p>
  </div>
  <div class="down"></div>

    </body>
    </html>
