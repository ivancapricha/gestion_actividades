<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
class RoleType extends AbstractType
{
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'choices' => array(
				'ROLE_USER' => 'ROLE_USER',
				'ROLE_ADMIN' => 'ROLE_ADMIN',
			)
		));
	}

	public function getParent()
	{
		return 'choice';
	}

	public function getName()
	{
		return 'role';
	}
}

?>