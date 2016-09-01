<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
//            ->add('owner', HiddenType::class)
            ->add('address')
            ->add('website', UrlType::class, [
                'required' => false
            ])
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
            ->add('garagePrice', MoneyType::class, [
                'currency' => 'CUC'
            ])
            ->add('swimmingPool')
            ->add('laundry')
            ->add('internet')
            ->add('wifi')
            ->add('location')
            ->add('guide')
            ->add('scubaDiving')
            ->add('horseRide')
//            ->add('otherServices', null, array(
//                'expanded' => 'true'
//            ))
//            ->add('rooms', CollectionType::class, [
//                'entry_type' => RoomType::class,
//                'allow_add' => true,
//            ])
//            ->add('images', CollectionType::class, [
//                'entry_type' => HostelImageType::class,
//                'allow_add' => true,
//            ])
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
