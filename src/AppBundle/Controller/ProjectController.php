<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Repository\ProjectRepository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Project controller.
 *
 */
class ProjectController extends Controller
{
    /**
     * Lists all project entities.
     * 
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AppBundle:Project')->findAll();

        return $this->render('project/index.html.twig', array(
            'projects' => $projects,
        ));
    }

    /**
     * Creates a new project entity.
     *
     * 
     */
    public function newAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm('AppBundle\Form\ProjectType', $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('event_show', array('id' => $project->getId()));
        }

        return $this->render('project/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a project entity.
     */
    public function showAction(Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);

        return $this->render('project/show.html.twig', array(
            'project' => $project,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing project entity.
     *
     */
    public function editAction(Request $request, Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);
        $editForm = $this->createForm('AppBundle\Form\ProjectType', $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_edit', array('id' => $project->getId()));
        }

        return $this->render('project/edit.html.twig', array(
            'project' => $project,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a project entity.
     * 
     */
    public function deleteAction(Request $request, Project $project)
    {
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('event_index');
    }

    /**
     * Creates a form to delete a project entity.
     *
     * @param Project $project The project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $project->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function jsonAction(Request $request)
    {   
        $events = [];
         $em = $this->getDoctrine()->getManager();
         switch ($request->query->get('option')) {
            case 'pastEvent':
                $events = $em -> getRepository('AppBundle:Project')->findpastEvent(); 
                break;
            case 'futurEvent':
                $events = $em -> getRepository('AppBundle:Project')->findfuturEvent(); 
                break;
            case 'allEvent';
            default:
                $events = $em -> getRepository('AppBundle:Project')->findAll();
            
        }

        // $events = $em->getRepository('AppBundle:Project')->findAll();

        $curl = $this -> get('AppBundle\Network\ServiceCurl');

        $gpsEvents = []; 
        

        foreach($events as $e) {
              
            $adresse = str_replace(' ', '+', $e->getLocalisation());// pour une entité privé ou protected
           
            $suggestions = json_decode($curl->curl_get($adresse),true);
            $gps = $suggestions['features'][0]['geometry']['coordinates'];
            //$e['latitude'] = $gps[1];
            //$e['longitude'] = $gps[0];
            $e->latitude = $gps[1];
            $e->longitude = $gps[0];
            $gpsEvents[] = $e;    
        } 
 
        return $this->json($gpsEvents);
    }

}
