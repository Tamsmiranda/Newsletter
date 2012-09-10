<?php

namespace Emtags\Bundle\NewsletterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Emtags\Bundle\NewsletterBundle\Entity\Dispatches;
use Emtags\Bundle\NewsletterBundle\Form\DispatchesType;

/**
 * Dispatches controller.
 *
 */
class DispatchesController extends Controller
{
    /**
     * Lists all Dispatches entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmtagsNewsletterBundle:Dispatches')->findAll();

        return $this->render('EmtagsNewsletterBundle:Dispatches:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Dispatches entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Dispatches')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dispatches entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmtagsNewsletterBundle:Dispatches:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Dispatches entity.
     *
     */
    public function newAction()
    {
        $entity = new Dispatches();
        $form   = $this->createForm(new DispatchesType(), $entity);

        return $this->render('EmtagsNewsletterBundle:Dispatches:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Dispatches entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Dispatches();
        $form = $this->createForm(new DispatchesType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_dispatches_show', array('id' => $entity->getId())));
        }

        return $this->render('EmtagsNewsletterBundle:Dispatches:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Dispatches entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Dispatches')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dispatches entity.');
        }

        $editForm = $this->createForm(new DispatchesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmtagsNewsletterBundle:Dispatches:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Dispatches entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Dispatches')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dispatches entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DispatchesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_dispatches_edit', array('id' => $id)));
        }

        return $this->render('EmtagsNewsletterBundle:Dispatches:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Dispatches entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmtagsNewsletterBundle:Dispatches')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Dispatches entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('newsletter_dispatches'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
