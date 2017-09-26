<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Torneo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
* Torneo controller.
*
* @Route("torneo_admin")
*/
class TorneoController extends Controller
{
    /**
    * Creates a new torneo entity.
    *
    * @Route("/users/{id}", name="torneo_admin_users")
    * @ParamConverter("torneo", class="AppBundle\Entity\Torneo")
    * @Method({"GET", "POST"})
    */
    public function usersAction(Request $request, Torneo $torneo)
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        $form = $this->createFormBuilder([])
        ->add('users', ChoiceType::class, [
            'choices' => $users,
            'multiple' => true,
            'choice_label' => function($users, $key, $index) {
                return strtoupper($users->getNombreImpresion());
            },
        ])
        ->add('save', SubmitType::class)
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $arrUsers = $form->getData()['users'];
            $numeroDeUsuarios = count($arrUsers);
            if ($numeroDeUsuarios%2==0) {


                $fechaInicio = $torneo->getFechaInicio();
                $fechaFin = $torneo->getFechaFin();

                return $this->redirectToRoute('torneo_admin_index');
            }

        }

        return $this->render('torneo/users.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
    * Lists all torneo entities.
    *
    * @Route("/", name="torneo_admin_index")
    * @Method("GET")
    */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $torneos = $em->getRepository('AppBundle:Torneo')->findAll();

        return $this->render('torneo/index.html.twig', array(
            'torneos' => $torneos,
        ));
    }

    /**
    * Creates a new torneo entity.
    *
    * @Route("/new", name="torneo_admin_new")
    * @Method({"GET", "POST"})
    */
    public function newAction(Request $request)
    {
        $torneo = new Torneo();
        $form = $this->createForm('AppBundle\Form\TorneoType', $torneo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($torneo);
            $em->flush();

            return $this->redirectToRoute('torneo_admin_show', array('id' => $torneo->getId()));
        }

        return $this->render('torneo/new.html.twig', array(
            'torneo' => $torneo,
            'form' => $form->createView(),
        ));
    }

    /**
    * Finds and displays a torneo entity.
    *
    * @Route("/{id}", name="torneo_admin_show")
    * @Method("GET")
    */
    public function showAction(Torneo $torneo)
    {
        $deleteForm = $this->createDeleteForm($torneo);

        return $this->render('torneo/show.html.twig', array(
            'torneo' => $torneo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Displays a form to edit an existing torneo entity.
    *
    * @Route("/{id}/edit", name="torneo_admin_edit")
    * @Method({"GET", "POST"})
    */
    public function editAction(Request $request, Torneo $torneo)
    {
        $deleteForm = $this->createDeleteForm($torneo);
        $editForm = $this->createForm('AppBundle\Form\TorneoType', $torneo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('torneo_admin_edit', array('id' => $torneo->getId()));
        }

        return $this->render('torneo/edit.html.twig', array(
            'torneo' => $torneo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Deletes a torneo entity.
    *
    * @Route("/{id}", name="torneo_admin_delete")
    * @Method("DELETE")
    */
    public function deleteAction(Request $request, Torneo $torneo)
    {
        $form = $this->createDeleteForm($torneo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($torneo);
            $em->flush();
        }

        return $this->redirectToRoute('torneo_admin_index');
    }

    /**
    * Creates a form to delete a torneo entity.
    *
    * @param Torneo $torneo The torneo entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createDeleteForm(Torneo $torneo)
    {
        return $this->createFormBuilder()
        ->setAction($this->generateUrl('torneo_admin_delete', array('id' => $torneo->getId())))
        ->setMethod('DELETE')
        ->getForm()
        ;
    }
}
