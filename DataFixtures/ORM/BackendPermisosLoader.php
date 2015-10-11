<?php
namespace Argidomin\KobuBundle\DataFixtures\ORM;



use Destiny\KobuBundle\Entity\BackendPermisosKobu;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\AbstractFixture;


class BackendPermisosLoader extends AbstractFixture implements  FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
		$entidades =[
                        [ 'nombre' => 'Mensajes(Protectoras)',
                          'entidad'=> 'ProtectorasMensajes',],
                        [ 'nombre' => 'Protectoras',
                          'entidad'=> 'Protectoras'],
            [ 'nombre' => 'Perros',
                'entidad'=> 'ProtectorasPerros'],
            [ 'nombre' => 'Razas',
                'entidad'=> 'ProtectorasRazasPerros'],
                    [ 'nombre' => 'Redes Sociales(Protectoras)',
                        'entidad'=> 'ProtectorasRedesSociales'],
                        [ 'nombre' => 'Permisos',
                          'entidad'=> 'BackendPermisosKobu'],
                    ];

	    foreach ($entidades as $entidad)
	    {
		    $permiso = new BackendPermisosKobu();
			$permiso->setNombre($entidad['nombre'])->setEntidad($entidad['entidad'])->setCrear(true)->setEditar(true)->setBorrar(true)->setEstado(true);

		    $manager->persist($permiso);
	    }



        $manager->flush();
    }

    public function getOrder()
    {
        return 3001; // the order in which fixtures will be loaded
    }
}