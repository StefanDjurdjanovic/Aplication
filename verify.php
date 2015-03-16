<html>
<head>
	<title>NETTUTS > Sign up</title>
	<link href="css/style_login.css" type="text/css" rel="stylesheet" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>	
	<div id="header">
		<h2>STRANA ZA VERIFIKACIJU</h2>
		<h2><a class="login" href="login.php">PRISTUP |</a></h2>
		<h2><a class="signup" href="signup.php">NAPRAVITE NALOG</a></h2>
		</div>
	<div id="wrap">
	    <?php
	    include('connection.php'); 
			
			if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
				// Verify data
				$email = mysql_escape_string($_GET['email']); 
				$hash = mysql_escape_string($_GET['hash']); 
				
				$search = mysql_query("SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error()); 
				$match  = mysql_num_rows($search);
				
				if($match > 0){
					mysql_query("UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
					echo '<div class="statusmsg">Vaš nalog je sada aktivan, možete se ulogovati!</div>';
				}else{
					echo '<div class="statusmsg">URL je netačan ili već imate aktiviran nalog!</div>';
				}
				
			}else{
				echo '<div class="statusmsg">Neodobren pristup, molimo koristite lik koji Vam je poslat email-om.</div>';
			}
	    	
	    ?>

		
	</div>
</body>
</html>
