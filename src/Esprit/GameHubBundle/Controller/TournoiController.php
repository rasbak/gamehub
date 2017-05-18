<?php

namespace Esprit\GameHubBundle\Controller;

use Esprit\GameHubBundle\Entity\Tournoi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;


/**
 * Tournoi controller.
 *
 * @Route("tournoi")
 */
class TournoiController extends Controller
{
    /**
     * Lists all tournoi entities.
     *
     * @Route("/", name="tournoi_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tournois = $em->getRepository('EspritGameHubBundle:Tournoi')->findAll();

        return $this->render('tournoi/index.html.twig', array(
            'tournois' => $tournois,
        ));
    }

    /**
     * Creates a new tournoi entity.
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/new", name="tournoi_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $tournoi = new Tournoi();


        $form = $this->createForm('Esprit\GameHubBundle\Form\TournoiType', $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form['image']->getData()
                ->move(
                    $tournoi->getUploadRootDir(),
                    $form['image']->getData()->getClientOriginalName()
                );
            $tournoi->setImage($form['image']->getData()->getClientOriginalName());

            $em = $this->getDoctrine()->getManager();
            $em->persist($tournoi);
            $em->flush();

            return $this->redirectToRoute('tournoi_show', array('id' => $tournoi->getId()));
        }

        return $this->render('EspritGameHubBundle:tournoi:new.html.twig', array(
            'tournoi' => $tournoi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tournoi entity.
     *
     * @Route("/{id}", name="tournoi_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Tournoi $tournoi)
    {
        $deleteForm = $this->createDeleteForm($tournoi);

        return $this->render('EspritGameHubBundle:tournoi:show.html.twig', array(
            'tournoi' => $tournoi,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tournoi entity.
     *
     * @Route("/{id}/edit", name="tournoi_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Tournoi $tournoi)
    {

        $deleteForm = $this->createDeleteForm($tournoi);
        $editForm = $this->createForm('Esprit\GameHubBundle\Form\TournoiType', $tournoi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tournoi_edit', array('id' => $tournoi->getId()));
        }

        return $this->render('EspritGameHubBundle:tournoi:edit.html.twig', array(
            'tournoi' => $tournoi,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tournoi entity.
     *
     * @Route("/{id}", name="tournoi_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Tournoi $tournoi)
    {

        $form = $this->createDeleteForm($tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tournoi);
            $em->flush();
        }

        return $this->redirectToRoute('tournoi_index');
    }

    /**
     * Creates a form to delete a tournoi entity.
     *
     * @param Tournoi $tournoi The tournoi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tournoi $tournoi)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tournoi_delete', array('id' => $tournoi->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
