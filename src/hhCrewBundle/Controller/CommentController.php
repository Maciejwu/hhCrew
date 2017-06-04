<?php

namespace hhCrewBundle\Controller;

use AppBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * comment controller.
 *
 * @Route("comment")
 */

class CommentController extends Controller
{
  /**
    * Creates a new comment entity.
    *
    * @Route("/new", name="comment_new")
    * @Method({"POST"})
    */
   public function newAction(Request $request)
   {
       $comment = new comment();
       $form = $this->createForm('AppBundle\Form\CommentType', $comment);
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $user = $this->container->get('security.context')->getToken()->getUser();
           $comment->setUser($user);
           $em->persist($comment);
           $em->flush();
           return $this->redirectToRoute('post_show', array('id' => $comment->getPost()->getId()));
       }
   }
}
