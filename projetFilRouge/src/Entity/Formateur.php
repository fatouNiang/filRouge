<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext = {"groups" = {"formateur: read"}},
 * denormalizationContext = {"groups" = {"formateur: write"}},
 * attributes = {"pagination_enabled" = true, "pagination_items_per_page" = 2}
 * )
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
  */
class Formateur extends User
{
   
}
