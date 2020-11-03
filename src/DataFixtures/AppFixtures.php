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
        $category->setName("fruits");
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
        $category2->setName("vegetables");
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
        $category3->setName("meats");
        $manager->persist($category3);

        for ($i = 0; $i < 30; $i++) {
            $product3 = new Product;
            $product3->setName($faker->meatName());
            $product3->setDescription($faker->realText(50));
            $product3->setPrice($faker->randomFloat(2, 1, 10));
            $product3->setUnite($faker->randomElement(self::$unite));
            $product3->setPromo($faker->numberBetween(10, 40));
            $product3->setCategory($category3);
            $manager->persist($product3);
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
