<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 31/03/2017
 * Time: 21:37
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\FeeScale;
use AppBundle\Entity\Quote;
use AppBundle\Form\Model\Job;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobFormType extends AbstractType {

	/** @var EntityManager $em */
	protected $em;

	public function __construct(EntityManager $em) {
		$this->em = $em;
	}

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('start', LocationType::class)
            ->add('destination', LocationType::class)
            ->add('via', LocationType::class, [
                'required' => false
            ])
			->add('feeScaleId', ChoiceType::class, [
				'label' => 'Fee Scale',
				'choices' => $this->getFeeScaleChoices($options['userId'])
			])
            ->add('vehicleTypeId', ChoiceType::class, [
            	'label' => 'Vehicle Type',
                'choices' => $this->getVehicleTypeChoices()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Job::class,
			'userId' => null
        ]);
    }

	public function getFeeScaleChoices($userId) {
		$feeScales = $this->em
			->getRepository('AppBundle:FeeScale')
			->findByUserId($userId);

		$result = [];
		/** @var FeeScale $feeScale */
		foreach ($feeScales as $feeScale) {
			$result[$feeScale->getName()] = $feeScale->getId();
		}
		return $result;
	}

	public static function getVehicleTypeChoices() {
		return [
			'Small Van' => Quote::VEHICLE_TYPE_SMALL_VAN,
			'SWB Van' => Quote::VEHICLE_TYPE_SWB,
			'LWB Van' => Quote::VEHICLE_TYPE_LWB,
			'Luton' => Quote::VEHICLE_TYPE_LUTON,
			'Arctic' => Quote::VEHICLE_TYPE_ARCTIC,
			'Special' => Quote::VEHICLE_TYPE_SPECIAL,
		];
	}
}