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
    public function LegalAction()
    {

        return $this->render('@App/pages/extendslegalnotices.html.twig');

    }

    /**
     * @Route("/privacypolicy", name="privacy_policy")
     */
    public function PrivacyAction()
    {

        return $this->render('@App/pages/extendsprivacypolicy.html.twig');

    }
}