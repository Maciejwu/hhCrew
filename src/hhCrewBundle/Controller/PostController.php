<?php

namespace hhCrewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Post;
use AppBundle\Entity\User;
use AppBundle\Entity\Comment;


/**
 *  controller.
 *
 * @Route("post")
 */
class PostController extends Controller
{

  /**
      * Lists all post entities.
      *
      * @Route("/", name="post_index")
      * @Method({"GET", "POST"})
      */
     public function indexAction(Request $request)
     {
         $post = new Post();
         $form = $this->createFormBuilder($post)
                 ->setAction($this->generateUrl('post_index'))
                 ->setMethod('POST')
                 ->add('nazwa', null, ['label' => 'Wyszukaj po mieście'])
                 ->getForm();

         $form->handleRequest($request);
         $em = $this->getDoctrine()->getManager();

         if ($form->isSubmitted() && $form->isValid()) {
             $city = $post->getCity();
             $posts = $em->getRepository('AppBundle:Post')->findPostByCity($city);
         } else {
             $posts = $em->getRepository('AppBundle:Post')->findAll();
         }

         return $this->render('post/index.html.twig', array(
             'posts' => $posts,
             'form' => $form->createView(),
         ));
     }

     /**
      * @Route("/user", name="post_user")
      * @Method("GET")
      */
     public function userPostAction()
     {
         $id = $this->container->get('security.context')->getToken()->getUser()->getId();
         $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy(array('user' => $id));
         return $this->render('post/user.html.twig', array(
             'posts' => $posts,
         ));
     }

     /**
      * Creates a new post entity.
      *
      * @Route("/new", name="post_new")
      * @Method({"GET", "POST"})
      */
     public function newAction(Request $request)
     {
         $post = new Post();
         $form = $this->createForm('AppBundle\Form\PostType', $post);
         $form->handleRequest($request);

         $user = $this->container->get('security.context')->getToken()->getUser();
         $post->setUser($user);
         if ($form->isSubmitted() && $form->isValid()) {
             $em = $this->getDoctrine()->getManager();
             $em->persist($post);
             $em->flush();
             return $this->redirectToRoute('post_user');
         }
         return $this->render('post/new.html.twig', array(
             'form' => $form->createView(),
         ));
     }
     /**
      * Finds and displays a post entity.
      *
      * @Route("/{id}", name="post_show")
      * @Method("GET")
      */
     public function showAction(Post $post)
     {
         $opinia = new Comment();
         $comment->setComment($comment);
         $commentForm = $this->createForm('AppBundle\Form\CommentType', $comment, array(
            'action' => $this->generateUrl('comment_new'),
             'method' => 'POST',
         ));

         return $this->render('comment/show.html.twig', array(
             'post' => $post,
             'comment_form' => $commentForm->createView(),
         ));
     }
     /**
      * Displays a form to edit an existing post.
      *
      * @Route("/{id}/edit", name="post_edit")
      * @Method({"GET", "POST"})
      */
     public function editAction(Request $request, Post $post)
     {
         $userId = $this->container->get('security.context')->getToken()->getUser()->getId();
         $userId = $post->getUser()->getId();
         $deleteForm = $this->createDeleteForm($post);
         $editForm = $this->createForm('AppBundle\Form\PostType', $post);
         $editForm->handleRequest($request);
         if ($editForm->isSubmitted() && $editForm->isValid()) {
             $this->getDoctrine()->getManager()->flush();
             return $this->redirectToRoute('post_user');
         }
         return $this->render('post/edit.html.twig', array(
             'post' => $post,
             'edit_form' => $editForm->createView(),
             'delete_form' => $deleteForm->createView(),
         ));
     }

     /**
      * Deletes a post entity.
      *
      * @Route("/{id}", name="post_delete")
      * @Method("DELETE")
      */
     public function deleteAction(Request $request, Post $post)
     {
         $form = $this->createDeleteForm($post);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $em = $this->getDoctrine()->getManager();
             $em->remove($post);
             $em->flush();
         }
         r
         eturn $this->redirectToRoute('post_user');
     }
     /**
      * Creates a form to delete a post entity.
      *
      * @param Post $post The post entity
      *
      * @return \Symfony\Component\Form\Form The form
      */
     private function createDeleteForm(Post $post)
     {
         return $this->createFormBuilder()
             ->setAction($this->generateUrl('post_delete', array('id' => $post->getId())))
             ->setMethod('DELETE')
             ->getForm()
         ;
     }

}
