<?php

namespace Destiny\KobuBundle\Form\Type;


use Destiny\KobuBundle\Entity\ProtectorasRedesSociales;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;


class ProtectorasRedesSocialesType extends AbstractType
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
            ->add ('nombre', 'text', ['label' => $this->translator->trans ('empresaRedesSociales.form.nombre')])
            ->add ('iconoFA', 'text', ['label' => $this->translator->trans ('empresaRedesSociales.form.icono')])
            ->add ('url', 'url', ['label' => $this->translator->trans ('empresaRedesSociales.form.url')])
            ->add ('estado', 'choice', ['label' => $this->translator->trans ('empresaRedesSociales.form.estado'),
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
            'data_class' => 'Destiny\KobuBundle\Entity\ProtectorasRedesSociales'
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
        return 'destiny_kobubundle_redes_sociales_protectoras';
    }

    public function newEntity ()
    {
        $prtectora = new ProtectorasRedesSociales();

        return $prtectora;
    }


    public function groups ($tipo = null )
    {

        $group = $this->em->getRepository('DestinyKobuBundle:Protectoras')->getAll(null,$this->user->getToken(), $this->cheker,null);

        return $group;


    }


}
