<?php

namespace App\Controller\Admin;

use App\Entity\Seed;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SeedCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Seed::class;
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
