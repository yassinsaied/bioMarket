<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    private $objectManger;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->objectManger = $entityManagerInterface;
    }



    public function getPromoProducts()
    {
    }
}
