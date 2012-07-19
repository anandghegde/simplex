<?php
session_start();
$me=$_SESSION['username'];
$xml= new SimpleXMLElement('users.xml',0,true);
$res=$xml->xpath('//user[username="'.$me.'"]');
if ($res==NULL)
{
	header('Location: login.php');
	die;
}
$error="no";
if(isset($_POST['change'])){
if (strcmp($_POST['n_password'], $_POST['c_n_password'])==0){
$error="no";
    $xml = simplexml_load_file("users.xml");
    $sxe = new SimpleXMLElement($xml->asXML());
    $r=$sxe->xpath('//user[username="'.$me.'"]');
    $r[0]->password=$_POST['n_password'];
    $sxe->asXML("users.xml");
    
        echo "Password changed redirecting to  home";
		header("refresh:2;url=index.php");}
		else{
		$error="yes";}}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>User Page</title>
</head>
<body>
	<h1>Change Password</h1>
	<form method="post" action="">
		<?php 
		if(strcmp($error, "yes")==0){
			echo '<p> <font color="red">Passwords do not match</font></p>';
		}
		?>
		<p>New password <input type="password" name="n_password" /></p>
		<p>Confirm new password <input type="password" name="c_n_password" /></p>
		<p><input type="submit" name="change" value="Change Password" /></p>
	</form>
	<hr />
	<a href="index.php">User home</a>
</body>
</html>
