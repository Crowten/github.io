<?php
	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$human = intval($_POST['human']);
		$from = 'Contact-form';
		$to = 'christian.kostadinov13@gmail.com';
		$subject = 'Message from Contact';
		$errName = true;
		$errEmail = true;
		$errMessage = true;
		$errHuman = true;


		require_once('mailer/class.phpmailer.php');

		 $mail = new PHPMailer(); // create a new object
		 $mail->IsSMTP(); // enable SMTP
		 $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		 $mail->SMTPAuth = true; // authentication enabled
		 $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		 $mail->Host = "viva.superhosting.bg";
		 $mail->Port = 465; // or 587
		 $mail->IsHTML(true);
		 $mail->Username = "support@zone-mix.com";
		 $mail->Password = '$zonemix1982';
		 $mail->SetFrom($email);
		 $mail->Subject = "$subject";
		 $mail->Body = "$message";
		 $mail->AddAddress("anelia.ruse@abv.bg");

		 ob_start();
		 $mail->Send();
		 ob_get_clean();



		$body = "From: $name\n E-Mail: $email\n Message:\n $message";

		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = false;
			echo ("invalid name");
		}

		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = false;
			echo ("invalid mail");
		}

		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = false;
			echo ("invalid msg");
		}
		//Check if simple anti-bot test is correct
		if ($human !== 5) {
			$errHuman = false;
			echo ("invalid anatisp");
		}

		// If there are no errors, send the email
		if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
			if (mail ($to, $subject, $body, $from)) {
				$result='<div class="alert alert-success">Вашето съобщение беше изпратено успешно.</div>';
			} else {
				$result='<div class="alert alert-danger">Възникна грешка при изпращане на съобщението. Моля опитайте по-късно.</div>';
				}
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Контакти</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/lightbox.min.js"></script>
</head>
<body>
<div id="Wrapper">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a href="index.html" class="navbar-brand">ZONE-MIX</a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse navHeaderCollapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown active">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Услуги <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="services.html#fun">Забавления</a></li>
							<li><a href="services.html#posters">Разлепяне на постери</a></li>
							<li><a href="services.html#flaer">Разнасяне на флаери</a></li>
							<li><a href="services.html#postbox">Разнос по пощенски кутии</a></li>
							<li><a href="services.html#others">Други</a></li>
						</ul>
					</li>
                    <li><a href="gallery.html">Галерия</a></li>
					<li><a href="partners.html">Партньори</a></li>
					<li><a href="contact.php">Контакти</a></li>
				</ul>
			</div>
		</div>
	</nav>
     <div class="container col-lg-6 col-md-4 col-lg-offset-3">
         <div class="row vertical-center-row" offset>
                <center><address>
                  <strong>Име Фамилия</strong><br>
                  Номер, имейл ....<br>
                  Адрес....<br>
                </address>
                </center>
            </div>
         </div>

    </div>
	<div class="container col-lg-6 col-md-4 col-lg-offset-3" vertical-center>
    <div class="row vertical-center-row">
	<form class="form-horizontal" role="form" method="post" name="Contact-form" action="contact.php">
        <center><h2>Пишете ни</h2></center>
		<div class="form-group">
			<label for="name" class="col-sm-2 control-label">Име:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="name" name="name" placeholder="Име и фамилия.." value="">
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">Email:</label>
			<div class="col-sm-10">
				<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
			</div>
		</div>
		<div class="form-group">
			<label for="message" class="col-sm-2 control-label">Съобщение:</label>
			<div class="col-sm-10">
				<textarea class="form-control" rows="4" name="message"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="human" name="human" placeholder="Отговор">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<! Will be used to display an alert to the user>
			</div>
		</div>
	</form>
        </div>
	</div>
</div>
</body>
</html>
