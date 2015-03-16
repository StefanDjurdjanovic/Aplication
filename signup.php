

<html >
<head>
	<title>Otvaranje naloga</title>
	<link href="css/style_login.css" type="text/css" rel="stylesheet" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>	
	<div id="header">
		<h2>Napravite nalog</h2>
		<h2><a class="login" href="login.php">PRISTUP</a></h2>
	</div>	
	<div id="wrap">
	    <?php
	    include('connection.php');
	    	
	    	if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email'])){
	    		$name = mysql_escape_string($_POST['name']);
	    		$email = mysql_escape_string($_POST['email']);
	    		
	    		
				if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){
					$msg = 'email koji ste uneli je netačan, molimo pokušajte ponovo!';
				}else{
					$msg = 'Vaš nalog je napravljen, <br /> molimo verifikujte Vas nalog klikom na ling koji smo Vam poslali email-om!';
					
					$hash = md5( rand(0,1000) ); 
					$password = rand(1000,5000); 
 
					
					mysql_query("INSERT INTO users (username, password, email, hash) VALUES(
				    '". mysql_escape_string($name) ."', 
					'". mysql_escape_string(md5($password)) ."', 
					'". mysql_escape_string($email) ."', 
					'". mysql_escape_string($hash) ."') ") or die(mysql_error());  
					
					$to      = $email; 
					$subject = 'Signup | Verification';  
					$message = '

					Hvala što koristite našu aplikaciju!
					Vaš nalog je napravljen, možete se prijaviti sa sledećim podacima nakon što aktivirate Vaš nalog klikom na ling ispod.

					------------------------
					Username: '.$name.'
					Password: '.$password.'
					------------------------

					localhost/KonacnaAplikacija/source_files/verify.php?email='.$email.'&hash='.$hash.'

					'; 
					
					$headers = 'From:s.djurdjanovic@gmail.com' . "\r\n"; 
					mail($to, $subject, $message, $headers); 

				}
				
	    	}
	    	
	    ?>
	    	
		<h2>Aktivacija naloga</h2>
		<p>Molimo unesite ime i email adresu kako bi napravili nalog</p>
		
		<?php 
			if(isset($msg)){ 
				echo '<div class="statusmsg">'.$msg.'</div>'; 
			} ?>
		
		<!-- start sign up form -->	
		<form action="" method="post">
			<label for="name">Ime:</label>
			<input type="text" name="name" value="" />
			<label for="email">Email:</label>
			<input type="text" name="email" value="" />
			
			<input type="submit" class="submit_button" value="Napravite nalog" />
		</form>
	</div>	
</body>
</html>
