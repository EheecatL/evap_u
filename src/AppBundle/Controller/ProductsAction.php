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
    public function ArticlesListAction()
    {


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
    public function ResearchProducts(Request $request)
    {

        $research = $request->query->get('research');

        $repository = $this
            ->getDoctrine()
            ->getRepository(Products::class);
        $results = $repository->getProductContent($research);


        return $this->render("@App/pages/extendsresearchproducts.html.twig",
            [
                'results' => $results,
                'reserch' => $research
            ]

        );
    }

    /**
     * @Route("/info_products_clearomiseurs", name="info_products_clearomiseurs")
     */
    public function ProductClearomiseursAction(Request $request){

        $research = $request->query->get('category');

        $repository = $this
            ->getDoctrine()
            ->getRepository(Products::class);
        $results = $repository->getProductClearomiseursCategory($research);


        return $this->render("@App/pages/extendsproductsclearomiseurs.html.twig",
            [
                'product' => $results,
            ]

        );

    }

    /**
     * @Route("/info_products_mods", name="info_products_mods")
     */
    public function ProductModsAction(Request $request){

        $research = $request->query->get('category');

        $repository = $this
            ->getDoctrine()
            ->getRepository(Products::class);
        $results = $repository->getProductModsCategory($research);


        return $this->render("@App/pages/extendsproductsmods.html.twig",
            [
                'product' => $results,
            ]

        );

    }

    /**
     * @Route("/info_products_accessories", name="info_products_accessories")
     */
    public function ProductAccessoriesAction(Request $request){

        $research = $request->query->get('category');

        $repository = $this
            ->getDoctrine()
            ->getRepository(Products::class);
        $results = $repository->getProductAccessoriesCategory($research);


        return $this->render("@App/pages/extendsproductsaccessories.html.twig",
            [
                'product' => $results,
            ]

        );

    }
}