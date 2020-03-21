<?php

namespace App\Application\Templating\Helper;

use App\Entity\Description;
use App\Entity\Logo;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;

final class ProjectHelper extends TwigExtension
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function projects(): array
    {
        return $this->em->getRepository(Project::class)->findAll();
    }

    public function descriptions(): array
    {
        return $this->em->getRepository(Description::class)->findBy([
            'active' => true
        ]);
    }

    public function logos(): array
    {
        return $this->em->getRepository(Logo::class)->findBy([
            'social' => false
        ]);
    }

    public function socialLogos(): array
    {
        return $this->em->getRepository(Logo::class)->findBy([
            'social' => true
        ]);
    }
}
