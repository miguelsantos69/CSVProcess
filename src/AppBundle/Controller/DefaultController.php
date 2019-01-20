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
         
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Produkty')->createQueryBuilder('bp');
        if ($request->query->getAlnum('filter')) {
            $queryBuilder->where('bp.kodProduktu LIKE :kodProduktu')
                ->setParameter('kodProduktu', '%' . $request->query->getAlnum('filter') . '%');
        }
        
        $query = $queryBuilder->getQuery();
        
        $paginator  = $this->get('knp_paginator');
        $products = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 10)/*limit per page*/
        );


        return $this->render('default/produkty.html.twig', [
           'products' => $products,
        ]);
    }
}
