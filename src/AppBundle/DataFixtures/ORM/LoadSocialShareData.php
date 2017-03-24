<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\SocialShare;
use AppBundle\Entity\SocialShareCategory;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\File\File;

class LoadSocialShareData implements FixtureInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        $mediaFactory = $this->container->get('app.content.media_factory');
        $storage = $this->container->get('app.storage');

        // Media
        $mediaFile = new File(__DIR__.'/../../../../app/data/dist/macron.jpg');
        $storage->put('images/article.jpg', file_get_contents($mediaFile->getPathname()));
        $media = $mediaFactory->createFromFile('Social image', 'social.jpg', $mediaFile);
        $manager->persist($media);

        $manager->flush();

        $category1 = new SocialShareCategory('Culture', 1);
        $category2 = new SocialShareCategory('Défense', 2);
        $category3 = new SocialShareCategory('Santé', 3);

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);

        $manager->flush();

        $socialShare1 = new SocialShare('Partage culture 1', 1, true);
        $socialShare1->setDefaultUrl('https://en-marche.fr/');
        $socialShare1->setDescription('description');
        $socialShare1->setFacebookUrl('https://www.facebook.com/EmmanuelMacron');
        $socialShare1->setMedia($media);
        $socialShare1->setSocialShareCategory($category1);

        $socialShare2 = new SocialShare('Partage culture 2', 2, true);
        $socialShare2->setDefaultUrl('https://en-marche.fr/');
        $socialShare2->setDescription('description');
        $socialShare2->setTwitterUrl('https://twitter.com/EmmanuelMacron');
        $socialShare2->setMedia($media);
        $socialShare2->setSocialShareCategory($category1);

        $socialShare3 = new SocialShare('Partage culture 3', 3, false);
        $socialShare3->setDefaultUrl('https://en-marche.fr/');
        $socialShare3->setDescription('description');
        $socialShare3->setMedia($media);
        $socialShare3->setSocialShareCategory($category1);

        $socialShare4 = new SocialShare('Partage Défense 1', 1, true);
        $socialShare4->setDefaultUrl('https://en-marche.fr/');
        $socialShare4->setDescription('description');
        $socialShare4->setMedia($media);
        $socialShare4->setSocialShareCategory($category2);

        $manager->persist($socialShare1);
        $manager->persist($socialShare2);
        $manager->persist($socialShare3);
        $manager->persist($socialShare4);

        $manager->flush();
    }
}
