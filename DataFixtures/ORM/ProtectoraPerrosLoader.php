<?php
namespace Argidomin\KobuBundle\DataFixtures\ORM;

use Destiny\KobuBundle\Entity\ProtectorasMensajes;
use Destiny\KobuBundle\Entity\ProtectorasPerros;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\Validator\Constraints\True;

class ProtectoraPerrosLoader extends AbstractFixture implements  FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {


        $protectoras = $manager->getRepository('DestinyKobuBundle:Protectoras')->findAll();

        for ($i=0;$i!=3;$i++)
        {

                foreach ($protectoras as $protectora)
            {
                $perro = new ProtectorasPerros();
                $perro->setNombre('Kobu '.uniqid())
                    ->setDescripcion('Superkobu')
                    ->setProtectora($protectora)
                    ->setRaza($manager->getRepository('DestinyKobuBundle:ProtectorasRazasPerros')->findOneById(rand(1,3)))
                    ->setEstado(true);

                $manager->persist($perro);
            }
            $manager->flush();
        }


    }

    public function getOrder()
    {
        return 28; // the order in which fixtures will be loaded
    }
}