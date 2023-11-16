<?php

interface MyIterator {
    public function hasNext();
    public function next();
}

class ConcreteIterator implements MyIterator {
    private $collection;
    private $index;

    public function __construct($collection) {
        $this->collection = $collection;
        $this->index = 0;
    }

    public function hasNext() {
        return $this->index < count($this->collection);
    }

    public function next() {
        if ($this->hasNext()) {
            $item = $this->collection[$this->index];
            $this->index++;
            return $item;
        } else {
            return null;
        }
    }
}

interface MyAggregate {
    public function createIterator();
}

class ConcreteAggregate implements MyAggregate {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function createIterator() {
        return new ConcreteIterator($this->data);
    }
}

$data = [1, 2, 3, 4, 5];
$aggregate = new ConcreteAggregate($data);
$iterator = $aggregate->createIterator();

while ($iterator->hasNext()) {
    echo $iterator->next() . "\n";
}
?>
