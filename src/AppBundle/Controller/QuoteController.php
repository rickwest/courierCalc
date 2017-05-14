<?php

namespace AppBundle\Controller;

use AppBundle\Form\Model\QuoteFormModel;
use AppBundle\Form\Type\QuoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class QuoteController extends Controller
{
    /** @Route */


	/**
     * @Route("/quote/index")
     */
    public function indexAction() {
        return $this->render('AppBundle:Quote:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/quote/create")
     */
    public function createAction(Request $request) {

		$formModel = new QuoteFormModel();

		$form = $this->createForm(QuoteType::class, $formModel);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$formModel = $form->getData();
			dump($formModel);
		}

		return $this->render('AppBundle:Quote:create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/quote/show")
     */
    public function showAction()
    {
        return $this->render('AppBundle:Quote:show.html.twig', array(
            // ...
        ));
    }

}