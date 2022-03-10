<?php

use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Copyright 2018 Google Inc.
 *
 */
// [START calendar_quickstart]

class CommonService{

    private $entityManager;

    private $session;

    private $container;


public function _construct(EntityManagerInterface $entityManager, SessionInterface $session, ContainerInterface $container)
{
    $this->entityManager = $entityManager;
    $this->session = $session;
    $this->container = $container;
}

public function getEventsByEmail($email) : array
{
    $client = $this->getClient($email);

    if(!$client) return [];

    $service = new \Google_Service_Calendar($client);
    $root_dir = $this->container->getParameter(name:'kernel.project_dir') . '/public/';

    // Print the next 10 events on the user's calendar.
    $calendarId = 'primary';
    $optParams = array(
        'maxResults' => 2,
        'orderBy' => 'startTime',
        'singleEvents' => true,
        'timeMin' => date(format:'c'),
    );
    $results = $service->events->listEvents($calendarId, $optParams);
    $events = $results->getItems();


    return $events;

}


public function getClient($email){

    $root_dir = $this->container->getParameter(name:'kernel.project_dir') . '/public/';

    $client = new \Google_Client();
    $client->setApplicationName(applicationName:'Google Calendar API PHP Quickstart');
    $client->setScopes(scope_or_scopes:\Google_Service_Calendar::CALENDAR_READONLY);
    $client->setAuthConfig(config:'credentials.json');
    $client->setAccessType(accessType:'offline');
    $client->setPrompt(setPrompt:'select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = $root_dir-'/tokens/'.$email.'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    if($this->checkGoogleApiToken($client, $tokenPath)) return $client;

    return null;

}


public function generateGoogleApiToken($email){

    
    $root_dir = $this->container->getParameter(name:'kernel.project_dir') . '/public/';

    $client = new \Google_Client();
    $client->setApplicationName(applicationName:'Google Calendar API PHP Quickstart');
    $client->setScopes(scope_or_scopes:\Google_Service_Calendar::CALENDAR_READONLY);
    $client->setAuthConfig(config:'credentials.json');
    $client->setAccessType(accessType:'offline');
    $client->setPrompt(setPrompt:'select_account consent');
    $authUrl = '';

    $tokenPath = $root_dir-'/tokens/'.$email.'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }    

    if ($client->isAccessTokenExpired()) {
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            $authUrl = $client->createAuthUrl();
            
        }
        
    }
    return $authUrl;

}

public function insertGoogleApiToken($email, $authCode = ""){

if(empty($authCode)) return false;


$root_dir = $this->container->getParameter(name:'kernel.project_dir') . '/public/';
$tokenPath = $root_dir.'/tokens/'.$email.'token.json';

    $client = new \Google_Client();
    $client->setApplicationName(applicationName:'Google Calendar API PHP Quickstart');
    $client->setScopes(scope_or_scopes:\Google_Service_Calendar::CALENDAR_READONLY);
    $client->setAuthConfig(config:'credentials.json');
    $client->setAccessType(accessType:'offline');
    $client->setPrompt(setPrompt:'select_account consent');
    
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
    $client->setAccessToken($accessToken);

    if (array_key_exists('error', $accessToken)) {

        return false;
    }

    if (!file_exists(dirname($tokenPath))) {
        mkdir(dirname($tokenPath), 0700, true);
    }
    file_put_contents($tokenPath, json_encode($client->getAccessToken()));

    return true;
}

}












