<?php
interface Observer {
    public function update($data);
}

class Subject {
    private $observer = [];

    public function attach(Observer $observer)
    {
        $this->observer[] = $observer;
    }

    public function detach(Observer $observer){
        $key = array_search($observer , $this->observer, true);
        if($key != false){
            unset($this->observer[$key]);
        }
    }

    public function notify($data){
        foreach($this->observer as $observer){
            $observer->update($data);
        }
    }

}

class RealObserver implements Observer{

    private $fname;
    private $surname;

    public function __construct($name , $surname)
    {
        $this->fname = $name;
        $this->surname = $surname;
    }
    public function update($data){
        echo "{$this->fname} {$this->surname}  accepted {$data} ... ";
    }
}

$subject = new Subject();

$ramziddin = new RealObserver("Ramziddin","Rustamov");
$khusan = new RealObserver("Khusan","Khukumov");

$subject->attach($ramziddin);
$subject->attach($khusan);

$subject->notify("Hi everyone welcome to our new crash course !");