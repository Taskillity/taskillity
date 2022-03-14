<?php

namespace App\Controller;

use App\Entity\Tarea;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
    #[Route('/api/tareas', name: 'tareas_get', methods: ['GET'])]
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
    //Get tareas
    #[Route('/api/listaTareas/{idUsuario}', name: 'tareasById', methods: ['GET'])]
    function getTareasById(ManagerRegistry $doctrine ,$idUsuario) : Response{

    $entityManager = $doctrine->getManager();
    $usuario = $entityManager->getRepository(Usuario::class)->find($idUsuario);


    if ($usuario == null) {
        return new JsonResponse([
            'error' => 'User not found'
        ], 404);
    }

    $result = new \stdClass();
    $result->id = $usuario->getId();
    $result->tareas = array();
    foreach ($usuario->getTareas() as $tarea) {
        $result->tareas[] = $this->generateUrl('tarea_get', [
            'id' => $tarea->getId(),
        ], UrlGeneratorInterface::ABSOLUTE_URL);
    }

    return new JsonResponse($result);
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
        
        $result = new \stdClass();
        $result->id = $tarea->getId();
        $result->titulo = $tarea->getTitulo();
        $result->descripcion = $tarea->getDescripcion();
        $result->usuario = $tarea->getUsuario()->getId();

        return new JsonResponse($result);

    }





    //Put tarea
    #[Route('/api/tarea/{id}', name: 'tarea_put', methods: ['PUT'])]
    function putTarea(ManagerRegistry $doctrine,Request $request, $id) {

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
    function deleteTarea(ManagerRegistry $doctrine, $id) {

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
