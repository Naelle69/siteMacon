<?php

namespace App\Controller\Admin;

use App\Entity\Chantiers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ChantiersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chantiers::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),

            TextField::new('nom')->setLabel('Nom du chantier'),

            TextEditorField::new('description')->setLabel('Description'),

            ImageField::new('imagePrincipale')
                ->setBasePath('uploads/chantiers')
                ->setUploadDir('public/uploads/chantiers')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setLabel('Image principale'),

            ArrayField::new('carrouselImages')
                ->setLabel('Images du carrousel')
                ->onlyOnDetail(), // affichage en lecture seule
        ];
    }
}

