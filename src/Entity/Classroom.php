<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassroomRepository::class)]
class Classroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Student>
     */
    #[ORM\OneToMany(targetEntity: Student::class, mappedBy: 'classroom')]
    private Collection $sts;

    public function __construct()
    {
        $this->sts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getSts(): Collection
    {
        return $this->sts;
    }

    public function addSt(Student $st): static
    {
        if (!$this->sts->contains($st)) {
            $this->sts->add($st);
            $st->setClassroom($this);
        }

        return $this;
    }

    public function removeSt(Student $st): static
    {
        if ($this->sts->removeElement($st)) {
            // set the owning side to null (unless already changed)
            if ($st->getClassroom() === $this) {
                $st->setClassroom(null);
            }
        }

        return $this;
    }
}