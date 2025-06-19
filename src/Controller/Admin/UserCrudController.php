<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),

            EmailField::new('email'),
            TextField::new('nom')->setLabel('Nom d’utilisateur'),

            ChoiceField::new('roles')
                ->setLabel('Rôles')
                ->allowMultipleChoices()
                ->renderExpanded()
                ->setChoices([
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Super Admin' => 'ROLE_SUPER_ADMIN',
                ]),

            BooleanField::new('isVerified', 'Compte vérifié'),

            // Optionnel : seulement affiché en lecture seule
            TextField::new('password')->onlyOnDetail()->setLabel('Mot de passe (hashé)'),

            // Optionnel : voir les rôles en tableau dans l'affichage
            ArrayField::new('roles')->onlyOnDetail()->setLabel('Rôles assignés'),
        ];
    }
}

