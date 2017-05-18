<?php

namespace Esprit\GameHubBundle\Controller;

use Esprit\GameHubBundle\Entity\Commentaire;
use Esprit\GameHubBundle\Entity\JeuAmateur;
use Esprit\GameHubBundle\Entity\Notification;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EspritGameHubBundle:Default:index.html.twig');
    }




    public function commenterAction($id, $contenu) {
        $ja = new JeuAmateur();
        $commentaire = new Commentaire();
        $em = $this->getDoctrine()->getManager();
        $ja = $em->getRepository('EspritGameHubBundle:JeuAmateur')->find($id);
        $compublication= $em->getRepository('EspritGameHubBundle:Commentaire')->findByIdJeuamateur($id);
        $lecommentaire = $contenu;

        // while (strpos(' antislach ', $lecommentaire) === true) {
        $lecommentaire = str_replace('antislach', '\\', $lecommentaire);
        //}
        //while (strpos(' slach ', $lecommentaire) === true) {
        $lecommentaire = str_replace('slach', '/', $lecommentaire);
        //}
        //while (strpos(' istefhem ', $lecommentaire) === true) {
        $lecommentaire = str_replace('istefhem', '?', $lecommentaire);
        //}

        $commentaire->setContenu($lecommentaire);
        $commentaire->setIdJeuamateur($ja->getId());
        $user = $em->merge($this->get('security.token_storage')->getToken()->getUser());
        $commentaire->setUtilisateurId($user->getUsername());
        $commentaire->setDate(new \DateTime());
        $notifs = $em->getRepository('EspritGameHubBundle:Notification')->findByEnable(1);
        $utilisateurs = $em->getRepository('EspritGameHubBundle:Membre')->findAll();
        foreach ($utilisateurs as $utilisateurNotifie) {

            if($utilisateurNotifie->getUsername() != $user->getUsername()){

                $k=0;
                foreach ($compublication as $comut){
                    if($utilisateurNotifie->getUsername()==$comut->getUtilisateurId()){
                        $k=1;
                        break;
                    }
                }


                if ($k==1 or $ja->getMembre()==$utilisateurNotifie->getUsername()  )
                {
                    if($ja->getMembre()==$utilisateurNotifie->getUsername()){
                        $contenu = $user->getUsername() . ' a commenté votre jeu amateur : ' . $ja->getNom() ;
                    }else if($user->getUsername()==$ja->getMembre()){
                        $contenu = $user->getUsername() . ' a commenté son jeu amateur : ' . $ja->getNom() ;
                    } else{
                        $contenu = $user->getUsername() . ' a commenté le jeu amateur : ' . $ja->getNom() . ' de ' . $ja->getMembre();
                    }
                    $p=0;
                    foreach ($notifs as $notif){
                        if($contenu==$notif->getContenu()){
                            $p=-1;
                            break;
                        }
                    }
                    if($p==0){
                    $notification = new Notification();
                    $notification->setIdJeuamateur($ja->getId());
                    $notification->setEnable('1');
                    $notification->setDate(new \DateTime());


                    $notification->setContenu($contenu);
                    $notification->setMembreId($utilisateurNotifie->getId());

                    $em->persist($notification);
                    $em->flush();
                    }
                }

            }

        }



        $em->persist($commentaire);
        $em->flush();

        $response = new JsonResponse();
        return $response->setData(array('contenu' => $commentaire->getContenu(),'date' => $commentaire->getDate()));
    }




    public function notifierAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $notification = new Notification();
        $notifications = $em->getRepository('EspritGameHubBundle:Notification')->findBy(array('membreId' => $this->get('security.token_storage')->getToken()->getUser()->getId(), 'enable' => '1'));

        $nombreNotif = 0;

        $serializer = $this->get('fos_js_routing.serializer');
        if ($notifications !== NULL) {
            foreach ($notifications as $key => $notification) {


                $notifications[$key] = $serializer->serialize($notification, 'json');

                $em->persist($notification);
                $em->flush();
                $nombreNotif++;
            }
        }

        $serializer->serialize($notifications, 'json');

        $response = new JsonResponse();

        return $response->setData(array('notifications' => $notifications, 'nombreNotif' => $nombreNotif));

    }
}
