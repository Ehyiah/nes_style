<?php

namespace App\Application\Templating\Helper;

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

    public function projectHelper()
    {
        return $this->em->getRepository(Project::class)->findAll();
    }
}
