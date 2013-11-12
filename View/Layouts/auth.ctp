<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->Html->charset(); ?>
    <title> <?php echo 'Opencomp | '.$title_for_layout; ?> </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('font-awesome');
	echo $this->Html->css('opencomp.auth'); ?>
	<link href='https://fonts.googleapis.com/css?family=Cantarell&v1' rel='stylesheet' type='text/css'>
	<?php echo $scripts_for_layout;
    ?>
</head>
<body>
    <div id="container">
        <div id="content">                
            <div id="logo"><h1>Opencomp</h1></div>
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $content_for_layout; ?>
        </div>
	
        <div id="baspage">
            <p style="font-size:x-small; text-align:center; margin-top:10px; color:#777777;">
	            Ceci est une version de développement d'Opencomp.<br />
				Elle ne dois EN AUCUN CAS être utilisée en environnement de production !
			</p>
        </div>
    </div>
</body>
</html>