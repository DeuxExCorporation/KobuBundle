<?php
namespace Argidomin\KobuBundle\DataFixtures\ORM;

use Destiny\KobuBundle\Entity\ProtectorasMensajes;
use Destiny\KobuBundle\Entity\ProtectorasPerros;
use Destiny\KobuBundle\Entity\ProtectorasRazasPerros;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\Validator\Constraints\True;

class ProtectoraRazaPerrosLoader extends AbstractFixture implements  FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {




        for ($i=0;$i!=3;$i++)
        {
                $perro = new ProtectorasRazasPerros();
                $perro->setNombre('Raza Kobu '.$i)
                    ->setDescripcion('Superkobu')
                    ->setEstado(true);

                $manager->persist($perro);


        }
        $manager->flush();

    }

    public function getOrder()
    {
        return 27; // the order in which fixtures will be loaded
    }
}