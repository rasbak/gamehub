<?php

namespace Esprit\GameHubBundle\Controller;

use Doctrine\DBAL\Driver\SQLSrv\SQLSrvException;
use Esprit\GameHubBundle\Entity\CommentaireForum;
use Esprit\GameHubBundle\Entity\Signale;
use Esprit\GameHubBundle\Form\CommentaireForumType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Esprit\GameHubBundle\Entity\SujetForum;
use Esprit\GameHubBundle\Form\SujetForumType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class SujetForumController extends Controller
{
    public function afficherAction()
    {
        $em = $this->getDoctrine()->getManager();
        $f = $em->getRepository('EspritGameHubBundle:SujetForum')->findbyactive();
        return $this->render('EspritGameHubBundle:SujetForum:Afficher.html.twig', array('forum' => $f));

    }

    public function afficherbAction()
    {
        $em = $this->getDoctrine()->getManager();
        $f = $em->getRepository('EspritGameHubBundle:SujetForum')->findAll();
        return $this->render('EspritGameHubBundle:SujetForum:AfficherB.html.twig', array('forum' => $f));

    }

    public function afficherSignlebAction()
    {
        $em = $this->getDoctrine()->getManager();
        $s = $em->getRepository('EspritGameHubBundle:Signale')->findAll();
        return $this->render('EspritGameHubBundle:SujetForum:SignalerB.html.twig', array('sign' => $s));

    }

    public function SujetAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $f = $em->getRepository('EspritGameHubBundle:SujetForum')->find($id);
        $c = $em->getRepository('EspritGameHubBundle:CommentaireForum')->findbysujet($id);
        return $this->render('EspritGameHubBundle:SujetForum:Sujet.html.twig', array('forum' => $f, 'comm' => $c));

    }

    public function AjouterSujetAction(Request $req)
    {
        $s = new SujetForum();

        $u = $this->getUser();

        $Form = $this->createForm(SujetForumType::class, $s);
        $Form->handleRequest($req);
        if ($Form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $s->setMembreId($u);
            $s->setDate(new \Datetime);
            $s->setEnable(1);
            $em->persist($s);
            $em->flush();
            return $this->redirectToRoute('esprit_game_hub_Affciher');
        }
        return $this->render('EspritGameHubBundle:SujetForum:Ajouter.html.twig', array('forum' => $Form->createView()));

    }

    public function AjouterCommentaireAction(Request $req, $id)
    {
        $c = new CommentaireForum();
        $u = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $su = $em->getRepository('EspritGameHubBundle:SujetForum')->find($id);

        if ($req->getMethod('POST')) {
            $c->setIdSujet($su);
            $c->setContenu($req->get('con'));
            $c->setUtilisateurId($u);
            $c->setDate(new \DateTime);

            $em->persist($c);

            $em->flush();
            return $this->redirectToRoute('esprit_game_hub_Sujet', array('id' => $id));
        }
        return $this->redirectToRoute('esprit_game_hub_Sujet', array('id' => $id));

    }

    public function signalesujetAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $f = $em->getRepository('EspritGameHubBundle:SujetForum')->find($id);
        return $this->render('EspritGameHubBundle:SujetForum:Comme.html.twig', array('sujet' => $f));
    }

    public function ajouterSignleAction(Request $req, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $f = $em->getRepository('EspritGameHubBundle:SujetForum')->find($id);

        $s = new Signale();

        $u = $this->getUser();

        if ($req->isMethod('POST')) {
            $s->setIdsujet($f);
            $s->setIdmembre($u);
            $s->setCause($req->get('cause'));
            $em->persist($s);

            $em->flush();
            return $this->redirectToRoute('esprit_game_hub_Affciher');
        }

    }

    public function AccepterSignleAction(Request $req, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $s = $em->getRepository('EspritGameHubBundle:SujetForum')->find($id);

        $s->setEnable(0);


        $em->persist($s);
        $em->flush();
        return $this->redirectToRoute('esprit_game_hub_Affciherb');


    }

    public function RefuserSignleAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $s = $em->getRepository('EspritGameHubBundle:Signale')->find($id);
        $em->remove($s);
        $em->flush();


        return $this->redirectToRoute('esprit_game_hub_Affciherb');
    }


}
