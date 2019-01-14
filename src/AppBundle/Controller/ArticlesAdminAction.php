<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 2018-12-03
 * Time: 12:06
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Articles;
use AppBundle\Form\ArticlesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesAdminAction extends Controller

{
    /**
     * @Route("/admin/newarticle", name="new_article")
     */
    public function FormArticleAction(Request $request)
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var UploadedFile $image
             */
            $image = $article->getImage();

            $imageName = md5(uniqid()).'.'.$image->guessExtension();

            try {
                $image->move(
                    $this->getParameter('upload_img_dir'),
                    $imageName
                );
            } catch (FileException $e) {
                echo $e->getMessage();
            }

            $article->setImage($imageName);


            $entityManager = $this->getDoctrine()->getManager();


            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash("notice", "L'article a été ajouté");

            return $this->redirectToRoute("admin_articles");
        }

        return $this->render(
            "@App/pages/extendsnewarticle.html.twig",
            [
                'formArticle' => $form->createView(),
                'article' => $article
            ]
        );
    }

    /**
     * @Route("/admin/delarticle/{id}", name="del_article")
     */
    public function DelArticleAction(Request $request,$id)
    {

        $request->query->get('deleteArticle');
        $repository = $this
            ->getDoctrine()
            ->getRepository(Articles::class);


        $entityManager= $this
            ->getDoctrine()
            ->getManager();

        $article=$repository->find($id);

        $entityManager->remove($article);
        $entityManager->flush();
        $this->addFlash("notice", "L'article a été supprimé");

        return $this->redirectToRoute('admin_articles');

    }

    /**
     * @Route("/admin/updatearticle/{id}", name="update_article")
     */

    public function UpdateArticleAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Articles::class);
        $article = $repository->find($id);
        $form = $this->createForm(ArticlesType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){

            /**
             * @var UploadedFile $image
             */
            $image = $article->getImage();

            $imageName = md5(uniqid()).'.'.$image->guessExtension();

            try {
                $image->move(
                    $this->getParameter('upload_img_dir'),
                    $imageName
                );
            } catch (FileException $e) {

            }

            $article->setImage($imageName);

            $article = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();


            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash("notice", "L'article a été mis à jour");

            return $this->redirectToRoute("admin_articles");
        }

        return $this->render(
            "@App/pages/extendsnewarticle.html.twig",
            [
                'formArticle'=>$form->createView(),
                'article' => $article

            ]
        );
    }

    /**
     * @Route("/adminarticles", name="admin_articles")
     */
    public function ArticlesListAction(){


        $repository = $this
            ->getDoctrine()
            ->getRepository(Articles::class);
        $articles = $repository->findAll();

        return $this->render('@App/pages/extendsadminarticles.html.twig',
            [
                'articles' => $articles
            ]
        );

    }

}
