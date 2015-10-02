<?php

namespace Destiny\KobuBundle\Form\Type;


use Destiny\KobuBundle\Entity\Protectoras;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProtectorasType extends AbstractType
{
    protected $em, $translator;


    public function __construct (EntityManager $em, Translator $translator)
    {
        $this->em = $em;
        $this->translator = $translator;

    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('nombre', 'text', ['label' => $this->translator->trans ('protectoras.form.name'),
                'max_length' => 100])
            ->add('descripcion', 'textarea', ['label' => $this->translator->trans ('protectoras.form.description'),
                'max_length' => 150])
            ->add ('estado', 'choice', ['label' => $this->translator->trans ('protectoras.form.status'),
                'choices' => [TRUE => $this->translator->trans ('form.active'),
                    FALSE => $this->translator->trans ('form.desactive')]]);
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Destiny\KobuBundle\Entity\Protectoras'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'destiny_kobubundle_protectoras';
    }

    public function newEntity()
    {
        $protectora = new Protectoras();

        return $protectora;
    }

    public function isDeletable ()
    {

        return TRUE;
    }

    public function isChangeable ()
    {

        return TRUE;
    }

}
