<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 2018-12-03
 * Time: 10:46
 */

namespace AppBundle\Controller;


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

        return $this->render('@App/pages/extendsprofile.html.twig');
    }
}