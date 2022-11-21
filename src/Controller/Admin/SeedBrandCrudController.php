<?php

namespace App\Controller\Admin;

use App\Entity\SeedBrand;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SeedBrandCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SeedBrand::class;
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
