<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 2018-12-03
 * Time: 10:47
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Products;
use AppBundle\Form\ProductsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductsAdminAction extends Controller
{
    /**
     * @Route("/admin/newproduct", name="new_product")
     */
    public function FormProductAction(Request $request)
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var UploadedFile $image
             */
            $image = $product->getImage();

            $imageName = md5(uniqid()).'.'.$image->guessExtension();

            try {
                $image->move(
                    $this->getParameter('upload_img_dir'),
                    $imageName
                );
            } catch (FileException $e) {
                echo $e->getMessage();
            }

            $product->setImage($imageName);


            $entityManager = $this->getDoctrine()->getManager();


            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash("notice", "Le produit a été ajouté");

            return $this->redirectToRoute("admin_products");
        }

        return $this->render(
            "@App/pages/extendsnewproduct.html.twig",
            [
                'formProduct' => $form->createView(),
                'product' => $product
            ]
        );
    }

    /**
     * @Route("/admin/delproduct/{id}", name="del_product")
     */
    public function DelProductAction(Request $request,$id)
    {

        $request->query->get('deleteProduct');
        $repository = $this
            ->getDoctrine()
            ->getRepository(Products::class);


        $entityManager= $this
            ->getDoctrine()
            ->getManager();

        $product=$repository->find($id);

        $entityManager->remove($product);
        $entityManager->flush();
        $this->addFlash("notice", "Le produit a été supprimé");

        return $this->redirectToRoute('admin_products');

    }

    /**
     * @Route("/admin/updateproduct/{id}", name="update_product")
     */

    public function UpdateProductAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Products::class);
        $product = $repository->find($id);
        $form = $this->createForm(ProductsType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){

            /**
             * @var UploadedFile $image
             */
            $image = $product->getImage();

            $imageName = md5(uniqid()).'.'.$image->guessExtension();

            try {
                $image->move(
                    $this->getParameter('upload_img_dir'),
                    $imageName
                );
            } catch (FileException $e) {

            }

            $product->setImage($imageName);

            $product = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();


            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash("notice", "Le produit a été mis à jour");

            return $this->redirectToRoute("admin_products");
        }

        return $this->render(
            "@App/pages/extendsnewproduct.html.twig",
            [
                'formProduct'=>$form->createView(),
                'product' => $product

            ]
        );
    }

    /**
     * @Route("/adminproducts", name="admin_products")
     */
    public function ProductsListAction(){


        $repository = $this
            ->getDoctrine()
            ->getRepository(Products::class);
        $products = $repository->findAll();

        return $this->render('@App/pages/extendsadminproducts.html.twig',
            [
                'products' => $products
            ]
        );

    }
}