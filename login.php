<?php
$error = false;
if(isset($_POST['login'])){
	$username = preg_replace('/[^A-Za-z0-9_]/', '', $_POST['username']);
	$password = $_POST['password'];
		$xml = new SimpleXMLElement('users.xml', 0, true);
    $res=$xml->xpath('//user[username="'.$username.'"]');
    if ($res==NULL or $res[0]->password!=$password)
    {
        $error=1;
    }
    else{
			session_start();
            $_SESSION['username'] = $username;
            if (strcmp($res[0]->admin, "yes")==0)
            {
                header('Location:admin.php');
            }
            else{
			header('Location:index.php');
			}die;
    }

	$error = true;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<form method="post" action="">
		<p>Username <input type="text" name="username" size="20" /></p>
		<p>Password <input type="password" name="password" size="20" /></p>
		<?php
		if($error){
			echo '<p>Invalid username and/or password</p>';
		}
		?>
		<p><input type="submit" value="Login" name="login" /></p>
	</form>
</body>
</html>
