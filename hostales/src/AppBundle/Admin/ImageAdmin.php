<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageAdmin extends AbstractAdmin {
	
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
            ->add('imageFile', VichImageType::class, [
                'required'      => false,
                'allow_delete'  => false,
                'download_link' => false,
            ])
            ->add('description');
	}
	
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper->add('description');
	}
	
	protected function configureListFields(ListMapper $listMapper)
	{
        $listMapper->addIdentifier('description');
	}
}