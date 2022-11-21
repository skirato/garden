<?php

namespace App\Controller\Admin;

use App\Entity\ContainerType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContainerTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContainerType::class;
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
