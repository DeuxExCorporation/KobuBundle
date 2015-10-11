<?php
namespace Argidomin\KobuBundle\DataFixtures\ORM;


use Destiny\AppBundle\Entity\BackendGruposSecciones;
use Destiny\AppBundle\Entity\BackendSecciones;
use Destiny\AppBundle\Entity\GruposMenusBackend;
use Destiny\AppBundle\Entity\MenusBackend;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\AbstractFixture;


class MenuBackendLoader extends AbstractFixture implements  FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
		$grupos = [
					['nombre'    => 'Kobu App',
					 'etiqueta'  => 'configuration.list.kobu',
				 	 'secciones' => [
                                 ['destino' => 'backendPermisosKobu',
                                     'icono'   => '<i class="fa fa-lock"></i>',
                                     'nombre'  => 'Permisos',
                                     'etiqueta' => 'configuration.list.permisos',
                                     'zona' => 'principal'],
                         ['destino' => 'protectoras',
                             'icono'   => '<i class="fa fa-university"></i>',
                             'nombre'  => 'Protectoras',
                             'etiqueta' => 'configuration.list.protectoras',
                             'zona' => 'superior'],
                         ['destino' => 'ProtectorasRedesSociales',
                             'icono'   => ' <i class="fa fa-share-alt-square"></i>',
                             'nombre'  => 'Redes Sociales',
                             'etiqueta' => 'configuration.list.redessocialesprotectoras',
                             'zona' => 'mensajes'],
                         ['destino' => 'ProtectorasMensajes',
                             'icono'   => ' <i class="fa fa-envelope-o"></i>',
                             'nombre'  => 'Mensajes',
                             'etiqueta' => 'configuration.list.mensajesProtectoras',
                             'zona' => 'mensajes'],

                         ['destino' => 'protectorasPerros',
                             'icono'   => '<i class="fa fa-list"></i>',
                             'nombre'  => 'Perros',
                             'etiqueta' => 'configuration.list.perros',
                             'zona' => 'superior'],
                         ['destino' => 'protectorasRazasPerros',
                             'icono'   => '<i class="fa fa-list"></i>',
                             'nombre'  => 'Razas',
                             'etiqueta' => 'configuration.list.razas',
                             'zona' => 'superior'],

								  ]],

			];


	    foreach($grupos as $menu)
	    {
		    $grupo = new BackendGruposSecciones();
		    $grupo->setNombre($menu['nombre'])->setEtiqueta($menu['etiqueta'])->setEstado(true)->setLimite(0);

		    $manager->persist($grupo);

		    foreach($menu['secciones'] as $seccion)
		    {

			    $seccionBackend = new BackendSecciones();
			    $seccionBackend->setNombre($seccion['nombre'])
				               ->setDestino($seccion['destino'])
				               ->setIcono($seccion['icono'])
				               ->setEtiqueta($seccion['etiqueta'])
                                ->setZona($seccion['zona'])
				               ->setGrupo($grupo)
			                   ->setEstado(TRUE);

			    $manager->persist($seccionBackend);
		    }

	    }

        $manager->flush();
    }

    public function getOrder()
    {
        return 24; // the order in which fixtures will be loaded
    }
}