<?php

namespace App\Controller\Admin;

use App\Entity\TypeMarketer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeMarketerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeMarketer::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
