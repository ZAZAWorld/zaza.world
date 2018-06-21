<?php


class MessageController extends BaseController{

    function getIndex(){

       if( Auth::check() ){

           $myId = Auth::user()->id;
           $data = array(
               'dialogs' => [],
               'users' => [],
               'messages' => [],
               'me' => $myId,
               'dialogId' => 0,
               'dialogUserName' => '',
               'dialogAvatar' => ''); //base data constructor
           $dialogId = false;



           if(Input::has('chatWith')){

              $chatWith = Input::get('chatWith');
              $activeDialog = MsgDialog::checkDialogExist($chatWith);

               if(count($activeDialog)){
                   $dialogId = false;
               } else {
                   $this->createDialog($chatWith) ;
                   $activeDialog = MsgDialog::checkDialogExist($chatWith);
               }

           }else{
               $activeDialog = [];
           }

           $dialogs = MsgDialog::getUserDialogList($myId);

           if($dialogs->getTotal()!=0){
               
               $lastDialog = $dialogs->getItems()[0];
               //get data for active dialog
               if(count($activeDialog)){

                   $data['dialogUserName'] = ($activeDialog->f_name and $activeDialog->l_name) ? $activeDialog->f_name . ' ' . $activeDialog->l_name : $activeDialog->title;
                   $data['dialogAvatar'] = ($activeDialog->person_photo) ? $activeDialog->person_photo : $activeDialog->photo ;
                   $dialogId = $activeDialog->dialog_id;

               }else {
                   
                   $dialogId = ($dialogId) ? $dialogId : $lastDialog->dialog_id; //setting active dialog from last dialog
                   $data['dialogUserName'] = ($lastDialog->f_name and $lastDialog->l_name) ? $lastDialog->f_name . ' ' . $lastDialog->l_name : $lastDialog->title;
                   $data['dialogAvatar'] = $lastDialog->person_photo ? $lastDialog->person_photo : $lastDialog->photo;
                   $data['messages'] = MsgDialogMessages::getMessages($dialogId);

               }

               $data['messages'] = MsgDialogMessages::getMessages($dialogId);
               $data['dialogs'] = $dialogs;
               $data['dialogId'] = $dialogId;

               Session::put('chat_activeDialog', $dialogId);
               Session::put('chat_lastMessageReceived', $lastDialog->last_message_received);

           }

           return View::make('front.messages.index', $data);
       }

    }

    function messagePolling(){

        $my_id = Auth::user()->id;
        $user = User::find($my_id);
        $lastMessageReceived = Session::get('chat_lastMessageReceived');


        $lastDialog = $user->relDialogs()
            ->whereRaw("last_message_received > '".$lastMessageReceived."'")
            ->first();

        $result=array();

        if($lastDialog){

            $activeDialog = MsgDialog::find(Session::get('chat_activeDialog'));
            $activeDialogMessages = $activeDialog->relMessage()
                ->whereRaw("msg_dialog_messages.user_id != ".$my_id." and msg_dialog_messages.id > '".$lastMessageReceived."'")
                ->orderBy('msg_dialog_messages.id','desc')
                ->get();
            $messageView = false;

            if(count($activeDialogMessages)){
                $messageView =  View::make('front.messages.message-list',
                    array( 'messages'=>iterator_to_array($activeDialogMessages), 'me'=>$my_id ) )
                    ->render();
            }

            $result['messages'] = $messageView;
            $result['dialogs'] = $this->searchDialogs();

            Session::put('chat_lastMessageReceived', $lastDialog->last_message_received);

        }

        return Response::json($result);
    }

    function sendMessage(){

        $content = Input::get("content");
        $dialogId = Input::get("dialog_id");
        $file = Input::file('attachment');
        $fileExist = !empty($file);

        $messageData = array(
            'content' => $content,
            'datetime' => date("Y-m-d H:i:s"),
            'dialog_id' => $dialogId,
            'user_id' => Auth::user()->id,
            'attachment_path' => false
        );

        if($fileExist) {
            $messageData = $this->uploadAttachment($file, $messageData);
        }

        $msgResponse =  MsgDialogMessages::sendMessage($messageData) ? 'Message send.' : 'Send error!' ;

        return $messageData['attachment_path'] ? array(
            'path' => $messageData['attachment_path'],
            'name' => $messageData['attachment_real_name'],
            'randId' => Input::get('rand-id')
        ) : $msgResponse;
    }

    function checkNewMessages(){
            return MsgDialog::getNewMessagesCount();
    }

    function searchDialogs(){

        $keyword = Input::has("dialog_search") ? Input::get("dialog_search") : '';
        $dialogs = MsgDialog::getUserDialogList( Auth::user()->id, $keyword );
        $activeDialog = Session::get('chat_activeDialog');

        $data= array(
            'dialogs' => $dialogs,
            'users' => [],
            'dialogId' => $activeDialog
        );

        if(count($dialogs) < 1 and $keyword){
            $data['users'] = MsgDialog::getUsersForDialogs($keyword);
        }

        return View::make('front.messages.dialog-list', $data)->render();

    }

    function openDialog(){

        if(Input::has('is-user')){
            $user_id = Input::get('id');
            return $this->createDialog($user_id);
        }
            
        return $this->getMessages();
    }

    function getMessages(){
        
        $dialog_id = Input::get('id');
        Session::put('chat_activeDialog',$dialog_id);
        $data = array(
            'messages' => MsgDialogMessages::getMessages($dialog_id),
            'me' => Auth::user()->id,
        );
        
        return Response::json(View::make('front.messages.message-list', $data)->render());
    }
    
    protected function createDialog($user_id){

        $dialog = MsgDialog::create(array('created'=> date("Y-m-d H:i:s")));
        $dialogUsers = array(intval($user_id), Auth::user()->id);
        $dialog->relUser()->attach($dialogUsers);
        Session::put('chat_activeDialog',$dialog->id);
        
        return $dialog->id;
    }

    protected function uploadAttachment($file,$messageData){
        $destinationPath = public_path().'/uploads';
        $fileRandName = str_random(12).'.'.$file->getClientOriginalExtension();
        $fileRealName = $file->getClientOriginalName();
        $upload_success = Input::file('attachment')->move($destinationPath, $fileRandName);
        $messageData['attachment_path'] = $fileRandName;
        $messageData['attachment_real_name'] = $fileRealName;

        return $messageData;
    }
}
