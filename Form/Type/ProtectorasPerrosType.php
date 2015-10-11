<?php

namespace Destiny\KobuBundle\Form\Type;


use Destiny\KobuBundle\Entity\ProtectorasPerros;
use Destiny\KobuBundle\Entity\ProtectorasRedesSociales;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;


class ProtectorasPerrosType extends AbstractType
{
    protected $em, $translator, $user, $sesion, $cheker;


    public function __construct (EntityManager $EntityManager, Translator $translator, TokenStorage $user, AuthorizationChecker $checker)
    {
        $this->em         = $EntityManager;
        $this->translator = $translator;
        $this->user       = $user;
        $this->cheker     = $checker;

    }


    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('nombre', 'text', ['label' => $this->translator->trans ('protectorasPerros.form.nombre')])
            ->add('descripcion', 'textarea', ['label' => $this->translator->trans ('protectorasPerros.form.description')])
            ->add ('estado', 'choice', ['label' => $this->translator->trans ('protectorasPerros.form.estado'),
                'choices' => [TRUE => $this->translator->trans ('form.active'),
                    FALSE => $this->translator->trans ('form.desactive')]]);
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults (array (
            'data_class' => 'Destiny\KobuBundle\Entity\ProtectorasPerros'
        ));
    }

    public function isDeletable()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getName ()
    {
        return 'destiny_kobubundle_protectoras_perros';
    }

    public function newEntity ()
    {
        $perro = new ProtectorasPerros();

        return $perro;
    }

    public function listElements ()
    {
        return
            [
                $this->translator->trans ('protectorasPerros.list.raza') => 'Raza'
            ];

    }


    public function groups ($tipo = null )
    {

        $group = $this->em->getRepository('DestinyKobuBundle:Protectoras')->getAll(null,$this->user->getToken(), $this->cheker,null);

        return $group;


    }


}
