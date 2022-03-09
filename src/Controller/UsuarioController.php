<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\{TextType, ButtonType, EmailType, HiddenType, PasswordType, TextareaType, SubmitType, NumberType, DateType, MoneyType, BirthdayType};


#[Route('/usuario')]
class UsuarioController extends AbstractController
{
    #[Route('/', name: 'usuario_index', methods: ['GET'])]
    public function index(UsuarioRepository $usuarioRepository): Response
    {
        return $this->render('usuario/index.html.twig', [
            'usuarios' => $usuarioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'usuario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $usuario = new Usuario();
        $form = $this->createFormBuilder($usuario)
            ->add('nombre', TextType::class)
            ->add('apellidos', TextType::class)
            ->add('fechaNacimiento', TextType::class)
            ->add('nacionalidad', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add(
                'save',
                SubmitType::class,
                array('label' => 'Registrar usuario')
            )
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($usuario);
            $entityManager->flush();

            return $this->redirectToRoute('usuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usuario/new.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'usuario_show', methods: ['GET'])]
    public function show(Usuario $usuario): Response
    {
        return $this->render('usuario/show.html.twig', [
            'usuario' => $usuario,
        ]);
    }

    #[Route('/{id}/edit', name: 'usuario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Usuario $usuario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('usuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'usuario_delete', methods: ['POST'])]
    public function delete(Request $request, Usuario $usuario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $usuario->getId(), $request->request->get('_token'))) {
            $entityManager->remove($usuario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('usuario_index', [], Response::HTTP_SEE_OTHER);
    }
}
