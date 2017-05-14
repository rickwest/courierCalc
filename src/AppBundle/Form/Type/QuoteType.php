<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 31/03/2017
 * Time: 21:37
 */

namespace AppBundle\Form\Type;

use AppBundle\Form\ChoiceHelper\ChoiceHelper;
use AppBundle\Form\Model\QuoteFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('start', TextType::class)
            ->add('destination', TextType::class)
            ->add('via', TextType::class, [
                'required' => false
            ])
			->add('feeScaleId', ChoiceType::class, [
				'label' => 'Fee Scale',
				'choices' => ChoiceHelper::getFeeScaleChoices()
			])
            ->add('vehicleTypeId', ChoiceType::class, [
            	'label' => 'Vehicle Type',
                'choices' => ChoiceHelper::getVehicleTypeChoices()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => QuoteFormModel::class
        ]);
    }
}