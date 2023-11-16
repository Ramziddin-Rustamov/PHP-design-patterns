<?php

interface FormIterator {
    public function hasNext();
    public function next();
}

class ElementIterator implements FormIterator {
    private $elements;
    private $index;

    public function __construct(array $elements) {
        $this->elements = $elements;
        $this->index = 0;
    }

    public function hasNext() {
        return $this->index < count($this->elements);
    }

    public function next() {
        if ($this->hasNext()) {
            $element = $this->elements[$this->index];
            $this->index++;
            return $element;
        } else {
            return null;
        }
    }
}

interface FormAggregate {
    public function createIterator();
}

class Form implements FormAggregate {
    private $elements;

    public function __construct($elements) {
        $this->elements = $elements;
    }

    public function createIterator() {
        return new ElementIterator($this->elements);
    }
}

// Client code
$formElements = [
    "<input type='text' name='username' placeholder='Username' />",
    "<input type='password' name='password' placeholder='Password' />",
    "<button type='submit'>Submit</button>"
];

$form = new Form($formElements);
$iterator = $form->createIterator();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iterator Pattern Example</title>
</head>
<body>

    <form>
        <?php
        while ($iterator->hasNext()) {
            echo $iterator->next() . "<br>";
        }
        ?>
    </form>

</body>
</html>
