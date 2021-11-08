<?php

namespace App\Controller\Admin;

use App\Entity\Marketer;
use App\Repository\TypeMarketerRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MarketerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Marketer::class;
    }

    public function configureFields(string $pageName): iterable
    {
//        $this->typeMarketerRepository = $typeMarketerRepository;
//        $typeMarketer = $typeMarketerRepository->findAll();
//        $atm =[];
//        foreach ($typeMarketer as $tm){
//            $atm->
//        }

        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('typeMarketer'),
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
