<?php
namespace Argidomin\KobuBundle\DataFixtures\ORM;


use Destiny\KobuBundle\Entity\MensajesProtectoras;
use Destiny\KobuBundle\Entity\ProtectorasRedesSociales;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\AbstractFixture;


class MessagesProtectorasLoader extends AbstractFixture implements  FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $redesSociales = ['Facebook' => ['nombre' => 'Facebook',
                                         'url'    => 'http://www.facebook.com/',
                                         'icono'  => '<i class="fa fa-facebook-official"></i>']];

        $protectoras = $manager->getRepository('DestinyKobuBundle:Protectoras')->findAll();

        foreach ($protectoras as $protectora)
        {
            $rrss = new ProtectorasRedesSociales();
            $rrss->setNombre($redesSociales['Facebook']['nombre']);
            $rrss->setUrl($redesSociales['Facebook']['url'].rand(1,100));
            $rrss->setIconoFA($redesSociales['Facebook']['icono']);
            $rrss->setEstado(true);
            $rrss->setProtectora($protectora);

            $manager->persist($rrss);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 26; // the order in which fixtures will be loaded
    }
}