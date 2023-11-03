<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>
    <style>
        .chat-box {
            width: 400px;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="chat-box">
        <h1>Chat Room</h1>
        <div id="chat-messages"></div>
        <form method="post">
            <input type="text" name="message" placeholder="Enter your message">
            <button type="submit">Send</button>
        </form>
    </div>

    <?php
    // Mediator Interface
    interface ChatMediator {
        public function sendMessage($message, User $user);
    }

    // Concrete Mediator: ChatRoom
    class ChatRoom implements ChatMediator {
        private $users = [];
        private $chatMessages = [];

        public function addUser(User $user) {
            $this->users[] = $user;
        }

        public function sendMessage($message, User $user) {
            $this->chatMessages[] = "<strong>{$user->getName()}:</strong> " . htmlspecialchars($message);
            foreach ($this->users as $u) {
                if ($u !== $user) {
                    $u->receiveMessage($message, $user->getName());
                }
            }
        }

        public function getChatMessages() {
            return implode("<br>", $this->chatMessages);
        }
    }

    // Colleague Interface
    interface User {
        public function sendMessage($message);
        public function receiveMessage($message, $sender);
        public function getName();
    }

    // Concrete Colleague: ChatUser
    class ChatUser implements User {
        private $name;
        private $chatMediator;
        
        public function __construct($name, ChatMediator $chatMediator) {
            $this->name = $name;
            $this->chatMediator = $chatMediator;
        }

        public function sendMessage($message) {
            $this->chatMediator->sendMessage($message, $this);
        }

        public function receiveMessage($message, $sender)
        {
            echo "<strong>{$sender}:</strong> " . htmlspecialchars($message) . "<br>"; 
        }

        public function getName() {
            return $this->name;
        }
    }

    // Create a chat room (mediator)
    $chatroom = new ChatRoom();

    // Create chat users (colleagues)
    $chatUser1 = new ChatUser("Ramziddin", $chatroom);
    $chatUser2 = new ChatUser("Jonibek", $chatroom);
    $chatUser3 = new ChatUser("Muhriddin", $chatroom);
    $users = [$chatUser1,$chatUser2,$chatUser3];
    foreach($users as $user){
        $chatroom->addUser($user);
    }
    // Users send messages
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
        $message = $_POST['message'];
        $chatUser2->sendMessage($message);
    }
    ?>

    <script>
        function updateChatMessages() {
            document.getElementById('chat-messages').innerHTML = `<?php echo $chatroom->getChatMessages(); ?>`;
        }

        // Update chat messages periodically
        setInterval(updateChatMessages, 1000);
    </script>
</body>
</html>
