<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),

            TextField::new('nom')->setLabel('Nom du service'),

            TextEditorField::new('description')->setLabel('Description'),

            ImageField::new('image')
                ->setBasePath('uploads/services')
                ->setUploadDir('public/uploads/services')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setLabel('Image'),
        ];
    }
}
