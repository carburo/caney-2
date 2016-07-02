<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HostelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hostelName')
            ->add('description', TextareaType::class)
            ->add('address')
            ->add('hostLanguages')
            ->add('privateBathroom')
            ->add('airConditioner')
            ->add('hairDryer')
            ->add('towelsInTheRoom')
            ->add('cleanSheets')
            ->add('bathroomItems')
            ->add('breakfastPrice')
            ->add('dinnerPrice')
            ->add('internet')
            ->add('wifi')
            ->add('highSeason')
            ->add('otherServices', null, array(
                'expanded' => 'true'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Hostel'
        ));
    }
}
