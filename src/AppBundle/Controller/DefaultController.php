<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'var_test' => 'Hello world'
    ]);

    }



     /**
     * @Route("/event", name="event")
     */


    public function eventAction(Request $request)// fonction pour afficher tout les evenements
    {
       $curl = $this -> get('AppBundle\Network\ServiceCurl');

       $events = $this -> getEvents();
       $gpsEvents = [];
       
       foreach($events as $e) {
           $adresse = str_replace(' ', '+', $e['adresse']);
           $suggestions = json_decode($curl->curl_get($adresse),true);
           $gps = $suggestions['features'][0]['geometry']['coordinates'];
           $e['latitude'] = $gps[1];
           $e['longitude'] = $gps[0];
           $gpsEvents[] = $e;
       } 
       
       return $this->render('@App/event/event.html.twig', [
        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        'event' => $gpsEvents
    ]);
    
    }


   /* protected function getEvents(){
    $events = [
        
            ['nom'=>'Nouvelle année', 'date'=>'01/01/2019', 'adresse'=>'Place du Trocadéro 75016 Paris'],
            ['nom'=>'Mon anniversaire', 'date'=>'15/05/2019','adresse'=>'Place de la Bastille 75011 Paris'],
            ['nom'=>'Cinéma en plein air', 'date'=>'20/09/2018', 'adresse'=>'70 rue de la Liberté 75008 Paris'],
            ['nom'=>'Feux d\'artifices', 'date'=>'05/11/2018', 'adresse'=>'70 avenue de la Révolution 75008 Paris']

            ];
    
            return $events;
    }*/



}

