<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('email');
        yield Field::new('plainPassword', 'New password')
            ->onlyOnForms()
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options' => ['hash_property_path' => 'password', 'label' => 'New password'],
                'second_options' => ['label' => 'Repeat password'],
            ]);
        yield BooleanField::new('isVerified');
        yield TextField::new('username');
        yield TextField::new('firstname');
        yield TextField::new('lastname');
    }

}
