<?php

namespace App\Controller\Admin;

use App\Entity\Observation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ObservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Observation::class;
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
