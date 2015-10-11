<?php
namespace Argidomin\KobuBundle\DataFixtures\ORM;


use Destiny\AppBundle\Entity\Usuarios;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class UsuariosLoader extends AbstractFixture implements  FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
	private $container;

	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}
	public function load(ObjectManager $manager)
	{
		for ($i=0; $i<2; $i++)
		{
			$usuario = new Usuarios();

			$usuario->setUsername('usuario_protectora'.$i);

			$usuario->setEmail('usuario_protectora'.$i.'@localhost.dev');

			$encoder = $this->container->get('security.encoder_factory')
				->getEncoder($usuario);
			$usuario->setRoles(['ROLE_PROTECTORA']);

			$password = $encoder->encodePassword('contraseña', $usuario->getSalt());
			$usuario->setPassword($password);
            $usuario->setEstado(true);
			$manager->persist($usuario);
		}



		$manager->flush();
	}

	public function getOrder()
	{
		return 5; // the order in which fixtures will be loaded
	}
}