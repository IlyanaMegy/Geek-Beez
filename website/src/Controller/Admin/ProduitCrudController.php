<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('slug'),
            MoneyField::new('prix')->setCurrency('EUR'),
            NumberField::new('quantity')
            ->formatValue(function ($value) {
                return $value < 5 ? sprintf('%d **LOW STOCK**', $value) : $value;
            }),
            TextEditorField::new('imageFile')
            ->setFormType(VichImageType::class),
            TextEditorField::new('descr')
            ->formatValue(function ($value) {
                return $value == null ? $value : 'Arrive bientôt...';
            }),
            AssociationField::new('categorie', 'Catégories'),
        ];
    }
    
}
