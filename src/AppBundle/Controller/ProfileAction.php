<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 2018-12-03
 * Time: 10:46
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Products;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ProfileAction extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function LegalAction()
    {

        $repository = $this
            ->getDoctrine()
            ->getRepository(User::class);
        $users = $repository->findAll();

        $repo = $this
            ->getDoctrine()
            ->getRepository(Products::class);
        $products = $repo->findAll();



        return $this->render('@App/pages/extendsprofile.html.twig',
            [
                'users' => $users,
                'products' => $products
            ]);

    }
}