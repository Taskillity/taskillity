<?php

use Symfony\Component\BrowserKit\Request;


/**
 * @Route("/eventos", name="eventos")
 * 
 */

 
public function eventos(Request $request, CommonService $commonService)
{
    $authcode = $request->get(key:"authcode");
    $email = "oscargargom001@gmail.com";

    if(!empty($authcode)) $commonService->insertGoogleApiToken($email,$authcode);

    $authLink = $commonService->generateGoogleApiToken($email);
    $eventos = $commonService->getEventsByEmail($email);

    return $this->render(view:'default/eventos.html.twig', [

        'eventos' => $eventos,
        'authLink' => $authLink,

    ]);


}

?>