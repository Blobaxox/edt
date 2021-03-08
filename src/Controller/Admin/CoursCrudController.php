<?php

namespace App\Controller\Admin;

use App\Entity\Cours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class CoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cours::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('dateHeureDebut')->renderAsChoice(),
            DateTimeField::new('dateHeureFin')->renderAsChoice(),
            AssociationField::new('professeur'),
            AssociationField::new('matiere'),
            AssociationField::new('salle'),
        ];
    }

}
