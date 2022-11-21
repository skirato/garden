<?php

namespace App\Controller\Admin;

use App\Entity\SeedVariety;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SeedVarietyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SeedVariety::class;
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
