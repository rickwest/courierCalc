<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 16/05/17
 * Time: 19:40
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('name', TextType::class, [
				'label' => false
			])
			->add('lat', HiddenType::class, [
				'required' => false
			])
			->add('lon', HiddenType::class, [
				'required' => false
			])
		;
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver
			->setDefaults([
				'data_class' => Location::class
			])
		;
	}
}