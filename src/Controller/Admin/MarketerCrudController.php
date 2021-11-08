<?php

namespace App\Controller\Admin;

use App\Entity\Marketer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MarketerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Marketer::class;
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
