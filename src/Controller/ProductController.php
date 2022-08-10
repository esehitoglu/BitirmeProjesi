<?php

// src/Controller/ProductController.php
namespace App\Controller;

// ...

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="create_product")
     */
    public function product(ManagerRegistry $doctrine): Response
    {
        $productRepository = $doctrine->getRepository(Product::class);
        $products = $productRepository->findAll();

        $categoryRepository = $doctrine->getRepository(Category::class);
        $category = $categoryRepository->findAll();

        /*
        $userFirstName = 'Ensar';
        $userNotifications = [
        	array('name'=>'Twig syntax', 'date'=>'1992'),
        	array('name'=>'Sublime 3', 'date'=>'2022')
        ]; */

        // the template path is the relative file path from `templates/user/notifications.html.twig`
        return $this->render('product/product.html.twig', [
            //'user_first_name' => $userFirstName,
            'products' => $products,
            'category' => $category
        ]);
    

    }


    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show(ManagerRegistry $doctrine,ProductRepository $productRepository, int $id): Response
    {
        //$productCategory = $doctrine->getRepository(Category::class)->find($id);
        $categoryRepository = $doctrine->getRepository(Category::class);
        $category = $categoryRepository->findAll();
        
        $product_category = $productRepository->productCategory($id);

        return $this->render('product/productCategory.html.twig', [
            //'user_first_name' => $userFirstName,
            'product_category' => $product_category,
            'category' => $category
        ]);

        //return new Response('Check out this great product: '.$productCategory->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/productn/{id}", name="product_show2")
     */
    public function show2(Product $product): Response
    {
        return new Response('Check out this great product: '.$product->getProductName());
    }
}