<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FeeScale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Feescale controller.
 *
 * @Route("feescale")
 */
class FeeScaleController extends Controller
{
    /**
     * Lists all feeScale entities.
     *
     * @Route("/", name="feescale_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $feeScales = $em->getRepository('AppBundle:FeeScale')->findAll();

        return $this->render('feescale/index.html.twig', array(
            'feeScales' => $feeScales,
        ));
    }

    /**
     * Creates a new feeScale entity.
     *
     * @Route("/new", name="feescale_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $feeScale = new Feescale();
        $form = $this->createForm('AppBundle\Form\FeeScaleType', $feeScale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feeScale);
            $em->flush();

            return $this->redirectToRoute('feescale_show', array('id' => $feeScale->getId()));
        }

        return $this->render('feescale/new.html.twig', array(
            'feeScale' => $feeScale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a feeScale entity.
     *
     * @Route("/{id}", name="feescale_show")
     * @Method("GET")
     */
    public function showAction(FeeScale $feeScale)
    {
        $deleteForm = $this->createDeleteForm($feeScale);

        return $this->render('feescale/show.html.twig', array(
            'feeScale' => $feeScale,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing feeScale entity.
     *
     * @Route("/{id}/edit", name="feescale_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FeeScale $feeScale)
    {
        $deleteForm = $this->createDeleteForm($feeScale);
        $editForm = $this->createForm('AppBundle\Form\FeeScaleType', $feeScale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('feescale_edit', array('id' => $feeScale->getId()));
        }

        return $this->render('feescale/edit.html.twig', array(
            'feeScale' => $feeScale,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a feeScale entity.
     *
     * @Route("/{id}", name="feescale_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FeeScale $feeScale)
    {
        $form = $this->createDeleteForm($feeScale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($feeScale);
            $em->flush();
        }

        return $this->redirectToRoute('feescale_index');
    }

    /**
     * Creates a form to delete a feeScale entity.
     *
     * @param FeeScale $feeScale The feeScale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FeeScale $feeScale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('feescale_delete', array('id' => $feeScale->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
