<?php
session_start();
if (!isset($_SESSION['username'])){
	header('Location: login.php');
	die;
}
else{
$username=$_SESSION['username'];
    $xml= new SimpleXMLElement('users.xml',0,true);
    $res=$xml->xpath('//user[username="'.$username.'"]');
    if (strcmp($res[0]->admin, "yes")!=0)
    {	
        print "<h1> You got no rights here motherfucker! , redirecting in 5 sec </h1>";
        header( "refresh:5;url=index.php" );
    }}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Admin Page</title>
</head>
<body>
	<h1>Admin Page</h1>
	<h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
		<?php
			echo '<h4> '.$res[0]->email .'</h4> ';
		?>
		
<ul><li>
		<a href="register.php">Add user</a></li>
		<li><a href="changepassword.php">Change Password</a></li>
<li>	<a href="logout.php">Logout</a></li>
</ul></body>
</html>
