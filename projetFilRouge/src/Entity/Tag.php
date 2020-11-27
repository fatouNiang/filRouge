<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ApiResource(
 *      routePrefix="/admin",
 *      collectionOperations={
 *          "Get_tags"={
 *              "method"="GET",
 *              "path"="/tags", 
 *              "security" = "is_granted('GET', object)"
     
 *          },
 *          "post_tag"={
 *              "method"="POST",
 *              "path"="/tags",
 *   *          "security" = "is_granted('POST', object)"
      
 *      },
 * },
 *      itemOperations={
 *          "get_Id_tag"={
 *              "method"="GET",
 *              "path"="/tags/{id}",
 *              "security" = "is_granted('GET', object)"

 *          },
 *          "put_Id_tag"={
 *              "method"="PUT",
 *              "path"="/tags/{id}",
 *              "security" = "is_granted('GET', object)"

 *          },
 *      },
 * )
 * @ORM\Entity(repositoryClass=TagRepository::class)
 * @UniqueEntity("libelle", message="ce libelle existe deja")

 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "veillez saisir le libelle")
     */
    private $libelle;

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
}
