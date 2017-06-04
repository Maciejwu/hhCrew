<?php

namespace hhCrewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Message;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Message controller.
 *
 * @Route("message")
 */

class MessageController extends Controller
{
  /**
 *
 * @Route("/odebrane", name="messages_odebrane")
 * @Method("GET")
 */
public function odebraneAction()
{
    $em = $this->getDoctrine()->getManager();
    $id = $this->container->get('security.context')->getToken()->getUser()->getId();
    $messages = $em->getRepository('AppBundle:Message')->findByOdbiorca($id);
    return $this->render('message/odebrane.html.twig', array(
        'messages' => $messages,
    ));
}

/**
 *
 * @Route("/wyslane", name="message_wyslane")
 * @Method("GET")
 */
public function wyslaneAction()
{
    $em = $this->getDoctrine()->getManager();
    $id = $this->container->get('security.context')->getToken()->getUser()->getId();
    $messages = $em->getRepository('AppBundle:Message')->findByNadawca($id);
    return $this->render('message/wyslane.html.twig', array(
        'messages' => $messages,
    ));
}
/**
 * Creates a new message entity.
 *
 * @Route("/new/{id}", name="message_new")
 * @Method({"GET", "POST"})
 */

public function newAction(Request $request, User $user)
{
    $message = new Wiadomosc();
    $message->setOdbiorca($user);
    $nadawca = $this->container->get('security.context')->getToken()->getUser();
    $message->setNadawca($nadawca);
    $form = $this->createForm('AppBundle\Form\MessageType', $message);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();
        return $this->redirectToRoute('message_odebrane', array('id' => $message->getId()));
    }
    return $this->render('message/new.html.twig', array(
        'message' => $message,
        'form' => $form->createView(),
    ));
}
/**
 * Finds and displays a message entity.
 *
 * @Route("/{id}", name="message_show")
 * @Method("GET")
 */
public function showAction(Message $message)
{
    $deleteForm = $this->createDeleteForm($message);
    $loggedUserId = $this->container->get('security.context')->getToken()->getUser()->getId();
    $nadawcaId = $message->getNadawca()->getId();
    if($loggedUserId === $nadawcaId) {
        $role = 'nadawca';
    } else {
        $role = 'odbiorca';
    }

    return $this->render('message/show.html.twig', array(
        'role' => $role,
        'message' => $message,
        'delete_form' => $deleteForm->createView(),
    ));
}
/**
 * Deletes a message entity.
 *
 * @Route("/{id}", name="message_delete")
 * @Method("DELETE")
 */
public function deleteAction(Request $request, Message $message)
{
    $form = $this->createDeleteForm($message);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($message);
        $em->flush();
    }
    return $this->redirectToRoute('message_odebrane');
}
/**
 * Creates a form to delete a message entity.
 *
 * @param Message $message The message entity
 *
 * @return \Symfony\Component\Form\Form The form
 */
private function createDeleteForm(Message $message)
{
    return $this->createFormBuilder()
        ->setAction($this->generateUrl('message_delete', array('id' => $message->getId())))
        ->setMethod('DELETE')
        ->getForm()
    ;
}
}
