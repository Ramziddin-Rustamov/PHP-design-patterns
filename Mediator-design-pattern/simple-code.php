<?php
interface ChatMediator {
    public function sendMessage($message ,User $user);
}

class ChatRoom implements ChatMediator {
    private $users = [];

    public function addUser(User $user){
        $this->users[]= $user;
    }

    public function sendMessage($message, User $user){
        $user->recieveMessage($message);
        foreach($this->users as $u){
            if($u !== $user){
                $u->recieveMessage($message);
            }
        }
    }
}

interface User{
    public function sendMessage($message);
    public function recieveMessage($message);
}

class ChatUser implements User {
      private  $name;
      private $chatMediator;

      public function __construct($name , ChatMediator $chatMediator)
      {
        $this->name = $name;
        $this->chatMediator = $chatMediator;
      }

      public function sendMessage($message)
      {
        $this->chatMediator->sendMessage($message, $this);
      }

      public function recieveMessage($message)
      {
        echo  "{$this->name} recieve message  : {$message}\n";
      }
}

$chatroom = new ChatRoom();

$chatUser1 = new ChatUser("Ramziddin",$chatroom);
$chatUser2 = new ChatUser("Jonibek",$chatroom);
$chatUser3 = new ChatUser("Muhriddin",$chatroom);

$chatroom->addUser($chatUser1);
$chatroom->addUser($chatUser2);
$chatroom->addUser($chatUser3);

$chatUser1->sendMessage("Hi everyone");
$chatUser2->sendMessage("Hi Ramziddin");
$chatUser3->sendMessage("Hi Ramziddin");




