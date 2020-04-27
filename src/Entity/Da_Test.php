<?php

namespace DoctrineAnnotation\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
// Hack
//class_exists(UniqueEntity::class);
//class_exists(Groups::class);

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DoctrineAnnotation\Repository\TestRepository")
 * @UniqueEntity("name")
 */
class Da_Test
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"test:read"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
