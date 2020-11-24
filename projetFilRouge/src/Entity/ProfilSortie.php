<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilSortieRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource(
 *      routePrefix="/admin",
 *        collectionOperations={
 * 
 *              "get_profilSortie"={
 *               "method"="GET", 
 *              "path"="/profilSorties",
 *          },
 *          "add_profilSortie"={
 *               "method"="POST", 
 *              "path"="/profilSorties",
 *          },
 *      },
 *       itemOperations={
 * 
 *          "get_profilSortie_id"={
 *               "method"="GET", 
 *              "path"="/profilSorties{id}",
 *          },
 *            "put_profilSortie_id"={
 *               "method"="PUT", 
 *              "path"="/profilSorties/{id}",
 *          },
 *            "archive_profilSortie_id"={
 *               "method"="DELETE", 
 *              "path"="/profilSorties/{id}",
 *          },
 * },
 * )
 * @ORM\Entity(repositoryClass=ProfilSortieRepository::class)
 */
class ProfilSortie
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

    /**
     * @ORM\Column(type="boolean")
     */
    private $archivage;

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
