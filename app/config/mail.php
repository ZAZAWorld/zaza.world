<?php
return array(
	'driver' => 'smtp',
	'host' => 'mail.zaza.ae',
	'port' => 587,
	'from' => array('address' => 'noreply@zaza.ae', 'name' => 'noreply@zaza.ae'), 
        'encryption' => 'tls',	
        'username' => 'noreply@zaza.ae',
	'password' => '***************',
	'sendmail' => '/usr/sbin/sendmail -bs',
	'pretend' => false,
);
