<?php

namespace App\DataFixtures;

use App\Entity\Usuario;
use App\Entity\Tarea;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UsuarioFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $usuario = new Usuario();
        $usuario->setEmail('prueba2@gmail.com');
        $usuario->setNombre('prueba2');
        $usuario->setApellidos('prueba2');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $usuario,
            'prueba'
        );
        $usuario->setPassword($hashedPassword);
        $manager->persist($usuario);

        $usuario = new Usuario();
        $usuario->setEmail('ADMIN@gmail.com');
        $usuario->setNombre('admin');
        $usuario->setApellidos('admin');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $usuario,
            'admin'
        );
        $usuario->setPassword($hashedPassword);
        $usuario->setRoles(array("ROLE_ADMIN"));
        $manager->persist($usuario);

        $tarea = new Tarea();
        $tarea->setTitulo('DescPrueba');
        $tarea->setDescripcion('DescPrueba');

        $tarea->setUsuario($usuario);
        $manager->persist($tarea);

        $tarea = new Tarea();
        $tarea->setTitulo('DescPrueba2');
        $tarea->setDescripcion('DescPrueba2');

        $tarea->setUsuario($usuario);
        $manager->persist($tarea);

        $manager->flush();
    }
}
