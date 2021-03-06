<?php

namespace Emtags\Bundle\NewsletterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Emtags\Bundle\NewsletterBundle\Entity\Tags;
use Emtags\Bundle\NewsletterBundle\Form\TagsType;

/**
 * Tags controller.
 *
 */
class TagsController extends Controller
{
    /**
     * Lists all Tags entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmtagsNewsletterBundle:Tags')->findAll();

        return $this->render('EmtagsNewsletterBundle:Tags:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Tags entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Tags')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tags entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmtagsNewsletterBundle:Tags:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Tags entity.
     *
     */
    public function newAction()
    {
        $entity = new Tags();
        $form   = $this->createForm(new TagsType(), $entity);

        return $this->render('EmtagsNewsletterBundle:Tags:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Tags entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Tags();
        $form = $this->createForm(new TagsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_tags_show', array('id' => $entity->getId())));
        }

        return $this->render('EmtagsNewsletterBundle:Tags:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tags entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Tags')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tags entity.');
        }

        $editForm = $this->createForm(new TagsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmtagsNewsletterBundle:Tags:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Tags entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Tags')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tags entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TagsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_tags_edit', array('id' => $id)));
        }

        return $this->render('EmtagsNewsletterBundle:Tags:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tags entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmtagsNewsletterBundle:Tags')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tags entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('newsletter_tags'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
