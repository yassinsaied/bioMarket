<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;




class AppFixtures extends Fixture
{


    private static $unite = [

        "piece",
        "Kg",
        "100g"
    ];

    private $encoderPassword;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoderPassword = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create("en_US");
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

        $category = new Category;
        $category->setName("Fruits");
        $manager->persist($category);

        for ($i = 0; $i < 20; $i++) {
            $product = new Product;
            $product->setName($faker->unique()->fruitName);
            $product->setDescription($faker->realText(50));
            $product->setPrice($faker->randomFloat(2, 1, 10));
            $product->setUnite($faker->randomElement(self::$unite));
            $product->setPromo($faker->numberBetween(10, 40));
            $product->setCategory($category);
            $manager->persist($product);
        }

        $category2 = new Category;
        $category2->setName("Vegetables");
        $manager->persist($category2);

        for ($i = 0; $i < 20; $i++) {
            $product2 = new Product;
            $product2->setName($faker->unique()->vegetableName);
            $product2->setDescription($faker->realText(50));
            $product2->setPrice($faker->randomFloat(2, 1, 10));
            $product2->setUnite($faker->randomElement(self::$unite));
            $product2->setPromo($faker->numberBetween(10, 40));
            $product2->setCategory($category2);
            $manager->persist($product2);
        }


        $category3 = new Category;
        $category3->setName("Fresh Products");
        $manager->persist($category3);

        $category4 = new Category;
        $category4->setName("Drink");
        $manager->persist($category4);

        $category5 = new Category;
        $category5->setName("Meats");
        $manager->persist($category5);

        for ($i = 0; $i < 30; $i++) {
            $product4 = new Product;
            $product4->setName($faker->meatName());
            $product4->setDescription($faker->realText(50));
            $product4->setPrice($faker->randomFloat(2, 1, 10));
            $product4->setUnite($faker->randomElement(self::$unite));
            $product4->setPromo($faker->numberBetween(10, 40));
            $product4->setCategory($category5);
            $manager->persist($product4);
        }


        $category6 = new Category;
        $category6->setName("Fish");
        $manager->persist($category6);

        for ($i = 0; $i < 30; $i++) {
            $product5 = new Product;
            $product5->setName($faker->meatName());
            $product5->setDescription($faker->realText(50));
            $product5->setPrice($faker->randomFloat(2, 1, 10));
            $product5->setUnite($faker->randomElement(self::$unite));
            $product5->setPromo($faker->numberBetween(10, 40));
            $product5->setCategory($category6);
            $manager->persist($product5);
        }


        $category7 = new Category;
        $category7->setName("Beverage");
        $manager->persist($category7);

        for ($i = 0; $i < 30; $i++) {
            $product6 = new Product;
            $product6->setName($faker->beverageName());
            $product6->setDescription($faker->realText(50));
            $product6->setPrice($faker->randomFloat(2, 1, 10));
            $product6->setUnite($faker->randomElement(self::$unite));
            $product6->setPromo($faker->numberBetween(10, 40));
            $product6->setCategory($category7);
            $manager->persist($product6);
        }

        $category8 = new Category;
        $category8->setName("milk");
        $manager->persist($category8);

        for ($i = 0; $i < 30; $i++) {
            $product7 = new Product;
            $product7->setName($faker->beverageName());
            $product7->setDescription($faker->realText(50));
            $product7->setPrice($faker->randomFloat(2, 1, 10));
            $product7->setUnite($faker->randomElement(self::$unite));
            $product7->setPromo($faker->numberBetween(10, 40));
            $product7->setCategory($category8);
            $manager->persist($product7);
        }




        for ($i = 0; $i < 30; $i++) {
            $user = new User;
            $password = "password";
            $encodedPassword = $this->encoderPassword->encodePassword($user, $password);
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->LastName());
            $user->setEmail($faker->unique()->email);
            $user->setPassword($encodedPassword);
            $manager->persist($user);
        }









        // $product = new Product();
        // $manager->persist($product);


        $manager->flush();
    }
}
