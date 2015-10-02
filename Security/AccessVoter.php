<?php

namespace Destiny\KobuBundle\Security;


use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;


class AccessVoter extends AbstractVoter
{
    const VIEW   = 'view';
    const EDIT   = 'edit';
    const CREATE = 'create';
    const DELETE = 'delete';


    protected function getSupportedAttributes()
    {
        return array(self::VIEW, self::EDIT, self::CREATE, self::DELETE);
    }

    protected function getSupportedClasses()
    {
        return ['Destiny\KobuBundle\Entity\Protectoras'];
    }

    protected function isGranted($accion, $entidad, $user = null)
    {

        $resultado = in_array('ROLE_ROOT',$user->getRoles()) ? true : false;

        if ( $accion === self::EDIT && $resultado === false)
        {

            switch($accion)
            {
                case self::VIEW:

                  $resultado = ($entidad->getEstado() === true) ? true : false;

                    return $resultado;



                    break;

                case self::EDIT:
                    $resultado = ($entidad->getEditar() === true) ? false : true;

                    return $resultado;



                    break;

                case self::DELETE:
                 $resultado = ($entidad->getBorrar() === true) ? true : false;
                    return $resultado;



                    break;

                case self::CREATE:
                  $resultado = ($entidad->getCrear() === true) ? true : false;
                    return $resultado;




                    break;

            }

        }
        return true;
    }

}
