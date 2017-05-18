<?php

namespace Esprit\GameHubBundle\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Esprit\GameHubBundle\Entity\Jeu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Jeu controller.
 *
 */
class JeuController extends Controller
{
    public function publicannonceAction(Request $request)
{
    $em = $this->getDoctrine()->getManager();
    $title = $request->request->get('title');
    if ($title) {
        $query = $em->getRepository('EspritGameHubBundle:Jeu')
            ->findAllOrderedByName($title);
        return $this->render('EspritGameHubBundle:jeu:index.html.twig', array(
            'jeus' => $query,

        ));
    }
    $jeus = $em->getRepository('EspritGameHubBundle:Jeu')->findAll();
    return $this->render('EspritGameHubBundle:jeu:index.html.twig', array(
        'jeus' => $jeus,
    ));
}












    /**
     * Lists all jeu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jeus = $em->getRepository('EspritGameHubBundle:Jeu')->findAll();
        return $this->render('EspritGameHubBundle:jeu:index.html.twig', array(
            'jeus' => $jeus,
        ));
    }

    /**
     * Creates a new jeu entity.
     *
     */
    public function newAction(Request $request)
    {
        $jeu = new Jeu();
        $form = $this->createForm('Esprit\GameHubBundle\Form\JeuType', $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jeu);
            $em->flush($jeu);

            return $this->redirectToRoute('jeu_show', array('id' => $jeu->getId()));
        }

        return $this->render('EspritGameHubBundle:jeu:new.html.twig', array(
            'jeu' => $jeu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jeu entity.
     *
     */
    public function showAction(Jeu $jeu)
    {
        $deleteForm = $this->createDeleteForm($jeu);

        return $this->render('EspritGameHubBundle:jeu:show.html.twig', array(
            'jeu' => $jeu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jeu entity.
     *
     */
    public function editAction(Request $request, Jeu $jeu)
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Seul les admins peuvent modifier le contenu.');
        }

        $deleteForm = $this->createDeleteForm($jeu);
        $editForm = $this->createForm('Esprit\GameHubBundle\Form\JeuType', $jeu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jeu_edit', array('id' => $jeu->getId()));
        }

        return $this->render('EspritGameHubBundle:jeu:edit.html.twig', array(
            'jeu' => $jeu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jeu entity.
     *
     */
    public function deleteAction(Request $request, Jeu $jeu)
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Seul les admins peuvent supprimer le contenu.');
        }
        $form = $this->createDeleteForm($jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jeu);
            $em->flush();
        }

        return $this->redirectToRoute('jeu_index');
    }

    /**
     * Creates a form to delete a jeu entity.
     *
     * @param jeu $jeu The jeu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Jeu $jeu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jeu_delete', array('id' => $jeu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
