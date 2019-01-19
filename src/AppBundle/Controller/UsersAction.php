<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 2019-01-19
 * Time: 14:54
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsersAction extends Controller
{
    /**
     * @Route("/admin/deluser/{id}", name="del_user")
     */
    public function DelArticleAction(Request $request,$id)
    {

        $request->query->get('deleteArticle');
        $repository = $this
            ->getDoctrine()
            ->getRepository(User::class);


        $entityManager= $this
            ->getDoctrine()
            ->getManager();

        $article=$repository->find($id);

        $entityManager->remove($article);
        $entityManager->flush();
        $this->addFlash("notice", "L'utilisateur a été supprimé");

        return $this->redirectToRoute('admin_users');

    }

    /**
     * @Route("/adminusers", name="admin_users")
     */
    public function ArticlesListAction(){


        $repository = $this
            ->getDoctrine()
            ->getRepository(User::class);
        $users = $repository->findAll();

        return $this->render('@App/pages/extendsadminusers.html.twig',
            [
                'users' => $users
            ]
        );

    }
}