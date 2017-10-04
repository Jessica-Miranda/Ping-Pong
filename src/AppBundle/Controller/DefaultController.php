<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
Symfony\Component\HttpFoundation\Request,
Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
Sensio\Bundle\FrameworkExtraBundle\Configuration\Security,
Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class DefaultController extends Controller
{
    /**
    * @Route("/", name="homepage")
    * @Template
    */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $torneos = $em->getRepository('AppBundle:Torneo')->findAll();

        return ['torneos' => $torneos];
    }

    /**
    * @Route("/changeAvatar", name="changeAvatar")
    * @Template
    */
    public function changeAvatarAction(Request $request)
    {
        $form = $this->createFormBuilder([])
        ->add('avatar', FileType::class)
        ->add('save', SubmitType::class, ['label' => 'Cambiar', 'attr' => ["class" => "btn bg-teal waves-effect"]])
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            /**
            * @var UploadedFile
            */
            $file = $form->getData()['avatar'];
            // Generate a unique name for the file before saving it
           $fileName = md5(uniqid()).'.'.$file->guessExtension();

           // Move the file to the directory where brochures are stored
           $file->move(
               $this->getParameter('avatar_directory'),
               $fileName
           );

           $currentAvatar = $user->getAvatar();

           if ($currentAvatar) {
               try {
                   $currentPath = $this->getParameter('avatar_directory') .'/'. $currentAvatar;
                   unlink($currentPath);
               } catch (Exception $e) {
               }
           }


           $user->setAvatar($fileName);
           $this->getDoctrine()->getManager()->flush();

           return $this->redirectToRoute('homepage');
        }

        return [
            'form' => $form->createView()
        ];
    }
}
