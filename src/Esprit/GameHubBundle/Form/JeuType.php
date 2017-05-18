<?php
namespace Esprit\GameHubBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class JeuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('prix')
            ->add('dateSortie',DateType::class, ['widget' => 'single_text', 'format' => 'dd-MM-yyyy'])
            ->add('evaluation')
            ->add('plateforme')
            ->add('historique')
            ->add('lien')
            ->add('categorie')
            ->add('caracteristique')
            ->add('description')
            ->add('imageFile',VichFileType::class,array('label' => 'upload file',
                'attr'=> array('class'=> 'fileContainer'),
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true

            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Esprit\GameHubBundle\Entity\Jeu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'whysawbundle_jeu';
    }


}
