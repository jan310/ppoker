<?php

class Page
{
    protected $model;
    protected $controller;
    
    public function __construct(PPokerActions $controller, PPokerData $model)
    {
        $this->controller = $controller;
        $this->model = $model;
    }
 
}
