<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{


    private $objectManger;


    public function __construct(EntityManagerInterface $EntityManagerInterface)
    {

        $this->objectManger =  $EntityManagerInterface;
    }


    public function categoryByParent()

    {
        $lisCategorys = $this->objectManger->getRepository(Category::class)->findCategoryByParent();
        return $lisCategorys;
    }
}
