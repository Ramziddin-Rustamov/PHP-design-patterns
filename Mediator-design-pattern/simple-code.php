<?php
interface ChatMediator {
    public function sendMessage(string $message ,User $user);
}

class ChatRoom implements ChatMediator {
    private $users = [];

    public function addUser(User $user){
        $this->user[]= $user;
    }

    public function sendMessage(string $message, User $user){
        foreach($this->user as $u){
            if($u !== $user){
                $u->sendMessage();
            }
        }
    }
}

interface User{
    public function sendMessage(string $message);
    public function recieveMessage(string $message);
}

class ChatUser implements User {
      private  $name;
      private $chatMediator;

      public function __construct(string $name , ChatMediator $chatMediator)
      {
        $this->name = $name;
        $this->chatMediator = $chatMediator;
      }
}