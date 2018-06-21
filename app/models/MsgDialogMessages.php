<?php

class MsgDialogMessages extends Eloquent
{
    protected $table = 'msg_dialog_messages';
    protected $fillable = array('dialog_id','user_id','content', 'datetime','attachment_path', 'attachment_real_name');
    public $timestamps = false;

    static function getMessages($dialog_id){
        $dialog = MsgDialog::find($dialog_id);
        return iterator_to_array( $dialog->relMessage()->orderBy('id', 'desc')->paginate(20) );// to realize revers printing
    }

    static function sendMessage($data){
        $msg = MsgDialogMessages::create($data);
        $dialog = MsgDialog::find($data['dialog_id']);
        $dialog->last_message_received = $msg->id;
        $dialog->save();
        return $dialog->id;
    }

}