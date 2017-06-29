<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\RouteRedirectView;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class BlogPostsController
 * @package AppBundle\Controller
 *
 * @RouteResource("post")
 */
class PostController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @Rest\View()
     */
    public function cgetAction()
    {
        return $this->getBlogPostRepository()->createFindAllQuery()->getResult();
    }



    public function getAction(int $id)
    {
        $blogPost = $this->getBlogPostRepository()->createFindOneByIdQuery($id)->getSingleResult();

        if ($blogPost === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        return $blogPost;
    }


    /**
     * @return PostRepository
     */
    private function getBlogPostRepository()
    {
        return $this->get('crv.doctrine_entity_repository.blog_post');
    }
}