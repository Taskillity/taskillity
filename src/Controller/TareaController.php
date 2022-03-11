<?php

namespace App\Controller;

use App\Entity\Tarea;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;




class TareaController extends AbstractController
{
    //Get tarea
        #[Route('/api/tarea/{id}', name: 'tarea_get', methods: ['GET'])]
        function getTarea(ManagerRegistry $doctrine ,$id) : Response{
        
        $entityManager = $doctrine->getManager();
        $tarea = $entityManager->getRepository(Tarea::class)->find($id);


        if ($tarea == null) {
            return new JsonResponse([
                'error' => 'Tarea not found'
            ], 404);
        }

        $result = new \stdClass();
        $result->id = $tarea->getId();
        $result->titulo = $tarea->getTitulo();
        $result->descripcion = $tarea->getDescripcion();
        $result->usuario = $tarea->getUsuario()->getId();
        
        return new JsonResponse($result);
    }




    // Get tareas
    #[Route('/api/tarea', name: 'tareas_get', methods: ['GET'])]
    function getTareas(ManagerRegistry $doctrine) : Response{

        $entityManager = $doctrine->getManager();
        $tareas = $entityManager->getRepository(Tarea::class)->findAll();

        $listaTareas = array();
        foreach ($tareas as $tarea) {

            $result = new \stdClass();
            $result->id = $tarea->getId();
            $result->titulo = $tarea->getTitulo();
            $result->descripcion = $tarea->getDescripcion();
            $result->usuario = $tarea->getUsuario()->getId();
            
            array_push($listaTareas, $result);
            
        }
        return new JsonResponse($listaTareas);
    }




    //Post tarea
    #[Route('/api/tarea', name: 'tarea_post', methods: ['POST'])]
    function postTarea(ManagerRegistry $doctrine, Request $request) : Response{

        $entityManager = $doctrine->getManager();
        $usuario = $entityManager->getRepository(Usuario::class)->findOneBy(['id' => $request->request->get('id')]);

        if ($usuario == null){
        return new JsonResponse([
            'error' => 'Tarea not created'
        ], 404);
        }    

        $tarea = new Tarea();
        $tarea->setDescripcion($request->request->get("descripcion"));
        $tarea->setTitulo($request->request->get("titulo"));
        $tarea->setUsuario($usuario);
        $entityManager->persist($tarea);
        $entityManager->flush();
        

        return new JsonResponse($tarea);

    }





    //Put tarea
    #[Route('/api/tarea/{id}', name: 'tarea_put', methods: ['PUT'])]
    function putTweet(ManagerRegistry $doctrine,Request $request, $id) {

        $entityManager = $doctrine->getManager();
        $tarea = $entityManager->getRepository(Tarea::class)->find($id);

        if ($tarea == null) {
            return new JsonResponse([
            'error' => 'Tarea not found'
            ], 404);
        }
        
        $tarea->setDescripcion($request->request->get("descripcion"));
        $tarea->setTitulo($request->request->get("titulo"));
        $entityManager->flush();

            $result = new \stdClass();
            $result->id = $tarea->getId();
            $result->titulo = $tarea->getTitulo();
            $result->descripcion = $tarea->getDescripcion();
            $result->usuario = $tarea->getUsuario()->getId();

            return new JsonResponse($result);
    }





    //Delete tarea
    #[Route('/api/tarea/{id}', name: 'tarea_delete', methods: ['DELETE'])]
    function deleteTweet(ManagerRegistry $doctrine, $id) {

        $entityManager = $doctrine->getManager();
        $tarea = $entityManager->getRepository(Tarea::class)->find($id);

        if ($tarea == null) {
            return new JsonResponse([
            'error' => 'Tarea not found'], 404);
        }

        $entityManager->remove($tarea);
        $entityManager->flush();

        return new JsonResponse(null,204);
    }



}
