<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    /**
     * @Route("/orders", name="app_orders")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        /*
        $entityManager = $doctrine->getManager();

        $order = new Order();
        $order->setAdres('Ergonomic and stylish!');
        $order->setPaymentMethod(1999);
        $order->setAmount(1000);

        // tell Doctrine you want to (eventually) save the order (no queries yet)
        $entityManager->persist($order);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        */
        return $this->render('orders/orders.html.twig', [
            'controller_name' => 'OrdersController',
        ]);
    }

    /**
     * @Route("/payment_success", name="payment_success")
     */
    public function payment_success(ManagerRegistry $doctrine): Response
    {
        if( isset($_COOKIE["ammount"]) ){
            $ammount = $_COOKIE["ammount"];
            
        }
        if( isset($_COOKIE["address"]) ){
            $address = $_COOKIE["address"];
        }
        if( isset($_COOKIE["odeme_yontemi"]) ){
            $odeme_yontemi = $_COOKIE["odeme_yontemi"];
        }
        if( isset($_COOKIE["orders"]) ){
            $orders = $_COOKIE["orders"];
        }
        
        //dd($orders);
        
        $entityManager = $doctrine->getManager();

        $order = new Order();
        $order->setAdres($address);
        $order->setPaymentMethod($odeme_yontemi);
        $order->setAmount($ammount);
        $order->setOrders($orders);
        
        // tell Doctrine you want to (eventually) save the order (no queries yet)
        $entityManager->persist($order);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    
        return $this->render('orders/payment_success.html.twig', [
            'controller_name' => 'OrdersController',
        ]);
    }
}
