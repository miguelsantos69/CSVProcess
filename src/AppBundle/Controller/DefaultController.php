<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Produkty;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        return $this->render('default/index.html.twig');
    }
    
     /**
     * @Route("/produkty", name="produkty")
     */
    public function lista(Request $request) {
        
        $productsQuery = $this->getDoctrine()->getRepository(Produkty::class)->findAll();
        
        $paginator = $this->get('knp_paginator');
        $products = $paginator->paginate(
                $productsQuery, 
                $request->query->getInt('page', 1)/* page number */, 100/* limit per page */
        );

        return $this->render('default/produkty.html.twig', [
           'products' => $products,
        ]);
    }
}
