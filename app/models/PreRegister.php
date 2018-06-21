<?php
class PreRegister extends Eloquent
{
    protected $table = 'pre_register';
    protected $fillable = array('auth_id', 'auth_from', 'birzhday', 'photo',
        'full_name', 'created_at', 'updated_at', 'about', 'f_name', 's_name',
        'user_id', 'phone', 'mobile', 'status_id', 'l_name', 'login',
        'email', 'password', 'change_password','remember_token', 'active', 'country_id', 'city_id', 'lang_id',
        'user_type_id', 'last_visit', 'location', 'is_active', 'confirm_active');
    protected $hidden = array('password', 'remember_token');

    protected static $rules = [
        'email'=>'unique:users', 'password'=>'required|min:6', 'user_type_id'=>'required|numeric'
    ];

    function setActiveChecker ($phone = '') {
        $this->confirm_active = $this->id;
        $this->is_active = 0;
        $this->save();
        if($this->user_type_id == 3) {
            $text = 'Activation code for zaza.ae:'.$this->id;
            $phone = preg_replace('/[^0-9]/i','',$phone);
            MailSend::sendSms($phone, $text);
        }
        else {
            MailSend::send($this->email,
                'Activation of account',
                'Follow <a href="https://zaza.ae/activate-account/?user_id=' . $this->id . '&pass=' . $this->confirm_active . '">this link</a> to activate your account
						<div style="margin-top:40px"><img src="https://zaza/images/logo.png" width="130" /></div>'
            );
        }
    }
}
