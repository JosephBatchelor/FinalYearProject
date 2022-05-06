<?php
    session_start();
    include_once 'includes/dbh.inc.php';//Creates a conneciton to the databse
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Online Banking Service</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="Indexstylesheet.css" rel="stylesheet">
<script src="javascript/index.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


  </head>

  <body>
    <div class="container">


<div class="banner">
</div>


<div class="accountarea">
  <!-- Logging & out area -->
  <?php
// Checks to see if user is already signed-in by usings its sesssion ID to check its value.   
    if (isset($_SESSION['userId'])) {
      $id = $_SESSION['userId'];
      $username = '';
      $firstname = '';
      $lastname = '';
// Retrieves users fname, sname and username using the session ID. 
      $sql = "SELECT * FROM users WHERE idUsers= $id;";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
//Checks if session ID exists.
      if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $username = $row['uidUsers'];
          $firstname = $row['firstname'];
            $lastname = $row['lastname'];
        }
      }
//Chagnges HTML to provide a sign-out button and displays their profile picture in the corner.
//A drop down button is provide to allow the user to access their account.
      echo ' 
      <div class ="profileContainer">
      <form action="includes/logout.inc.php" method="post">
      <div class="action" action="includes/logout.inc.php" method="post">
        <div class="Profile" onclick="menuToggle();">
          <img src="photos\defaultUserphoto.png">
        </div>
        <div class="menu">
          <h3>'.$firstname." ".$lastname.'</h3>
          <h4>'.$username.'<h4/>
          <div class ="buttlist">
            <li> <a href="account.php"> Account</a></li>
            <li> <a href="profile.php">profile</a></li>
            <li> <a href="">Analytics</a></li>
            <li> <a href="">Savings</a></li>
            <li> <button class = "logoutbut" type="submit" name="logout-submit">Logout</button> </li>
          </div>
        </div>
      </div>
      </form>
      </div>
        ';
    }else {
      echo '
      <div class ="signin1">
          <form  class = "signinform" action="includes/login.inc.php" method="post">
              <input class = "signinput-user" type="text" name="mailuid" placeholder="Username">
              <input class = "signinput-password" type="password" name="pwd" placeholder="Password">
              <button class = "signinbutt" type="submit" name="login-submit">Login</button>
              <a class = "signupbutt" href="signup.php">SignUp</a>
            </form>
            </div>
            
            <div class ="ddcontainer">
                    <div class="dd">
                  <button onclick="myFunction()" class="dbtn"><ion-icon name="menu-outline"></ion-icon></button>
                  <div id="myDropdown" class="ddcontent">
                    <form  class = "signinform" action="includes/login.inc.php" method="post">
                      <input class = "signinput-user2" type="text" name="mailuid" placeholder="Username">
                      <input class = "signinput-password2" type="password" name="pwd" placeholder="Password">
                      <button class = "signinbutt2" type="submit" name="login-submit">Login</button>
                     <p class = "signuptext">Not a memeber ?, </p> <a class = "signupbutt2" href="signup.php">SignUp.</a>
                    </form>
                  </div>
                </div>
                </div>
                
                <script>
                /* When the user clicks on the button, 
                toggle between hiding and showing the dropdown content */
                function myFunction() {
                  document.getElementById("myDropdown").classList.toggle("show");
                }
                
                // Close the dropdown if the user clicks outside of it
                window.onclick = function(event) {
                  if (!event.target.matches(".dropbtn")) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                      var openDropdown = dropdowns[i];
                      if (openDropdown.classList.contains("show")) {
                        openDropdown.classList.remove("show");
                      }
                    }
                  }
                }
                </script>
            
            ';
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "nouser") {
            echo '<p class = "signuperror">Invalid Crednetials</p>';
          }
        }

    }
   ?>


  </div>
  <!--   <a class="navlinks" href="account.php"> My Account</a> -->
<div class="indexnav">
  <div class="navbar">
      <a class="navlinks" href="index.php">Home</a>
      <a class="navlinks" href=""> News</a>
      <a class="navlinks" href=""> About</a>
      <a class="navlinks" href=""> Contact</a>
      <a class="navlinks" href="help.php"> Help</a>
  </div>

</div>


<div class="content">

    <p class="slogan">Banking made easy</p>
    <p class="sloganUndertext">Spend, save and manage your money, all in one place. Open a full UK bank account from your phone, for free.</p>
  <div class="parallax"></div>
          <!--<img class="parallax" src="photos/image 7.jpg">-->




<div class="info2">
  <p class = "info2text">Join in with 5 million others</p>
  <img class="certification" src="photos/certi.png" alt="certification">
</div>

<div class="info1">

</div>

<div class="info3">

</div>

<div class="info4">

</div>




</div>

<div class="footer">
<p>footer</p>
</div>

</div>

  </body>
</html>
