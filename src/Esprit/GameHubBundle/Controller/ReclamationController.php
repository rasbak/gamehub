<?php

namespace Esprit\GameHubBundle\Controller;

use Esprit\GameHubBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;

class ReclamationController extends Controller
{



    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('EspritGameHubBundle:Reclamation')->findAll();
        $series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
        );

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Reclamation');
        $ob->xAxis->title(array('text'  => "Jour"));
        $ob->yAxis->title(array('text'  => "Nombre reclamation"));
        $ob->series($series);
        return $this->render('EspritGameHubBundle:Reclamation:index.html.twig', array(
            'reclamations' => $reclamations,'chart' => $ob
        ));
    }


    public function newAction(Request $request)
    {
        $user=$this->getUser();
        $reclamation = new Reclamation();
        $form = $this->createForm('Esprit\GameHubBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setMembre($user->getId());
            $reclamation->setVu(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush($reclamation);
            $this->email($reclamation);
            return $this->redirectToRoute('reclamation_show', array('id' => $reclamation->getId()));
        }

        return $this->render('EspritGameHubBundle:Reclamation:new.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ));
    }

    public function email($rec){

        $user=$this->get('security.token_storage')->getToken()->getUser();
        $message = \Swift_Message::newInstance()
            ->setSubject($rec->getSujet())
            ->setFrom(array($user->getEmail() => $user->getUsername()))
            ->setTo('ahmedamine.lahmer@esprit.tn')
            ->setCharset('utf-8')
            ->setContentType('text/html')
            ->setBody($rec->getContenu())
        ;
        $this->get('mailer')->send($message);

    }


    public function showAction(Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);

        return $this->render('EspritGameHubBundle:Reclamation:show.html.twig', array(
            'reclamation' => $reclamation,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);
        $editForm = $this->createForm('Esprit\GameHubBundle\Form\ReclamationType', $reclamation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_edit', array('id' => $reclamation->getId()));
        }

        return $this->render('EspritGameHubBundle:Reclamation:edit.html.twig', array(
            'reclamation' => $reclamation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Reclamation $reclamation)
    {
        $form = $this->createDeleteForm($reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reclamation);
            $em->flush();
        }

        return $this->redirectToRoute('reclamation_index');
    }


    private function createDeleteForm(Reclamation $reclamation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reclamation_delete', array('id' => $reclamation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
