<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Security,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Usuario,
    AppBundle\Form\AdminUsuarioType;
/**
 * Class UsuarioController
 * @package AppBundle\Controller
 * @Security("has_role('ROLE_SUPER_ADMIN')")
 */
class UsuarioController extends Controller
{
    /**
     * @Route("/usuario/lista", name="lista_usuario")
     * @Template
     *
     * @return array
     */
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return [
            'usuarios' => $users
        ];
    }
    /**
     * @Route("/usuario/crear", name="crear_usuario")
     * @Template
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function crearAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $usuario = $userManager->createUser();
        $form = $this->createForm(
            AdminUsuarioType::class,
            $usuario
        );
        $form->handleRequest($request);
        if ($form->isValid()) {
            $userManager->updateUser($usuario);
            return $this->redirect(
                $this->generateUrl('lista_usuario')
            );
        }
        return [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ];
    }
    /**
     * @Route("/usuario/{id}/editar", name="editar_usuario")
     * @Template
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param $id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editarAction(Request $request, $id)
    {
        $userManager = $this->get('fos_user.user_manager');
        $usuario = $userManager->findUserBy(
            [
                'id' => $id,
            ]
        );
        $form = $this->createForm(
            AdminUsuarioType::class,
            $usuario
        );
        $form->handleRequest($request);
        if ($form->isValid()) {
            $userManager->updateUser($usuario);
            return $this->redirect(
                $this->generateUrl('lista_usuario')
            );
        }
        return [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ];
    }
}
