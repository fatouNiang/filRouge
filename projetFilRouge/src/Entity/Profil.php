<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * @ApiResource(
 *  
 *      collectionOperations={
 *        "get_profils_all"={ 
 *               "method"="GET", 
 *               "path"="/admin/profils",
 *                "security_message"="Acces non autorisé"
 *          },
 *         "get_admin_profils"={ 
 *               "method"="GET", 
 *               "path"="admin/profils/{id}/users",
 *          },
 *  *         "post_admin_profils"={ 
 *               "method"="POST", 
 *               "path"="admin/profils",
 *  *            "security_message"="Acces non autorisé"

 *          },
 *      },
 *      itemOperations={
 *          "get_admin_profils"={ 
 *               "method"="GET", 
 *               "path"="/admin/profils/{id}",
 *          },
 *           "put_admin_profils"={ 
 *               "method"="PUT", 
 *               "path"="/admin/profils/{id}",
 *          },
 *          "archive_profil"={ 
 *               "method"="PUT", 
 *               "path"="/admin/profils/{id}",
 *             }
 * },
 * normalizationContext = {"groups" = {"profil: read"}},
 * denormalizationContext = {"groups" = {"profil: write"}},
 * attributes = {"pagination_enabled" = true, "pagination_items_per_page" = 2}
 * )
 * @ApiFilter(BooleanFilter::class, properties={"archivage"})
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups ({"profil: write", "profil: read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     * @Groups ({"profil: write", "profil: read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean")
     * @Groups ({"profil: write", "profil: read"})
     */
    private $archivage;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil")
     * @Groups ({"user: write", "user: read"})
     * 
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function getArchivage(): ?bool
    {
        return $this->archivage;
    }

    public function setArchivage(bool $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfil($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProfil() === $this) {
                $user->setProfil(null);
            }
        }

        return $this;
    }


}
