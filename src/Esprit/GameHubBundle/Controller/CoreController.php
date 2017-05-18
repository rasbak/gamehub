<?php

namespace Esprit\GameHubBundle\Controller;


use Esprit\GameHubBundle\Entity\Participant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;


class CoreController extends Controller
{
    /**
     * @Route("/acceuil")
     */
    public function acceuilAction()
    {
        return $this->render('EspritGameHubBundle:Core:acceuil.html.twig', array(// ...
        ));
    }


    /**
     * @Route("/tournoi"  , name="esprit_gamehub_tournoi")
     * @Method("GET")
     */
    public function tournoiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tournois = $em->getRepository('EspritGameHubBundle:Tournoi')->findAll();


        return $this->render('EspritGameHubBundle:Core:tournoi.html.twig', array(
            'tournois' => $tournois,
        ));
    }


    /**
     * @Route("/testlogin")
     */
    public function loginAction()
    {
        return $this->render('EspritGameHubBundle:Core:login.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/inscription" , name="inscription_tournoi" )
     * @Method({"GET", "POST"})
     */
    public function Inscription(Request $request)
    {
        $nomTournoi = $request->request->get('nomTournoi');
        $nomMembre = $this->getUser();
        $participant = new Participant();

        $participant->setNomTournoi($nomTournoi);
        $participant->setNomMembre($nomMembre);

        $editForm = $this->createForm('Esprit\GameHubBundle\Form\ParticipantType', $participant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();

            return $this->redirectToRoute('esprit_gamehub_tournoi');
        }

        return $this->render('EspritGameHubBundle:participant:inscription.html.twig', array(
            'participant' => $participant,
            'edit_form' => $editForm->createView(),
        ));
    }

}
