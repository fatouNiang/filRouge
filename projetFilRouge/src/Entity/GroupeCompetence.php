<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *  routePrefix="/admin",
 *      collectionOperations={"get", "post",
 *          "get_GroupeCompetences_competences"={
 *              "method"="GET",
 *              "path"="/groupe_competences/competences", 
 *              "normalization_context"={"groups"={"groupeCompetence:read"}}  
 *          },
 *      },
 *      itemOperations={
 *          "get","put",
 *          "get_GroupeCompetences_competences_id"={
 *              "method"="GET",
 *              "path"="/groupe_competences/{id}/competences",
 *              "normalization_context"={"groups"={"groupeCompetence:read"}},    
 *          },
 *     },
 * normalizationContext = {"groups" = {"grpcompetence: read","competence: read",}},
 * denormalizationContext = {"groups" = {"grpcompetence: write"}},
 * )
 * @ORM\Entity(repositoryClass=GroupeCompetenceRepository::class)
 * @UniqueEntity("libelle", message="ce libelle existe deja")
 */
class GroupeCompetence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"groupeCompetence:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Groups({"grpcompetence: read", "grpcompetence: write"})
     * @Groups({"groupeCompetence:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Groups({"grpcompetence: read", "grpcompetence: write"})
     * @Groups({"groupeCompetence:read"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Competences::class, inversedBy="groupeCompetences")
     * @Groups({"grpcompetence: read", "grpcompetence: write"})
     * @Groups({"groupeCompetence:read"})
     */
    private $competences;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archivage=0;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Competences[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competences $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): self
    {
        $this->competences->removeElement($competence);

        return $this;
    }

    public function getArchivage(): ?bool
    {
        return $this->archivage;
    }

    public function setArchivage(bool $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }
}
