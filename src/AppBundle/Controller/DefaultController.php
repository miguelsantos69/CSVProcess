<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Historia;
use AppBundle\Entity\Produkty;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {


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

        $paginator = $this->get('knp_paginator');
        $products = $paginator->paginate(
                $query, $request->query->getInt('page', 1), $request->query->getInt('limit', 100)
        );

        return $this->render('default/produkty.html.twig', [
                    'products' => $products,
        ]);
    }

    /**
     * @Route("/ostatni_import", name="ostatni_import")
     */
    public function ostatniImport() {

        $em = $this->getDoctrine()->getManager();
        $ostatni = $em->getRepository('AppBundle\Entity\Historia')
                ->findOneBy([], 
                            ['id' => 'DESC']);
        
        return $this->render('default/ostatniimport.html.twig', [
                    'ostatni' => $ostatni,
        ]);
    }

}
