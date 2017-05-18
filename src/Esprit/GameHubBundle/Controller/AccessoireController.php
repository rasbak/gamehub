<?php

namespace Esprit\GameHubBundle\Controller;

use Esprit\GameHubBundle\Entity\Accessoire;
use Esprit\GameHubBundle\Entity\Membre;
use Esprit\GameHubBundle\Entity\Rating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AccessoireController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $accessoires = $em->getRepository('EspritGameHubBundle:Accessoire')->findAll();
/*
        $accessoires->setDateSortie(new \DateTime('now'));*/


        return $this->render('EspritGameHubBundle:Accessoire:index.html.twig', array(
            'accessoires' => $accessoires,
        ));
    }


    public function newAction(Request $request)
    {
        $accessoire = new Accessoire();

       $form = $this->createForm('Esprit\GameHubBundle\Form\AccessoireType', $accessoire);
            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); //effacer
            $accessoire->setDateSortie(new \DateTime('now'));


            $em->persist($accessoire);
            $em->flush($accessoire);

            return $this->redirectToRoute('accessoire_show', array('id' => $accessoire->getId()));
        }

        return $this->render('EspritGameHubBundle:Accessoire:new.html.twig', array(
            'accessoire' => $accessoire,
            'form' => $form->createView(),
        ));
    }

    public function showAction(Accessoire $accessoire)
    {
        $deleteForm = $this->createDeleteForm($accessoire);

        return $this->render('EspritGameHubBundle:Accessoire:show.html.twig', array(
            'accessoire' => $accessoire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, Accessoire $accessoire)
    {
        $deleteForm = $this->createDeleteForm($accessoire);
        $editForm = $this->createForm('Esprit\GameHubBundle\Form\AccessoireEditType', $accessoire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accessoire_edit', array('id' => $accessoire->getId()));
        }

        return $this->render('EspritGameHubBundle:Accessoire:edit.html.twig', array(
            'accessoire' => $accessoire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Accessoire $accessoire)
    {
        $form = $this->createDeleteForm($accessoire);
        $form->handleRequest($request);


            $em = $this->getDoctrine()->getManager();
            $em->remove($accessoire);
            $em->flush();

        return $this->redirectToRoute('accessoire_index');
    }


    private function createDeleteForm(Accessoire $accessoire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accessoire_delete', array('id' => $accessoire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function catalogueAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $accessoires = $em->getRepository('EspritGameHubBundle:Accessoire')->findAll();

        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $accessoires,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 6)

        );
        return $this->render('EspritGameHubBundle:Accessoire:catalogue.html.twig', array('accessoires' => $result,));
    }


    public function accessoireDetailsAction(Request $request)
    {$ida=$request->get('ida');
    $user=$this->getUser();
        $val=$request->get('val');
        $em = $this->getDoctrine()->getManager();
        $accessoires = $em->getRepository('EspritGameHubBundle:Accessoire')->find($ida);
        $usr=$em->getRepository('EspritGameHubBundle:Membre')->find($user->getId());
       /* $rate = $em->getRepository('EspritGameHubBundle:Rating')->findBy(array('id_produit_rate'=>$ida,'id_membre'=>$usr->getId()));
        dump($rate);*/
     /* if($val!=null){
        if($rate==null){
            $rate= new Rating();}

          $aaa = new Membre();
          $aaa=$usr;
        $rate->setIdMembre($aaa);
        $rate->setIdProduitRate($accessoires);
        $rate->setValeur($val);
        dump($rate);

        /*  dump($rate);
          die();*/
        /*dump($rate);
        die();*/
/*        $em->persist($rate);
$em->flush();}*/

        /*$ratingacc = $em->getRepository('EspritGameHubBundle:Rating')->findOneBy(array('id_produit_rate'=>$ida,'id_membre'=>$user->getId()));
if($ratingacc==null)
{$ratingacc = new Rating();
    $ratingacc->setValeur(0);}*/

        return $this->render('EspritGameHubBundle:Accessoire:accessoireDetails.html.twig', array('a' =>$accessoires,'ida'=>$ida));
    }

}
