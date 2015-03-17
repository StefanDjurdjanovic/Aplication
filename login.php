<html>
<head>
	<title>Strana za ulaz</title>
	<link href="style_login.css" type="text/css" rel="stylesheet" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<div id="header">
		<h2>PRISTUPNA STRANA</h2>
		<h2><a class="signup" href="signup.php">NAPAVITE NALOG</a></h2>
	</div>
	<div id="wrap">
	    <?php
	    include('connection.php'); 
			
			if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['password']) && !empty($_POST['password'])){
				$username = mysql_escape_string($_POST['name']);
				$password = mysql_escape_string(md5($_POST['password']));
				
				$search = mysql_query("SELECT username, password, active FROM users WHERE username='".$username."' AND password='".$password."' AND active='1'") or die(mysql_error()); 
				$match  = mysql_num_rows($search);
				
				if($match > 0){
					header("location: index.php");
				}else{
					$msg = 'Neuspešan pristup!<br /> moli Vas da se uverite da ste uneli ispravne podatke, nakon toga možete pristupiti nalogu.';
				}
			}
				
	    	
	    ?>	
		<h2>Pristupna forma</h2>
		<p>Molimo unestite aktivacione podatke kako bi pristupili nalogu</p>
		
		<?php 
			if(isset($msg)){ 
				echo '<div class="statusmsg">'.$msg.'</div>'; 
			} ?>
		
		<form action="" method="post">
			<label for="name">Name:</label>
			<input type="text" name="name" value="" />
			<label for="password">Password:</label>
			<input type="password" name="password" value="" />
			
			<input type="submit" class="submit_button" value="Log in" />
		</form>
		
	</div>	
</body>
</html>
