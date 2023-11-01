<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

interface Command{
    public function exucute();
}

class MoveForwardCommand implements Command {
     public function exucute()
     {
        echo "Car moving forward !";
     }
}


class MoveBackCommand implements Command {
    public function exucute()
    {
        echo "Car is moving back ";
    }
}

class StopCommand implements Command {
    public function exucute()
    {
        echo "Car stopped !";
    }
}

// Remote Control

class RemoteControl {
    private $command;

    public function setControl(Command $command)
    {
        $this->command = $command;
    }

    public function pressButton(){
        $this->command->exucute();
    }
}

class ToyCar {
    public function moveForward(){
        echo "Toy car moving forward !";
    }
    public function movingBack(){
        echo "Toy car is going  backward !";
    }
}


//  Now, let's use the Command Pattern 
// with the toy car and remote control:

$toyCar = new ToyCar();
$remoteControl = new RemoteControl();

$moveForwardCommand = new MoveForwardCommand();
$moveBackwordCommand = new MoveBackCommand();
$stopCar = new StopCommand();

$remoteControl->setControl($moveForwardCommand);
$remoteControl->pressButton();

$remoteControl->setControl($moveBackwordCommand);
$remoteControl->pressButton();

$remoteControl->setControl($stopCar);
$remoteControl->pressButton();

?>
</body>
</html>





