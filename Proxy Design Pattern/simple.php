<?php

interface GiftReceiver {
    public function receiveGift();
} 

class Child implements GiftReceiver{

    private $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function receiveGift()
    {
        $this->name."received a gift !";
    }


}

class GiftProxy implements GiftReceiver{

  private $child;
  public $allowedChildren  = [
        'Child1', 'Child2', 'Child3', 'Child4', 'Child5',
        'Child6', 'Child7', 'Child8', 'Child9', 'Child10',
        'Child11', 'Child12', 'Child13', 'Child14', 'Child15'
  ];

  public function __construct($childName)
  {
    if(in_array($childName,$this->allowedChildren)){
        $this->child = new Child($childName);
    } else {
        throw new Exception("Child not allowed to receive gifts.");
    }
  }


  public function receiveGift() {
    $this->child->receiveGift();
  }

}

try {
    $child1 = new GiftProxy('Child1');
    $child2 = new GiftProxy('Child2');
    $child20 = new GiftProxy('Child20');


    $child1->receiveGift();
    $child5->receiveGift();
    $child20->receiveGift();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}