<?php

namespace App\Controller;

use App\Entity\Usuario;
use ContainerVKVqKfU\getForm_FactoryService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\{TextType, ButtonType, EmailType, HiddenType, PasswordType, TextareaType, SubmitType, NumberType, DateType, MoneyType, BirthdayType};
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/usuario')]
class UsuarioController extends AbstractController
{   

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
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

            $hashedPassword = $this->passwordHasher->hashPassword(
                $usuario,
                $usuario->getPassword()
            );
            $usuario->setPassword($hashedPassword); 

            $entityManager->persist($usuario);
            $entityManager->flush();

            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usuario/new.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);

        
    }
    /**

    * @Route("/index", name="index")

    */

    public function principalAction(Request $request)

    {
        //aquí debe ir toda la lógica previa antes de renderizar a la template index.html.twig
        return $this->render('index.html.twig');
    }

    /**

    * @Route("/usuario/contact", name="app_contact")

    */

    public function principalAction2(Request $request)

    {
        //aquí debe ir toda la lógica previa antes de renderizar a la template formulario.html.twig
        return $this->render('formulario.html.twig');
    }
}