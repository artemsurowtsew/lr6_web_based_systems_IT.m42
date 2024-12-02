<?php 


abstract class BookPrototype {     protected $title;     

protected $topic;     

abstract function __clone();     function getTitle() {         return $this->title; 

    } 

    function setTitle($titleIn) { 

        $this->title = $titleIn; 

    } 

    function getTopic() {         return $this->topic; 

    } 

} 


class PHPBookPrototype extends BookPrototype { 

    function __construct() { 

        $this->topic = 'PHP'; 

    } 

    function __clone() { 

    } 

} 


class SQLBookPrototype extends BookPrototype { 

    function __construct() { 

        $this->topic = 'SQL'; 

    } 

    function __clone() { 

    } 

} 

  

  

  $phpProto = new PHPBookPrototype(); 

  $sqlProto = new SQLBookPrototype(); 


  $book1 = clone $sqlProto; 

  $book1->setTitle('SQL For Cats'); 


  $book2 = clone $phpProto; 

  $book2->setTitle('OReilly Learning PHP 5');  
  echo ("view text")

?> 

