<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $imageFile = TextareaField::new('imageFile')->setFormType(VichImageType::class);
        $image = ImageField::new('image')->setBasePath('/uploads/images/products');
        $fields = [
            TextField::new('productName'),
            TextField::new('productContent'),
            AssociationField::new('category')->autocomplete(),
            ArrayField::new('category'),
            IntegerField::new('productStock'),
            MoneyField::new('productPrice')->setCurrency('USD')
            //ImageField::new('image')->setUploadDir('\public\uploads\images\products')
        ];
        
        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL ){
            $fields[] = $image;
        }else{
            $fields[] = $imageFile;
        }

        return $fields;
    }
    
}
