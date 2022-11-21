<?php

namespace App\Controller\Admin;

use App\Entity\SeedSource;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SeedSourceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SeedSource::class;
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
