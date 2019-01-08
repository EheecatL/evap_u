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

class FooterAction extends Controller

{
    /**
     * @Route("/legalnotices", name="legal_notices")
     */
    public function HomeAction()
    {

        return $this->render('@App/pages/extendslegalnotices.html.twig');

    }
}