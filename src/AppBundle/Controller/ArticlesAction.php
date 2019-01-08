<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 2018-12-03
 * Time: 10:45
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesAction extends Controller
{
    /**
     * @Route("/articles", name="articles")
     */
    public function ArticlesListAction(){


        $repository = $this
            ->getDoctrine()
            ->getRepository(Articles::class);
        $articles = $repository->findAll();

        return $this->render("@App/pages/extendsarticles.html.twig",
            [
                'articles' => $articles
            ]
        );

    }

    /**
     * @Route("/research/articles", name="research_articles")
     */
    public function ResearchArticles(Request $request){

        $research=$request->query->get('research');

        $repository = $this
            ->getDoctrine()
            ->getRepository(Articles::class);
        $results = $repository->getArticleContent($research);




        return $this->render("@App/pages/extendsresearcharticles.html.twig",
            [
                'results'=>$results,
                'reserch'=>$research
            ]

        );
    }

    /**
     * @Route("/info_article/{id}", name="info_article")
     */
    public function ArticleAction($id){

        $repository = $this
            ->getDoctrine()
            ->getRepository(Articles::class);

        $articles = $repository->find($id);

        return $this->render("@App/pages/extendsarticle.html.twig",
            [
                'article' => $articles
            ]
        );
    }
}