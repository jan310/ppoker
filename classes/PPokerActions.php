<?php
class PPokerActions
{
    private $model;
 
    public function __construct(PPokerData $model) {
        $this->model = $model;
    }

    function __call($name, $values){
        //TODO: Fehlermeldung
    }
   
}


