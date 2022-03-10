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

    
}
