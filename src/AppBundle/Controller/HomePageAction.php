<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 2018-12-03
 * Time: 10:11
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomePageAction extends Controller

{
    /**
     * @Route("/", name="homepage")
     */
    public function HomeAction()
    {

        return $this->render('@App/pages/extendshomepage.html.twig');

    }

    /**
     * @Route("/connection", name="connection")
     */
    public function ConnectionAction()
    {

        return $this->render('@App/pages/extendsconnection.html.twig');

    }

    public function getParent()
    {

        return 'FOSUserBundle';

    }

}

