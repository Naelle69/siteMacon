<?php

namespace App\Controller\Admin;

use App\Entity\DomainesExpertise;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;

class DomainesExpertiseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DomainesExpertise::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),

            TextField::new('nom')->setLabel('Nom du domaine'),

            TextField::new('icone')->setLabel('Classe de l’icône'),

            ColorField::new('couleurIcone')->setLabel('Couleur de l’icône'),

            TextEditorField::new('description')->setLabel('Description'),
        ];
    }
}
