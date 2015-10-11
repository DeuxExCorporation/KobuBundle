<?php

namespace Destiny\KobuBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;


/**
 * ProtectorasRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProtectorasRepository extends EntityRepository
{
    public function getAll($elemento, $usuario,$rol,$orden)
    {

        unset($elemento);

        $em = $this->getEntityManager ();

        $query = $em->createQueryBuilder();

        $list = $query->select('p','u')
                ->from('DestinyKobuBundle:Protectoras','p')
                ->innerJoin('p.usuarios','u');

        if (!$rol->isGranted('ROLE_ROOT'))
        {
            $list = $query ->where($query->expr()->eq('u.username',':username'))
                ->setParameters([':username' => $usuario->getUsername()]);
        }


        if (!is_null($orden))
        {

           ($orden['order'] === 'usuarios')
                        ? $list->orderBy('u.username', strtoupper( $orden['asc']))
                        : $list->orderBy('p.'.$orden['order'] ,strtoupper( $orden['asc']));
        }



        return $list->getQuery()->getResult();

    }
}
