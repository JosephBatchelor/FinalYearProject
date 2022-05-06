<?php
use PHPUnit\Framework\TestCase;
include_once 'includes/dbh.inc.php';
class phpTest extends TestCase{

public function testDatabseConnection(){
    $servername = "localhost:3306";
    $dbUsername = "jb1828_root";
    $dbPassword = "A1B2C3a1b2c3";
    $dbName = "jb1828_loginsystem";
    $conn = mysqli_connect($servername ,$dbUsername, $dbPassword, $dbName);
    $boo = true;
    if (!$conn) {
        $boo = false;
    }
    $this->assertEquals(true, $boo);
}

public function testDatabseQuery(){
    $boo = true;    $sql = "SELECT * FROM personalinformation";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $this->assertGreaterThan(0, $resultCheck); 
}

public function testSignUpVerification(){
    $username = "JohnDoue";
    $email = "JohnDoe@Gmial.com";
    $password = "pasword123";
    $paswordRepeat = "pasword123";
    $bool = true;

    if (empty($username) || empty($email) ||  empty($password)|| empty($paswordRepeat)) {
        $bool = false;
    }else if (!filter_var($email.FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $bool = false;
    }else if(!filter_var($email.FILTER_VALIDATE_EMAIL)){
        $bool = false;
    }else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $bool = false;
    }else if ($password !== $paswordRepeat) {
        $bool = false;
    }
    $this->assertEquals(true, $bool);
}

public function testSignInOperation(){
    $bool = true;

    $mailuid = "john";
    $password = "Doe";
  
    if (empty($mailuid) || empty($password) ) {
        $bool = false;
    }else {
      $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";
      $stmt = mysqli_stmt_init($conn);//Used to initialize an sql statement.
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        $bool = false;
     }else{
       mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt); //Checks the amount of matches 0 meaning no match.
       if ($row = mysqli_fetch_assoc($result)) {
         $pwdcheck = password_verify($password, $row['pwdUsers']);
         if ($pwdcheck ==false) {
            $bool = false;
         }
         $this->assertEquals(true, $bool);
       }
      }
    }
}
}