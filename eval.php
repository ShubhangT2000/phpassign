<?php
include 'conn.php';
if (isset($_POST['option'])) {
$username=$_COOKIE['user'];
$option=$_POST['option'];
$num=$_POST['number'];
$user=$conn->query("SELECT * from Users where username='".$username."'");
$info=mysqli_fetch_assoc($user);
$ask="SELECT * FROM results WHERE username='".$username."' AND q='".$num."'";
	$res=$conn->query($ask);
	$change=mysqli_fetch_assoc($res);
$que="SELECT * from Questions where number='".$num."'";
$result=$conn->query($que);
$result1=mysqli_fetch_assoc($result);
if ($option==$result1['correct']) {
	$q="UPDATE results SET status='answered-correct' where userq='".$username."' AND q='".$num."'";
	$points=$info['points']+$result1['points'];
	$q1="UPDATE Users SET points =".$points." where username='".$username."'";
	$conn->query($q1);
	$conn->query($q);
}else{
$q="UPDATE results SET status='answered-incorrect' where userq='".$username."' AND q='".$num."'";
$conn->query($q);
}
header("Location: solve.php");
}else{
	header("Location: solve.php");
}
?>