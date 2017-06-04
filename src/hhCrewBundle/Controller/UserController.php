<?php

namespace hhCrewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User;

/**
 * User controller.
 *
 * @Route("/user")
 */

class UserController extends Controller
{
  /**
     * Lists all users
     *
     * @Route("/", name="user_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $producer = new User();
        $form = $this->createFormBuilder($user)
            ->setAction($this->generateUrl('user_index'))
            ->setMethod('POST')
            ->add('username', null, ['label' => 'Wyszukaj użytkownika'])
            ->getForm();
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if($form->isSubmitted() && $form->isValid()) {
            $username = $user->getUsername();
            $users = $em->getRepository('AppBundle:User')->findUserByName($username);
        } else {
            $users = $em->getRepository('AppBundle:User')->findAll();
        }
        return $this->render('user/index.html.twig', array(
            'users' => $users,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a user
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        return $this->render('user/show.html.twig', array(
            'user' => $user,
        ));
    }
}
