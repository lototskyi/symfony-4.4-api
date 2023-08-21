<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadBlogPosts($manager);
    }

    public function loadBlogPosts(ObjectManager $manager)
    {
        $user = $this->getReference('user_admin');

        $blogPost = new BlogPost();
        $blogPost->setTitle('A first Post!');
        $blogPost->setPublished(new \DateTime('2023-08-18 12:00:00'));
        $blogPost->setContent('Post text!');
        $blogPost->setAuthor($user);
        $blogPost->setSlug('a-first-post');
        $manager->persist($blogPost);

        $blogPost = new BlogPost();
        $blogPost->setTitle('A second Post!');
        $blogPost->setPublished(new \DateTime('2023-08-18 13:00:00'));
        $blogPost->setContent('Post text!');
        $blogPost->setAuthor($user);
        $blogPost->setSlug('a-second-post');
        $manager->persist($blogPost);

        $manager->flush();
    }

    public function loadComments(ObjectManager $manager)
    {

    }

    public function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@blog.com');
        $user->setName('Alex');
        $user->setPassword('secret123#');

        $this->addReference('user_admin', $user);

        $manager->persist($user);
        $manager->flush();
    }
}
