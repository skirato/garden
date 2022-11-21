<?php

namespace App\Controller\Admin;

use App\Entity\SeedType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SeedTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SeedType::class;
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
