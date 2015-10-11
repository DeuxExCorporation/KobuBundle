<?php

namespace Destiny\KobuBundle\Form\Type;


use Destiny\KobuBundle\Entity\ProtectorasPerros;
use Destiny\KobuBundle\Entity\ProtectorasRazasPerros;
use Destiny\KobuBundle\Entity\ProtectorasRedesSociales;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;


class ProtectorasRazaPerrosType extends AbstractType
{
    protected $em, $translator;


    public function __construct (EntityManager $EntityManager, Translator $translator)
    {
        $this->em         = $EntityManager;
        $this->translator = $translator;


    }


    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('nombre', 'text', ['label' => $this->translator->trans ('protectorasRazaPerros.form.nombre')])
            ->add('descripcion', 'textarea', ['label' => $this->translator->trans ('protectorasRazaPerros.form.description')])
            ->add ('estado', 'choice', ['label' => $this->translator->trans ('protectorasRazaPerros.form.estado'),
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
            'data_class' => 'Destiny\KobuBundle\Entity\ProtectorasRazasPerros'
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
        return 'destiny_kobubundle_protectoras_raza_perros';
    }

    public function newEntity ()
    {
        $raza = new ProtectorasRazasPerros();

        return $raza;
    }


}
