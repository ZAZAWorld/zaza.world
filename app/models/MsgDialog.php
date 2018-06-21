<?php
/**
 * Created by IntelliJ IDEA.
 * User: kalym
 * Date: 9/22/16
 * Time: 15:03
 */

class MsgDialog extends Eloquent{
    protected $table = 'msg_dialogs';
    protected $fillable = array('title','created','last_message_received');
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('User');
    }

    function relUser() {
        return $this->belongsToMany('User', 'msg_dialog_users', 'dialog_id', 'user_id');
    }

    function relMessage() {
        return $this->hasMany('MsgDialogMessages', 'dialog_id');
    }
    static function getUserDialogs($id){
        $user = User::find($id);
        return  $user->relDialogs()->get();
    }

    static function getUserDialogList($id,$keyword = ''){

        // Long polling optimization query
        $dialogList = DB::table('users')
            ->join('msg_dialog_users','users.id','=','msg_dialog_users.user_id')
            ->join('msg_dialogs','msg_dialog_users.dialog_id','=','msg_dialogs.id')
            ->leftJoin('companies','companies.user_id','=','users.id')
            ->leftJoin('persons','msg_dialog_users.user_id','=','persons.user_id')
            ->whereRaw("`msg_dialog_users`.`dialog_id` in (SELECT `dialog_id` from msg_dialog_users where user_id = $id ) and users.id != $id and (users.email like '$keyword%' or companies.title like '%$keyword%')")
            ->select('users.id as user_id','persons.f_name as person_first','persons.s_name as person_last','persons.photo as person_photo','companies.photo','companies.title','users.f_name', 'users.l_name', 'users.avatar','msg_dialogs.last_message_received', 'msg_dialog_users.dialog_id',
                DB::raw('(SELECT COUNT(id) FROM msg_dialog_messages WHERE msg_dialog_messages.dialog_id = msg_dialog_users.dialog_id and msg_dialog_messages.user_id != '.$id.' and msg_dialog_messages.id > \''.Session::get('chat_lastMessageReceived').'\') as count'))
            ->orderBy('msg_dialogs.last_message_received', 'desc')
            ->groupBy('msg_dialogs.id')
            ->paginate(20);

        return  $dialogList;
    }

    static function checkDialogExist($user_id){

        $dialog = DB::table('msg_dialogs')
            ->join('msg_dialog_users','msg_dialogs.id', '=', 'msg_dialog_users.dialog_id')
            ->join('users','msg_dialog_users.user_id','=','users.id')
            ->leftJoin('companies','msg_dialog_users.user_id','=','companies.user_id')
            ->leftJoin('persons','msg_dialog_users.user_id','=','persons.user_id')
            ->where('msg_dialog_users.user_id',$user_id)
            ->whereRaw('msg_dialog_users.dialog_id IN
                (select msg_dialog_users.dialog_id
                    from `users`
                    inner join `msg_dialog_users` on `users`.`id` = `msg_dialog_users`.`user_id`
                    where  `msg_dialog_users`.`user_id` = '.Auth::user()->id.')')
            ->select('msg_dialog_users.dialog_id','users.avatar','msg_dialog_users.user_id','users.l_name','users.f_name','persons.f_name as person_first','persons.s_name as person_last','persons.photo as person_photo','companies.title','companies.photo')
            ->first()
        ;

        return $dialog;
    }


    static function getNewMessagesCount()
    {
        if (Auth::user()) {
            $dialogs = MsgDialog::getUserDialogList(Auth::user()->id);
            $newMessagesCount = 0;
            foreach ($dialogs as $dialog){
                $newMessagesCount+=$dialog->count;
            }
            return $newMessagesCount;
        }else{
            return $newMessagesCount = 0;
        }
    }

    static function getUsersForDialogs($keyword){
        $myId = Auth::user()->id;

        $users = DB::table('users')
            ->leftJoin('companies','companies.user_id','=','users.id')
            ->leftJoin('persons','users.id','=','persons.user_id')
            ->whereRaw("users.id != $myId and (users.email like '{$keyword}%' or companies.title like '%{$keyword}%' )")
            ->select('users.id','persons.f_name as person_first','persons.s_name as person_last','persons.photo as person_photo','users.f_name','users.l_name','users.avatar','companies.title','companies.photo')
            ->groupBy('users.id')
            ->paginate(10);

        return $users;
    }
}

