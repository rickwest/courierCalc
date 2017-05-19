<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Quote;
use AppBundle\Form\Model\Job;
use AppBundle\Form\Type\JobFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Quote controller.
 *
 * @Route("quote")
 */
class QuoteController extends Controller
{
    public function getQuoteCreator() {
        return $this->get('app.quote.quote_creator');
	}

    public function getDistanceGenerator() {
        return $this->get('app.distance_generator');
	}

	/**
     * @Route("/", name="quote_index")
     */
    public function indexAction() {
		$userId = $this->getUser()->getId();

		$quotes = $this->getDoctrine()
			->getRepository('AppBundle:Quote')
			->findByUserId($userId)
		;

		return $this->render('AppBundle:Quote:index.html.twig', [
			'quotes' => $quotes
		]);
    }

    /**
     * @Route("/new", name="quote_new")
     */
    public function createAction(Request $request) {
        $userId = $this->getUser()->getId();

        $form = $this->createForm(JobFormType::class, new Job(), ['userId' => $userId]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $job = $form->getData();
            $job->setUserId($userId);

            list ($distance, $duration) = $this->getDistanceGenerator()->getDistance(
                $job->getStart(),
                $job->getDestination(),
                $job->getVia()
            );

            $job->setDistance($this->getQuoteCreator()->convertMetresToMiles($distance))
                ->setDuration($duration)
            ;

            /** @var Quote $quote */
            $quote = $this->getQuoteCreator()->createQuote($job);

            return $this->redirectToRoute('quote_show', [
                'quote' => $quote->getId()
            ]);
        }

//		//check to see whether user has any fee scales
//		$feeScales = $this->getDoctrine()
//			->getRepository('AppBundle:FeeScale')
//			->findByUserId($userId);
//
//		if (!$feeScales) {
//			return $this->addFlash('notice', 'You need to create a fee scale before you are able to generate a quote');
//		}

		return $this->render('AppBundle:Quote:create.html.twig', [
			'form' => $form->createView()
			]
		);
    }

    /**
     * @Route("/show/{quote}", name="quote_show")
     */
    public function showAction(Quote $quote) {
        $userId = $this->getUser()->getId();

    	//need to check that the logged in user is the owner of the quote
		if ($quote->getUserId() !== $userId) {
			//add flash and redirect?
		}

		$vehicleType = array_search($quote->getVehicleTypeId(), JobFormType::getVehicleTypeChoices());

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