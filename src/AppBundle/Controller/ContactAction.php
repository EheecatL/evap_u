<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 2019-01-09
 * Time: 12:50
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use AppBundle\Entity\Contact;



class ContactAction extends Controller
{

    /**
     * @Route("/contact", name="contact")
     */
    public function createAction(Request $request)
    {
        $contact = new Contact;

        $form = $this
            ->createFormBuilder($contact)
            ->add('name', TextType::class, array('label' => 'Nom', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('email', TextType::class, array('label' => 'Votre email', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('subject', TextType::class, array('label' => 'Objet', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('message', TextareaType::class, array('label' => 'Votre message', 'attr' => array('class' => 'form-control')))
            ->add('Save', SubmitType::class, array('label' => 'Envoyer', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))
            ->getForm();


        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()) {
            $name = $form['name']->getData();
            $email = $form['email']->getData();
            $subject = $form['subject']->getData();
            $message = $form['message']->getData();

            # set form data

            $contact->setName($name);
            $contact->setEmail($email);
            $contact->setSubject($subject);
            $contact->setMessage($message);

            # finally add data in database

            $sn = $this->getDoctrine()->getManager();
            $sn->persist($contact);
            $sn->flush();
            $this->addFlash("notice", "Votre message a bien été envoyé");

            return $this->redirect($request->getUri());

        }

        return $this->render(
            "@App/pages/extendscontact.html.twig",
            [
                'formContact' => $form->createView()
            ]
        );
}}