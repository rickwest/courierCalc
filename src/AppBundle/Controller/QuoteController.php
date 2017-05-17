<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Fee;
use AppBundle\Entity\Quote;
use AppBundle\Form\Model\QuoteFormModel;
use AppBundle\Form\Type\QuoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class QuoteController extends Controller
{

	public function checkPermission() {
		if(!$this->getUser()) {
			throw new AccessDeniedException('You do not have permission to access this page');
		}
		return $this->getUser()->getId();
	}

	/**
     * @Route("/quotes", name="quotes")
     */
    public function indexAction() {
		$userId = $this->checkPermission();

		$quotes = $this->getDoctrine()
			->getRepository('AppBundle:Quote')
			->findByUserId($userId)
		;

		return $this->render('AppBundle:Quote:index.html.twig', [
			'quotes' => $quotes
		]);
    }

    /**
     * @Route("/quote/create", name="createQuote")
     */
    public function createAction(Request $request) {
		$userId = $this->checkPermission();

    	$formModel = new QuoteFormModel();

		$form = $this->createForm(QuoteType::class, $formModel, ['userId' => $userId]);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$formModel = $form->getData();

			$start = $formModel->getStart();
			$destination = $formModel->getDestination();
			$via = $formModel->getVia();

			$vehicleTypeId = $formModel->getVehicleTypeId();
			$feeScaleId = $formModel->getFeeScaleId();

			list($route, $polyline) = $this->get('google_distance_generator')->getRouteDetails($start, $destination, $via);

			$distance = $this->get('quote_creator')->convertMetresToMiles($route['distance']['value']);
			$duration = $route['duration']['text'];

			$feeScale = $this->getDoctrine()->getManager()
				->getRepository('AppBundle:FeeScale')
				->findOneBy(['id' => $formModel->getFeeScaleId()]);

			$fees = $feeScale->getFees();

			if (!$fees) {
				//add flash message and redirect to show page;
			}

			$price = 0;
			$cost = 0;

			foreach ($fees as $fee) {
				/** @var Fee $fee */
				if($fee->getVehicleTypeId() === $vehicleTypeId) {
					switch ($fee->getFeeTypeId()) {
						case Quote::FEE_TYPE_PER_MILE:
							$price += ($fee->getPrice() * $distance);
							$cost += ($fee->getCost() * $distance);
							break;
					}
				}
			}

			$quote = new Quote;
			$quote
				->setUserId($userId)
				->setPrice($price)
				->setCost($cost)
				->setStart($start)
				->setDestination($destination)
				->setVehicleTypeId($vehicleTypeId)
				->setVia($via)
				->setDistance($distance)
				->setDuration($duration)
				->setFeeScaleId($feeScaleId);
			;
			$em = $this->getDoctrine()->getManager();
			$em->persist($quote);
			$em->flush();

			return $this->redirectToRoute('quoteShow', [
				'quote' => $quote->getId()
			]);
		}

		//check to see whether user has any fee scales
		$feeScales = $this->getDoctrine()
			->getRepository('AppBundle:FeeScale')
			->findByUserId($userId);

		if (!$feeScales) {
			return $this->addFlash('notice', 'You need to create a fee scale before you are able to generate a quote');
		}

		return $this->render('AppBundle:Quote:create.html.twig', [
			'form' => $form->createView()
			]
		);
    }

    /**
     * @Route("/quote/show/{quote}", name="quoteShow")
     */
    public function showAction(Quote $quote) {
		$userId = $this->checkPermission();

    	//need to check that the logged in user is the owner of the quote
		if ($quote->getUserId() !== $userId) {
			//add flash and redirect?
		}

		$vehicleType = array_search($quote->getVehicleTypeId(), QuoteType::getVehicleTypeChoices());

		$feeScaleId = $quote->getFeeScaleId();

		$feeScale = $this->getDoctrine()->getManager()
			->getRepository('AppBundle:FeeScale')
			->findOneBy(['id' => $feeScaleId]);

        return $this->render('AppBundle:Quote:show.html.twig', [
        	'quote' => $quote,
			'feeScale' => $feeScale,
			'vehicleType' => $vehicleType
		]);
    }

}