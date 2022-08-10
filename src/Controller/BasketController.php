<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class BasketController extends AbstractController
{

    /**
     * @Route("/basket", name="app_basketd")
     */
    public function basket(ManagerRegistry $doctrine,ProductRepository $productRepository): Response
    {       
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $( document ).ready(function() {
                var cookieDegeri = $.cookie("ids");
                //console.log(cookieDegeri);
            });
        </script> <?php
        //setcookie("ids",0);
        //dd($_COOKIE["ids"]);
        
        if( isset($_COOKIE["ids"]) ){
            $ids = $_COOKIE["ids"];
            $basket = $productRepository->allBasketId($ids);
            //print_r($basket[0]);
            //dd($basket[0]);
            return $this->render('basket/basket.html.twig', [
                'basket'=>$basket
            ]);
           
        }else{
            $basket = "sepet boş";
            return $this->render('basket/basket.html.twig', [
                'basket'=>$basket
            ]);
        }
        
        //$basket = $productRepository->allBasketId($ids);

        
    }

    /**
     * @Route("/basket/{id}", name="app_basket")
     */
    
    public function addBasket(int $id): Response
    {
       //$basket = [];
       //array_push( $basket,$id );
       
       return $this->json([
        'basket' => $id
       ]);
    }
}


