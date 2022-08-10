<?php

namespace App\Service;

use App\Controller\BasketController;

class BasketService
{
    private $basketController;

    public function __construct(BasketController $basketController)
    {
        $this->basketController = $basketController;
    }

    public function addBasketService(int $id){
        $basket = [];
        array_push( $basket , $id );
        return $basket;
    }
}