<?php

namespace Destiny\KobuBundle\Form\Type;




use Destiny\AppBundle\Form\Type\BackendPermisosType;
use Destiny\KobuBundle\Entity\BackendPermisosKobu;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Class IdiomasType
 * @package Destiny\AppBundle\Form
 *

 */
class BackendPermisosKobuType extends AbstractType
{
	protected $em, $translator,$backend;


	public function __construct (EntityManager $em, Translator $translator, BackendPermisosType $backendPermisos)
	{
		$this->em = $em;
		$this->translator = $translator;
        $this->backend = $backendPermisos;

	}

	/**
	 * @param FormBuilderInterface $builder
	 * @param array                $options
	 */
	public function buildForm (FormBuilderInterface $builder, array $options)
	{
		$builder
			->add ('estado', 'choice', ['label' => $this->translator->trans ('BackendPermisos.form.status'),
				'choices' => [TRUE => $this->translator->trans ('BackendPermisos.form.yes'),
					FALSE => $this->translator->trans ('BackendPermisos.form.no')]])

			->add ('crear', 'choice', ['label' => $this->translator->trans ('BackendPermisos.form.create'),
				'choices' => [TRUE => $this->translator->trans ('BackendPermisos.form.yes'),
					          FALSE => $this->translator->trans ('BackendPermisos.form.no')]])

			->add ('editar', 'choice', ['label' => $this->translator->trans ('BackendPermisos.form.edit'),
				   					    'choices' => [TRUE => $this->translator->trans ('BackendPermisos.form.yes'),
								 				      FALSE => $this->translator->trans ('BackendPermisos.form.no')]])

			->add ('borrar', 'choice', ['label' => $this->translator->trans ('BackendPermisos.form.delete'),
				   						'choices' => [TRUE => $this->translator->trans ('BackendPermisos.form.yes'),
							     					  FALSE => $this->translator->trans ('BackendPermisos.form.no')]])

            ->add('grupos', 'entity', array(
                'class' => 'DestinyAppBundle:RolesUsuarios',
                'label' => $this->translator->trans ('BackendPermisos.form.grups'),
                'required' => false,
                'expanded' => false,
                'multiple' => true,
                'choice_label' => 'nombre',
                'query_builder' => function(EntityRepository $er)  {

                    return $er->createQueryBuilder('g')
                        ->orderBy('g.grupo');}))
			;

	}

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults (array (
			'data_class' => 'Destiny\KobuBundle\Entity\BackendPermisosKobu'
		));
	}

	/**
	 * @return string
	 */
	public function getName ()
	{
		return 'destiny_kobubundle_permisos';
	}

    public function newEntity ()
    {
        return new BackendPermisosKobu();
    }


	public function isDeletable ()
	{
		return false;
	}

	public function isChangeable ($entidad)
	{

		return TRUE;
	}

	public function cantCreate ()
	{

		return TRUE;
	}

    public function postEdit(BackendPermisosKobu $entidad)
    {
        $this->backend->postEdit($entidad);
    }

    public function postChange(BackendPermisosKobu $entidad)
    {
        $this->backend->postChange($entidad);
    }
}
