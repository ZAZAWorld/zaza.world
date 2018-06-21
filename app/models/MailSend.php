<?php
class MailSend extends Eloquent {
	protected $table = 'mail_send';
    protected $fillable = array('title', 'note', 'to_email', 'to_name', 'to_user_id');
	
	function relUser () {
		return $this->belongsTo('User', 'to_user_id');
	}
	
	static function send ($to_email, $title, $note, $user_id = false) {
		$to_name = null;
		$to_user_id = 0;
		$user = User::find($user_id);
		if ($user){
			$to_name = $user->full_name;
			$to_user_id = $user->id;
		}
		
		if (!$to_name)
			$to_name = 'Dear user';
		
		Mail::queue('emails.message', array('title' => $title, 'note'=>$note), function($message) use ($to_email, $title, $to_name){
			$message->to($to_email, $to_name)->subject($title);
		});

		$mail = new MailSend();
		$mail->title = $title;
		$mail->note = $note;
		$mail->to_email = $to_email;
		$mail->to_name = $to_name;
		$mail->to_user_id = $to_user_id;
		
		if (!$mail->save())
			return false;
			
		return $mail;
	}

	static function sendBannerEmail ($bann) {
		$title = 'New Banner';
		$note = '<p>New banner order</p>';
		
		$note = $note.'<p>Name of the client: '.$bann->name.'</p>';
		$note = $note.'<p>Location of the client: '.$bann->location.'</p>';
		$note = $note.'<p>Contact of the client: '.$bann->contact.'</p>';
		$note = $note.'<p>License of the client: </p> <div style="margin-top:40px"><img src="https://zaza.ae/'.$bann->license.'" width="130" /></div>';
		$note = $note.'<p>Banner of the client: </p> <div style="margin-top:40px"><img src="https://zaza.ae/'.$bann->banner.'" width="130" /></div>';
		
		
		MailSend::send($bann->recipient, $title, $note);
		
		return true;
	}
	
	static function sendBannerModarateTrueMessage ($banner){
		
		$title = 'Banner advertising with zaza.ae ';
		$note = '<p>Dear Advertiser,</p>';
		
		$note = $note.'<p>Your application no '.$banner->id.' for Banner Advertising in zaza.ae has been approved.</p>';
		
		$note = $note.'<p>Advertising starting date: '.ModelSnipet::formatDate($banner->publish_unix, 'd.m.Y').'<br />';
		$note = $note.'Advertising ending  date: '.ModelSnipet::formatDate($banner->close_unix, 'd.m.Y').'</p>';
		$note = $note.'<p>Thank you for choosing zaza.ae.</p>';
		$note = $note.'<p>We wish you succesful deals and pleasant experience with us.</p> <br/>';
        $note = $note.'<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';
		$note = $note.'<p>Sell. Buy. Enjoy</p>';
		
		MailSend::send($banner->email, $title, $note);
		
		return true;
	}
	
	static function sendBannerModarateFalseMessage ($banner){
		$title = 'Banner advertising with zaza.ae ';
		$note = '<p>Dear Advertiser,</p>';
		
		$note = $note.'<p>Your application no '.$banner->id.' for Banner Advertising in zaza.ae has been closed.</p>';
		$note = $note.'<p>Please try again</p>';
		
		$note = $note.'<p>We wish you succesful deals and pleasant experience with us.</p> <br/>';
        $note = $note.'<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';
		
		MailSend::send($banner->email, $title, $note);
		
		return true;
	}
	
	
	static function sendNewPasswordMessage ($user, $password){
		$title = 'Your new password at zaza.ae';
		$note = 'New password for your account is <strong>'.$password.'</strong> ';
        $note .= '<br/><br/><br/>';
        $note .= '<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';
		MailSend::send($user->email, $title, $note, $user->id);
		
		return true;
	}
	
	static function sendForgotPasswordMessage($user){
		$title = 'You have requested new password';

                if ($_SERVER["SERVER_ADDR"] == "10.0.0.80")
                $note = 'To change password, please go through this  <a href="https://zaza.ae:8329/forget-password?id='.$user->id.'&key='.$user->change_password.'">link</a>';
                else
                $note = 'To change password, please go through this  <a href="https://zaza.ae/forget-password?id='.$user->id.'&key='.$user->change_password.'">link</a>';

        $note .= '<br/><br/><br/>';
        $note .= '<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';

		MailSend::send($user->email, $title, $note, $user->id);
		
		return true;
	}
	
	static function sendMessageRegistration($user){
            $title = 'Your login and password with zaza.ae';
            $note = 'Dear '.$user->full_name.', <br/>';
            $note .= 'Thank you for becoming part of zaza.ae. <br/>';
            if ($user->user_type_id == 3)
                $note .= 'Balance in your account: AED 222 <br/>';
            else
                $note .= 'Balance in your account: AED 555 <br/>';
            $note .= 'Your login: '.$user->email.' <br/>';
            $note .= 'Your password: '.$user->pass_see.' <br/>';
            $note .= '<br/><br/><br/>';
            $note .= '<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';
                MailSend::send($user->email, $title, $note, $user->id);
            return true;
	}
	
	static function sendMessageModerateTrue($user){
		$title = 'You have successfully passed moderated online';
		$note = 'You have successfully passed moderated online on the site zaza.ae.';
        $note .= '<br/><br/><br/>';
        $note .= '<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';
        MailSend::send($user->email, $title, $note, $user->id);
		
		return true;
	}
	
	static function sendMessageModerateFalse($user){
		$title = 'You have not been moderated.';
		$note = 'You have not been moderated on the site zaza.ae.';
        $note .= '<br/><br/><br/>';
        $note .= '<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';

		MailSend::send($user->email, $title, $note, $user->id);
		
		return true;
	}
	
	static function sendMessageAdvertAdd ($advert) {
		$user = $advert->relUser;
		if (!$user || !$user->email)
			return false;
			
		$title = 'You have add new advert "'.$advert->title.'" on the site zaza.ae.';
		$note = 'You have add new advert "'.$advert->title.'" on the site zaza.ae. Your advert will be moderate';
        $note .= '<br/><br/><br/>';
        $note .= '<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';
		MailSend::send($user->email, $title, $note, $user->id);
		
		return true;	
	}
	
	static function sendMessageAdvertModerateTrue($advert) {
		$user = $advert->relUser;
		if (!$user || !$user->email)
			return false;
			
		$title = 'Your ad with zaza.ae is successful';
		$note = 'Dear '.$user->full_name.',<br />';
		$note .= 'Your ad «'.$advert->title.'» is live.  You may view and edit it in your account in <a href="https://zaza.ae">My Ads</a> section.<br />';
		$note .= '<br /><br /><br />';
        $note .= '<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';
		
		MailSend::send($user->email, $title, $note, $user->id);
		
		return true;	
	}
	
	static function sendMessageAdvertModerateFalse ($advert) {
		$user = $advert->relUser;
		if (!$user || !$user->email)
			return false;
			
		$title = 'Your ad has been deleted.';
		$note = 'Dear '.$user->full_name.',<br />';
		$note .= 'Your ad «'.$advert->title.'» has been deleted, since it is against Ad posting rules of Zaza.ae, mentioned in  <a href="https://zaza.ae">Terms & Conditions</a>.<br />';
		$note .= 'Please try again.<br />';
        $note .= '<br/><br/><br/>';
        $note .= '<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';
		
		MailSend::send($user->email, $title, $note, $user->id);
		
		return true;	
	}
	
	static function sendCallBackMessage ($user, $company, $subject='Sample subject', $contact = false, $full_name = false, $email  = false) {
		if (!$user || !$user->email || !$company)
			return false;
		
		$company_user = User::find($company->user_id);
		if (!$company_user)
			return false;
        $title = 'You have received inquiry by  Call Back';

		if ($full_name)
			$note = 'You have received business request in CallBack at your account “        ” registered in zaza.ae.';
		else 
			$note = 'You have received business request in CallBack at your account “'.$user->full_name.'” registered in zaza.ae.';
		
		if ($full_name)
			$note .= '<p>Request from:		'.$full_name.'</p>';
		else
			$note .= '<p>Request from:		'.$user->full_name.'</p>';
			
		$note .= '<p>Date, time:		 '.date("Y-m-d H:i:s").'</p>';
		
		if ($email)
			$note .= '<p>Email:			     '.$email.'</p>';
		else
			$note .= '<p>Email:			     '.$user->email.'</p>';
		
		if ($contact)
			$note .= '<p>Contact number:     '.$contact.'</p>';
		else 
			$note .= '<p>Contact number:     '.$user->getContactNumber().'</p>';
			
		$note .= '<p>Subject:            '.$subject.'</p>';
		$note .= '<br/ ><br/ >';
		$note .= '<p>Please, contact back. Perhaps, it is deal you are looking for.</p>';
        $note .= '<br/><br/><br/>';
        $note .= '<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';
		MailSend::send($company_user->email, $title, $note, $company_user->id);
		
		return true;	
	}

	static function sendAdRenewAdvert ($advert){
		$user = $advert->relUser;
		if (!$user || !$user->email)
			return false;
			
		$date = $advert->created_unix;
		$date = $date + (60 * 60 * 24 * 30);
		$date = date('d.m.Y', $date);
			
		$title = 'Renew your ad and get more deals.';
		$note = 'Dear '.$user->full_name.',<br />';
		
		$note .= 'Your ad «'.$advert->title.'» going to be expired on «'.$date.'». If the ad is still valid, you may renew it for the next «30» days through the link zaza.ae.<br />';
        $note .= '<br/><br/><br/>';
        $note .= '<p><div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div></p> ';
		
		MailSend::send($user->email, $title, $note, $user->id);
		
		return true;
	}


    static function sendSms($recipient, $text){
        $api = new Mobizon\MobizonApi('**************************');

        if ($api->call('message', 'sendSMSMessage',
            array(
                'text'    => $text,
                'recipient'    => $recipient, //Optional, if you don't have registered alphaname, just skip this param and your message will be sent with our free common alphaname.
            )
            )
        ) {
            $messageId = $api->getData('messageId');
            if ($messageId) {
                $messageStatuses = $api->call(
                    'message',
                    'getSMSStatus',
                    array(
                        'ids' => array($messageId)
                    ),
                    array(),
                    true
                );
                if ($api->hasData()) {
                    foreach ($api->getData() as $messageInfo) {
                       // echo 'Message # ' . $messageInfo->id . " status:\t" . $messageInfo->status . PHP_EOL;
                    }
                    return true;
                }
            }
        } else {
            //echo 'An error occurred while sending message: [' . $api->getCode() . '] ' . $api->getMessage() . 'See details below:' . PHP_EOL;
            //var_dump(array($api->getCode(), $api->getData(), $api->getMessage()));
            return false;
        }
    }
}
