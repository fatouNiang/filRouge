<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeTagRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource(
 *      routePrefix="/admin",
 *      collectionOperations={
 *          "Get_grptags"={
 *              "method"="GET",
 *              "path"="/grptags",      
 *          },
 *          "post_grptag"={
 *              "method"="POST",
 *              "path"="/grptags",      
 *      },
 * },
 *      itemOperations={
 *          "get_Id_grptag"={
 *              "method"="GET",
 *              "path"="/grptags/{id}",
 *          },
 *          "put_Id_grptag"={
 *              "method"="PUT",
 *              "path"="/grptags/{id}",
 *          },
 *      },
 * )
 * @UniqueEntity("libelle", message="ce libelle existe deja")
 * @ORM\Entity(repositoryClass=GroupeTagRepository::class)
 */
class GroupeTag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *      
     * @Assert\NotBlank(message = "veillez saisir le libelle")
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message = "veillez saisir la description")

     */
    private $description;

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
}
