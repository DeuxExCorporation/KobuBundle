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
            $potectora = new Protectoras();
            $potectora->setNombre('Nombre '.$i)->setDescripcion('Nombre')->setEstado(true);


            $manager->persist($potectora);
        }



        $manager->flush();
    }

    public function getOrder()
    {
        return 25; // the order in which fixtures will be loaded
    }
}