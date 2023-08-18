<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $blogPost = new BlogPost();
        $blogPost->setTitle('A first Post!');
        $blogPost->setPublished(new \DateTime('2023-08-18 12:00:00'));
        $blogPost->setContent('Post text!');
        $blogPost->setAuthor('Alex');
        $blogPost->setSlug('a-first-post');
        $manager->persist($blogPost);

        $blogPost = new BlogPost();
        $blogPost->setTitle('A second Post!');
        $blogPost->setPublished(new \DateTime('2023-08-18 13:00:00'));
        $blogPost->setContent('Post text!');
        $blogPost->setAuthor('Alex');
        $blogPost->setSlug('a-second-post');
        $manager->persist($blogPost);

        $manager->flush();
    }
}
