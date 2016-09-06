<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HostelImageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => false,
                'download_link' => false,
            ])
            ->add('partOfTheHouse', EntityType::class, [
                'multiple' => false,
                'class' => 'AppBundle:PartOfTheHouse',
                'expanded' => 'true',
                'translation_domain' => false,
            ])
            ->add('description')
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event) {
                    $form = $event->getForm();
                    $hostelImage = $event->getData();

                    $hostel = $hostelImage->getHostel();
                    $rooms = null === $hostel ? [] : $hostel->getRooms();

                    $form->add('room', EntityType::class, [
                        'class' => 'AppBundle:Room',
                        'choices' => $rooms,
                        'translation_domain' => false,
                        'required' => false,
                    ]);
                }
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\HostelImage'
        ));
    }
}
