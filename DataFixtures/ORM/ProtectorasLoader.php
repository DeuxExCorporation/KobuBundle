<?php
namespace Argidomin\KobuBundle\DataFixtures\ORM;



use Destiny\KobuBundle\Entity\Protectoras;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;


class ProtectorasLoader extends AbstractFixture implements  FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        for ($i=0;$i<=rand(3,10);$i++)
        {
            $var = rand(0,1);
            $potectora = new Protectoras();
            $potectora->setNombre('Protectora '.$i)->setDescripcion('Nombre')->setEstado(true);
            $potectora->addUsuario($manager->getRepository('DestinyAppBundle:Usuarios')->getOne('usuario_protectora'.$var))
                      ->setDireccion('Calle falsa 123')->setCiudad('Cambados')->setProvincia('Pontevedra')->setPais('España')
                      ->setTelefono(651029182)->setMovil(651029182);

            $manager->persist($potectora);
        }



        $manager->flush();
    }

    public function getOrder()
    {
        return 25; // the order in which fixtures will be loaded
    }
}