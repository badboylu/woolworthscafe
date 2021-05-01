<?php
 $servername="jhdjjtqo9w5bzq2t.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
 $dBUsername="db361uh5fgdhosa8";
 $dBPassword="c17zbecid7wripme";
 $dBName="uozxi82sks708ppq";
$conn=mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);
$province=$_POST['Province'];
$city=$_POST['City'];
$area=$_POST['Area'];
$email=$_POST['email'];
$location=$province.'-'.$city.'-'.$area;
$username='Distro-'.$_POST['uid'];
$password=$_POST['pwd'];
$passwordrepeat=$_POST['pwdrepeat'];
$hashedPwd=password_hash($password,PASSWORD_DEFAULT);
date_default_timezone_set('Africa/Johannesburg');
$date=date("Y-m-d");


$sql="SELECT idDistro FROM distrouser WHERE idDistro=?";
$stmt=mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)){
       header("Location:RD2.php?error=SQL1");
       exit();
}
mysqli_stmt_bind_param($stmt,"s",$username);
   mysqli_stmt_execute($stmt);
   mysqli_stmt_store_result($stmt);
   $resultCheck=mysqli_stmt_num_rows($stmt);
   if($resultCheck > 0){
       header("Location:RD2.php?error=usernameexists");
       exit();
} 
$sql="SELECT idEmail FROM distrouser WHERE idEmail=?";
$stmt=mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)){
       header("Location:RD2.php?error=SQL2");
       exit();
}
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       header("Location:RD2.php?error=invalidemail");
       exit();
}
   mysqli_stmt_bind_param($stmt,"s",$email);
   mysqli_stmt_execute($stmt);
   mysqli_stmt_store_result($stmt);
   $resultCheck=mysqli_stmt_num_rows($stmt);
   if($resultCheck > 0){
       header("Location:RD2.php?error=emailexists");
       exit();
} 
   if($_POST['pwd'] != $_POST['pwdrepeat']){
       header("Location:RD2.php?error=pwdnomatch");
       exit();
}
     $uppercase = preg_match('@[A-Z]@', $password);
     $lowercase = preg_match('@[a-z]@', $password);
     $number    = preg_match('@[0-9]@', $password);
     $specialChars = preg_match('@[^\w]@', $password);
   if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
       header("Location:RD2.php?error=invalidpwd");
       exit();
}
    $sql="INSERT INTO distrouser (idDistro, idEmail, idPassword, idDate, idLocation) VALUES(?,?,?,?,?)";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
       header("Location:RD2.php?error=SQL3");
       exit();
}
     mysqli_stmt_bind_param($stmt,"sssss",$username,$email,$hashedPwd,$date,$location);
     mysqli_stmt_execute($stmt);
     $sql="DELETE FROM pwdrest WHERE pwdResetEmail='".$email."' ";
     mysqli_query($conn,$sql);
     header("Location:Signin.php?signup=successful");
     exit();
?>
