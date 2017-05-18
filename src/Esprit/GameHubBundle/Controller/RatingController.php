<?php
/**
 * Created by PhpStorm.
 * User: Yekken Yosr
 * Date: 10/04/2017
 * Time: 16:59
 */

namespace Esprit\GameHubBundle\Controller;
use Esprit\GameHubBundle\Entity\Rating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RatingController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $accessoires = $em->getRepository('EspritGameHubBundle:Accessoire')->findAll();



        return $this->render('EspritGameHubBundle:Accessoire:index.html.twig', array(
            'accessoires' => $accessoires,
        ));
    }

}