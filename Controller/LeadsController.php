<?php

namespace Emtags\Bundle\NewsletterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Emtags\Bundle\NewsletterBundle\Entity\Leads;
use Emtags\Bundle\NewsletterBundle\Form\LeadsType;

/**
 * Leads controller.
 *
 */
class LeadsController extends Controller
{
    /**
     * Lists all Leads entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmtagsNewsletterBundle:Leads')->findAll();

        return $this->render('EmtagsNewsletterBundle:Leads:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Leads entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Leads')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Leads entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmtagsNewsletterBundle:Leads:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
	
	/**
     * Finds and displays a Leads entity.
     *
     */
    public function disableAction($email)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Leads')->findOneBy(array('email' => $email));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Leads entity.');
        }
		
		$entity->setEnable(false);
		$em->persist($entity);
		$em->flush();

        return $this->render('EmtagsNewsletterBundle:Leads:disable.html.twig', array(
            'entity'      => $entity,
		));
    }

    /**
     * Displays a form to create a new Leads entity.
     *
     */
    public function newAction()
    {
        $entity = new Leads();
        $form   = $this->createForm(new LeadsType(), $entity);

        return $this->render('EmtagsNewsletterBundle:Leads:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Leads entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Leads();
        $form = $this->createForm(new LeadsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_leads_show', array('id' => $entity->getId())));
        }

        return $this->render('EmtagsNewsletterBundle:Leads:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Leads entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Leads')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Leads entity.');
        }

        $editForm = $this->createForm(new LeadsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmtagsNewsletterBundle:Leads:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Leads entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmtagsNewsletterBundle:Leads')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Leads entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new LeadsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_leads_edit', array('id' => $id)));
        }

        return $this->render('EmtagsNewsletterBundle:Leads:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Leads entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmtagsNewsletterBundle:Leads')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Leads entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('newsletter_leads'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
