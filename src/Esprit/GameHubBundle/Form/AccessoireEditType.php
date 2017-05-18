<?php

namespace Esprit\GameHubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccessoireEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomProduit')->add('prixProduit')
            ->add('processeurP')->add('disqueDurP')->add('memoireP')->add('carteGraphiqueP')
            ->add('longueur', FileType::class , array('data_class' => null,'required' => false))
            ->add('poids')->add('nomClavier')
            ->add('nomSouris')->add('longueurCable')
            ->add('typeCasque')->add('systemAcoustique')->add('nomCasque');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Esprit\GameHubBundle\Entity\Accessoire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'esprit_gamehubbundle_accessoire';
    }


}
