<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
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
            ->add('owner')
            ->add('address')
            ->add('website', UrlType::class)
            ->add('hostLanguages')
            ->add('breakfast')
            ->add('breakfastPrice', MoneyType::class, [
                'currency' => 'CUC'
            ])
            ->add('dinner')
            ->add('dinnerPrice', MoneyType::class, [
                'currency' => 'CUC'
            ])
            ->add('cocktails')
            ->add('childrenAccepted')
            ->add('garage')
            ->add('garagePrice')
            ->add('swimmingPool')
            ->add('laundry')
            ->add('internet')
            ->add('wifi')
            ->add('location')
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
