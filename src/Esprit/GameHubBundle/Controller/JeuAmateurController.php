<?php

namespace Esprit\GameHubBundle\Controller;

use Esprit\GameHubBundle\Entity\Commentaire;
use Esprit\GameHubBundle\Entity\JeuAmateur;
use Esprit\GameHubBundle\Entity\Notification;
use Esprit\GameHubBundle\Form\CommentaireType;
use Esprit\GameHubBundle\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;


/**
 * Jeuamateur controller.
 *
 */
class JeuAmateurController extends Controller
{


    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $membre=$this->get('security.token_storage')->getToken()->getUser();
        $ja= new JeuAmateur();
        $commentaire = new Commentaire();
        $com =$em->getRepository('EspritGameHubBundle:Commentaire')->findAll();
        $form=$this->createForm(RechercheType::class,$ja);
        $form->handleRequest($request);
        if ($form->isValid()){
            $nom=$ja->getNom();

            $jeam=$em->getRepository("EspritGameHubBundle:JeuAmateur")->findByNom($nom);

        }else {
            $jeam = $em->getRepository('EspritGameHubBundle:JeuAmateur')->findAll();

        }
            if ($jeam == NULL) {
                $nombrecomment[0] = 0;
            } else {
                foreach ($jeam as $j) {
                    $x = $j->getId();
                    $nombrecomment[$x] = 0;
                }


                foreach ($jeam as $j) {
                    foreach ($com as $c) {
                        if ($c->getIdJeuamateur() == $j->getId()) {
                            $x = $j->getId();
                            $nombrecomment[$x]++;
                        }
                    }
                }
            }


        return $this->render('EspritGameHubBundle:JeuAmateur:index.html.twig', array(
            'jeuAmateurs' => $jeam,
            'membre'   => $membre,
            'form'=>$form->createView(),
            'com' => $com,
            'nombrecomment'=> $nombrecomment,
        ));
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('EspritGameHubBundle:JeuAmateur')->findAll();
        $jeuAmateur = new JeuAmateur();
        $membre=$this->get('security.token_storage')->getToken()->getUser();
        $utilisateurs = $em->getRepository('EspritGameHubBundle:Membre')->findAll();
        $form = $this->createForm('Esprit\GameHubBundle\Form\JeuAmateurType', $jeuAmateur);
        $form->remove('evaluation');
        $form->remove('membre');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jeuAmateur->setMembre($membre->getUsername());
            $em->persist($jeuAmateur);
            $em->flush($jeuAmateur);

            foreach ($utilisateurs as $utilisateurNotifie) {

                if($utilisateurNotifie->getUsername() != $membre->getUsername()){

                        $notification = new Notification();
                        $notification->setIdJeuamateur($jeuAmateur->getId());
                        $notification->setEnable('1');
                        $notification->setDate(new \DateTime());

                        $contenu = $membre->getUsername() . ' a ajouter un jeu amateur : ' . $jeuAmateur->getNom();

                        $notification->setContenu($contenu);
                        $notification->setMembreId($utilisateurNotifie->getId());

                        $em->persist($notification);
                        $em->flush();

                }

            }

            return $this->redirectToRoute('jeuamateur_show', array('id' => $jeuAmateur->getId()));
        }


        return $this->render('EspritGameHubBundle:JeuAmateur:new.html.twig', array(
            'jeuAmateur' => $jeuAmateur,
            'form' => $form->createView(),
        ));
    }


    public function showAction(JeuAmateur $jeuAmateur)
    {
        $deleteForm = $this->createDeleteForm($jeuAmateur);
        $membre=$this->get('security.token_storage')->getToken()->getUser();

        return $this->render('EspritGameHubBundle:JeuAmateur:show.html.twig', array(
            'jeuAmateur' => $jeuAmateur,
            'membre'=>$membre,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, JeuAmateur $jeuAmateur)
    {
        if ($this->getUser()!=$jeuAmateur->getMembre()) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('vous n\'avez pas l\'accée');
        }
        $deleteForm = $this->createDeleteForm($jeuAmateur);
        $editForm = $this->createForm('Esprit\GameHubBundle\Form\JeuAmateurType', $jeuAmateur);
        $editForm->remove('membre')->remove('evaluation');
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jeuamateur_edit', array('id' => $jeuAmateur->getId()));
        }

        return $this->render('EspritGameHubBundle:JeuAmateur:edit.html.twig', array(
            'jeuAmateur' => $jeuAmateur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }



    public function rechercherAction(Request $request){

        $ja= new JeuAmateur();
        $em=$this->getDoctrine()->getManager();
        $Form=$this->createForm(RechercheType::class,$ja);
        $Form->handleRequest($request);
        if ($Form->isValid()){
            $nom=$ja->getNom();
            $ja=$em->getRepository("EspritGameHubBundle:JeuAmateur")->rechercheDQL($nom);

        }else{
            $modele=$em->getRepository("EspritGameHubBundle:JeuAmateur")->findAll();

        }
        return $this->render("EspritGameHubBundle:JeuAmateur:index.html.twig",array(
            'Form'=>$Form->createView(),'jeuAmateurs' => $ja,
            ));
    }


    public function deleteAction(Request $request, JeuAmateur $jeuAmateur)
    {
        $form = $this->createDeleteForm($jeuAmateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jeuAmateur);
            $em->flush();
        }

        return $this->redirectToRoute('jeuamateur_index');
    }




    public function showAvecCommentsAction(Request $request,$id) {

        $em = $this->getDoctrine()->getManager();

        $ja=new JeuAmateur();
        $ja = $em->getRepository('EspritGameHubBundle:JeuAmateur')->find($id);
        $deleteForm = $this->createDeleteForm($ja);
        $comments = $em->getRepository('EspritGameHubBundle:Commentaire')->findBy(array('idJeuamateur' => $ja));

        $utilisateur = $em->merge($this->get('security.token_storage')->getToken()->getUser());


        if (!$ja) {
            throw $this->createNotFoundException('Jeu amateur inexistant!');
        }
        $jaa = $em->getRepository('EspritGameHubBundle:JeuAmateur')->findAll();
        if ($jaa == NULL) {
            $nombrecomment[0] = 0;
        } else {
            foreach ($jaa as $j) {
                $nombrecomment[$j->getId()] = 0;
            }
            foreach ($jaa as $j) {
                foreach ($comments as $comment) {
                    if ($comment->getIdJeuamateur() == $j->getId()) {
                        $nombrecomment[$j->getId()] ++;
                    }
                }
            }
        }


        return $this->render('EspritGameHubBundle:JeuAmateur:showAvecComments.html.twig', array(
            'jeuAmateur' => $ja,
            'delete_form' => $deleteForm->createView(),
            'com' => $comments,
            'nombrecomment' => $nombrecomment,
            'membre' => $utilisateur,
        ));
    }


    public function showCommentsNotifAction(Request $request,$id) {

        $em = $this->getDoctrine()->getManager();
        $notificationdesactives = $em->getRepository('EspritGameHubBundle:Notification')->findByIdJeuamateur($id);
        foreach ($notificationdesactives as $nd){
                 if ($this->get('security.token_storage')->getToken()->getUser()->getId()==$nd->getMembreId()) {
                     $nd->setEnable('0');

                     $em->persist($nd);
                     $em->flush();
                 }
        }

        $ja=new JeuAmateur();
        $ja = $em->getRepository('EspritGameHubBundle:JeuAmateur')->find($id);
        $deleteForm = $this->createDeleteForm($ja);
        $comments = $em->getRepository('EspritGameHubBundle:Commentaire')->findBy(array('idJeuamateur' => $ja));
        $utilisateur = $em->merge($this->get('security.token_storage')->getToken()->getUser());

        if (!$ja) {
            throw new AccessDeniedException('vous n\'avez pas l\'accée');
        }
        $jaa = $em->getRepository('EspritGameHubBundle:JeuAmateur')->findAll();
        if ($jaa == NULL) {
            $nombrecomment[0] = 0;
        } else {
            foreach ($jaa as $j) {
                $nombrecomment[$j->getId()] = 0;
            }
            foreach ($jaa as $j) {
                foreach ($comments as $comment) {
                    if ($comment->getIdJeuamateur() == $j->getId()) {
                        $nombrecomment[$j->getId()] ++;
                    }
                }
            }
        }


        return $this->render('EspritGameHubBundle:JeuAmateur:showAvecComments.html.twig', array(
            'jeuAmateur' => $ja,
            'delete_form' => $deleteForm->createView(),
            'com' => $comments,
            'nombrecomment' => $nombrecomment,
            'membre' => $utilisateur,
        ));
    }




    private function createDeleteForm(JeuAmateur $jeuAmateur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jeuamateur_delete', array('id' => $jeuAmateur->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }




}
