<!DOCTYPE html>
<html>
<head>
    <title>TV Remote Control</title>
</head>
<body>
    <h1>TV Remote Control</h1>
    <form method="post">
        <input type="submit" name="powerButton" value="Turn On">
        <input type="submit" name="volumeUpButton" value="Volume Up">
        <input type="submit" name="volumeDownButton" value="Volume Down">
    </form>

    <div id="tvStatus">
        <?php
        // Command Interface
        interface Command {
            public function execute();
        }
        // Concrete Commands
        class PowerOnCommand implements Command {
            private $tv;

            public function __construct(TV $tv) {
                $this->tv = $tv;
            }

            public function execute() {
                $this->tv->turnOn();
            }
        }

        class VolumeUpCommand implements Command {
            private $tv;

            public function __construct(TV $tv) {
                $this->tv = $tv;
            }

            public function execute() {
                $this->tv->volumeUp();
            }
        }

        class VolumeDownCommand implements Command {
            private $tv;

            public function __construct(TV $tv) {
                $this->tv = $tv;
            }

            public function execute() {
                $this->tv->volumeDown();
            }
        }

             // Receiver
             class TV {
                public function turnOn() {
                    echo "TV is on.";
                }
    
                public function volumeUp() {
                    echo "Volume increased.";
                }
    
                public function volumeDown() {
                    echo "Volume decreased.";
                }
            }

        // Invoker
        class RemoteControl {
            private $command;

            public function setCommand(Command $command) {
                $this->command = $command;
            }

            public function pressButton() {
                $this->command->execute();
            }
        }

        // TV and RemoteControl setup
        $tv = new TV();
        $remoteControl = new RemoteControl();

        if (isset($_POST['powerButton'])) {
            $command = new PowerOnCommand($tv);
            $remoteControl->setCommand($command);
            $remoteControl->pressButton();
        } elseif (isset($_POST['volumeUpButton'])) {
            $command = new VolumeUpCommand($tv);
            $remoteControl->setCommand($command);
            $remoteControl->pressButton();
        } elseif (isset($_POST['volumeDownButton'])) {
            $command = new VolumeDownCommand($tv);
            $remoteControl->setCommand($command);
            $remoteControl->pressButton();
        }
        ?>
    </div>
    </body>
</html>
