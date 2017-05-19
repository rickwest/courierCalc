<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 15/05/17
 * Time: 19:26
 */

namespace AppBundle\Quote;


use AppBundle\DistanceGenerator\DistanceGeneratorInterface;
use AppBundle\Entity\Fee;
use AppBundle\Entity\Quote;
use AppBundle\Form\Model\Job;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class QuoteCreator {
	
	const METRES_TO_MILES_CONVERSION = 0.000621371;

	/** @var EntityManager $em */
	protected $em;
	/** @var DistanceGeneratorInterface $distanceGenerator */
	protected $distanceGenerator;

    public function __construct(
        EntityManager $em,
        DistanceGeneratorInterface $distanceGenerator
    ) {
        $this->em = $em;
        $this->distanceGenerator = $distanceGenerator;
    }
	
	public function convertMetresToMiles($metres) {
		return round($metres * self::METRES_TO_MILES_CONVERSION);
	}

	public function createQuote(Job $job) {
        $feeScale = $this->em
            ->getRepository('AppBundle:FeeScale')
            ->findOneBy(['id' => $job->getFeeScaleId()]);

        $fees = $feeScale->getFees();

        if (!$fees) {
            throw new NotFoundHttpException();
        }

        $price = 0;
        $cost = 0;

        foreach ($fees as $fee) {
            /** @var Fee $fee */
            if($fee->getVehicleTypeId() === $job->getVehicleTypeId()) {
                switch ($fee->getFeeTypeId()) {
                    case Quote::FEE_TYPE_PER_MILE:
                        $price += ($fee->getPrice() * $job->getDistance());
                        $cost += ($fee->getCost() * $job->getDistance());
                        break;
                }
            }
        }

        $quote = new Quote;
        $quote
            ->setUserId($job->getUserId())
            ->setPrice($price)
            ->setCost($cost)
            ->setStart($job->getStart())
            ->setDestination($job->getDestination())
            ->setVehicleTypeId($job->getVehicleTypeId())
            ->setVia($job->getVia())
            ->setDistance($job->getDistance())
            ->setDuration($job->getDuration())
            ->setFeeScaleId($job->getFeeScaleId());
        ;
        $this->em->persist($quote);
        $this->em->flush();

        return $quote;
    }
}