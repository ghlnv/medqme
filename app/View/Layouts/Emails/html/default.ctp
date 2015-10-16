<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html style="margin: 0; padding: 0;">
<head>
	<title><?php echo $title_for_layout; ?></title>
</head>
<body style="margin: 0; padding: 0;">
<div style="background: #F4F0F0; border-radius: 0.4em; font-family: verdana, arial; padding: 0.5em;">
<div style="background: #373737; border-radius: 0.4em; padding: 1em;">
<a
	title="Acesse o MedQMe"
	href="http://medqme.com.br"
	style="font-size: 1.6em; font-weight: bolder; letter-spacing: 0.1em; text-decoration: none; color: #fff;">
MedQMe
</a>
</div>
<div style="background: #fff; border-radius: 0.4em; color: #666; font-size: 1.1em; margin: 0.5em 0 0.5em; padding: 1em;">
<?php echo $this->fetch('content'); ?>
</div>
<div style="background: #ddd; border-radius: 0.4em; padding: 1em; text-align: right;">
Este e-mail foi enviado pelo portal <a style="color: #300;" href="http://medqme.com.br">MedQMe</a>.
</div>
</div>
</body>
</html>