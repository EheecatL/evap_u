<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 2018-12-03
 * Time: 10:45
 */

namespace AppBundle\Controller;



use AppBundle\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductsAction extends Controller
{

    /**
     * @Route("/products", name="products")
     */
    public function ArticlesListAction(){


        $repository = $this
            ->getDoctrine()
            ->getRepository(Products::class);
        $products = $repository->findAll();

        return $this->render("@App/pages/extendsproducts.html.twig",
            [
                'products' => $products
            ]
        );

    }

    /**
     * @Route("/research/products", name="research_products")
     */
    public function ResearchArticles(Request $request){

        $research=$request->query->get('research');

        $repository = $this
            ->getDoctrine()
            ->getRepository(Products::class);
        $results = $repository->getProductContent($research);




        return $this->render("@App/pages/extendsresearchproducts.html.twig",
            [
                'results'=>$results,
                'reserch'=>$research
            ]

        );
    }

    /**
     * @Route("/info_products/{id}", name="info_products")
     */
    public function ArticleAction($id){

        $repository = $this
            ->getDoctrine()
            ->getRepository(Products::class);

        $articles = $repository->find($id);

        return $this->render("@App/pages/extendsproduct.html.twig",
            [
                'article' => $articles
            ]
        );
    }

}