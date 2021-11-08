<?php

namespace App\Controller\Admin;

use App\Entity\Adopting;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdoptingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adopting::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('lastName'),
            TextField::new('firstName'),
            EmailField::new('email'),
            TextField::new('plainPassword'),
            TextField::new('phone'),
            AssociationField::new('city'),
            BooleanField::new('isAdministrator'),
            ];
    }
}
