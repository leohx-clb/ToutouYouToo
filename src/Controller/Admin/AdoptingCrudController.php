<?php

namespace App\Controller\Admin;

use App\Entity\Adopting;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdoptingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adopting::class;
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
