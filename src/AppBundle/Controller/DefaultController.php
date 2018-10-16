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
       
       return $this->render('@App/event/event.html.twig', [
        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        //'event' => $gpsEvents
        ]);
    
    }


   protected function getEvents(){
    
    $em = $this->getDoctrine()->getManager();

    $projects = $em->getRepository('AppBundle:Project')->findAll();
    
    return  $projects ;  
    

   }
   
   
   
   
    /*protected function getEvents(){
    $event = [
        
            ['nom'=>'Nouvelle année', 'date'=>'31/12/2019', 'adresse'=>'Place du Trocadéro 75016 Paris', 'heure'=>'00:00'],
            ['nom'=>'Mon anniversaire', 'date'=>'15/05/2019','adresse'=>'Place de la Bastille 75011 Paris', 'heure'=>'04:00'],
            ['nom'=>'Cinéma en plein air', 'date'=>'20/09/2018', 'adresse'=>'70 rue de la Liberté 75008 Paris', 'heure'=>'20:00'],
            ['nom'=>'Feux d\'artifices', 'date'=>'05/11/2018', 'adresse'=>'70 avenue de la Révolution 75008 Paris', 'heure'=>'22:00']

            ];
    
            return $event;
    }*/



}

