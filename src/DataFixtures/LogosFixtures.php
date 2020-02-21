<?php

namespace App\DataFixtures;

use App\Entity\Logo;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class LogosFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $logo = new Logo();
        $logo->setTitle('coucou');
        $logo->setImage('koukou');
        $manager->persist($logo);

        $project = new Project();
        $project->setTitle('coucou1');
        $project->addLogo($logo);
        $project->setDescription('desc');
        $manager->persist($project);

        $manager->flush();
    }
}
