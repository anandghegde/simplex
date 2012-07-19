<?php
session_start();
$me=$_SESSION['username'];
    $xml= new SimpleXMLElement('users.xml',0,true);
$res=$xml->xpath('//user[username="'.$me.'"]');
if ($res==NULL or strcmp($res[0]->admin,"yes")!=0)
{
    header("Location: login.php");
}
$errors = array();
if(isset($_POST['register'])){
	$username = preg_replace('/[^A-Za-z0-9_]/', '', $_POST['username']);
	$email = $_POST['email'];
	$password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $admin=$_POST['admin'];
	$res=$xml->xpath('//user[username="'.$username.'"]');
	if($res!=NULL){
		$errors[] = 'Username already exists';
		print_r($res);
	}
	if($username == ''){
		$errors[] = 'Username is blank';
	}
	if($email == ''){
		$errors[] = 'Email is blank';
	}
	if($password == '' || $c_password == ''){
		$errors[] = 'Passwords are blank';
	}
	if($password != $c_password){
		$errors[] = 'Passwords do not match';
	}
	if(count($errors) == 0){
        $xml2 = simplexml_load_file("users.xml");
        $sxe = new SimpleXMLElement($xml2->asXML());
        $user = $sxe ->addChild("user");
        $user->addChild("email", $email);
        $user->addChild("username", $username);
        $user->addChild("admin", $admin);
        $user->addChild("password", $password);
        $sxe->asXML("users.xml");
        echo "Users successfully added, redirecting";
        header("refresh:2; url=admin.php");
   
    }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Register</title>
</head>
<body>
	<h1>Register</h1>
	<form method="post" action="">
		<?php
		if(count($errors) > 0){
			echo '<ul>';
			foreach($errors as $e){
				echo '<li>' . $e . '</li>';
			}
			echo '</ul>';
		}
		?>
		<p>Username <input type="text" name="username" size="20" /></p>
		<p>Email <input type="text" name="email" size="20" /></p>
		<p>Password <input type="password" name="password" size="20" /></p>
		<p>Confirm Password <input type="password" name="c_password" size="20" /></p>
        <p>Admin Previlege? <select name="admin"><option>yes</option><option>no</option></select></p>
		<p><input type="submit" name="register" value="Register" /></p>
	</form>
	<p><a href="admin.php">Home</a></p>
</body>
</html>
