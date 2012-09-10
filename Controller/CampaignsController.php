<?php

namespace Emtags\Bundle\NewsletterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Emtags\Bundle\NewsletterBundle\Entity\Campaigns;
use Emtags\Bundle\NewsletterBundle\Form\CampaignsType;

/**
 * Campaigns controller.
 *
 */
class CampaignsController extends Controller
{
    /**
     * Lists all Campaigns entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmtagsNewsletterBundle:Campaigns')->findAll();

        return $this->render('EmtagsNewsletterBundle:Campaigns:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Campaigns entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Campaigns')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campaigns entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmtagsNewsletterBundle:Campaigns:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Campaigns entity.
     *
     */
    public function newAction()
    {
        $entity = new Campaigns();
        $form   = $this->createForm(new CampaignsType(), $entity);

        return $this->render('EmtagsNewsletterBundle:Campaigns:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Campaigns entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Campaigns();
        $form = $this->createForm(new CampaignsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_campaigns_show', array('id' => $entity->getId())));
        }

        return $this->render('EmtagsNewsletterBundle:Campaigns:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Campaigns entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Campaigns')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campaigns entity.');
        }

        $editForm = $this->createForm(new CampaignsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmtagsNewsletterBundle:Campaigns:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Campaigns entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Campaigns')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campaigns entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CampaignsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_campaigns_edit', array('id' => $id)));
        }

        return $this->render('EmtagsNewsletterBundle:Campaigns:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Campaigns entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmtagsNewsletterBundle:Campaigns')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Campaigns entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('newsletter_campaigns'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
