<?php

namespace App\Adventure;

use App\Entity\BackpackItem;
use App\Entity\Hero;
use App\Entity\SpecialItem;
use App\Entity\Weapon;
use Doctrine\ORM\EntityManagerInterface;

class Alteration
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function useConsumable(Hero $hero, BackpackItem $backpackItem) : ?string
    {
        $item = $backpackItem->getItem();
        $attribute = $item->getAttributeTargeted();
        switch($attribute) {
            case "life":
                $message = $this->ConsumableGivesLife($hero, $backpackItem);
                break;
            case "ability":
                $message = $this->ConsumableGivesAbility($hero, $backpackItem);
                break;
            default:
                $message = null;
        }
        return $message;
    }

    public function ConsumableGivesAbility(Hero $hero, BackpackItem $backpackItem) : string
    {
        $item = $backpackItem->getItem();
        $bonus = $item->getBonusGiven();
        $hero->setAbility($hero->getAbility() + $bonus);
        $backpackItem->removeStock(1);
        $backpackItem->getStock() === 0
        ? $this->em->remove($backpackItem)
        : $this->em->persist($backpackItem);

        $this->em->persist($hero);
        $this->em->flush();
        return "You gain +". $item->getBonusGiven(). " ". $item->getAttributeTargeted(). " !";

    }

    public function ConsumableGivesLife(Hero $hero, BackpackItem $backpackItem) : string
    {
        $item = $backpackItem->getItem();
        $bonus = $item->getBonusGiven();
        $maxLife = $hero->getMaxLife();

        $heroLife = $hero->getLife();
        if( $heroLife === $maxLife) {
            return "Your life is already at maximum! ";
        } else {
            $backpackItem->removeStock(1);
            $backpackItem->getStock() === 0
            ? $this->em->remove($backpackItem)
            : $this->em->persist($backpackItem);

            $newLife = $bonus + $heroLife;
            if ($newLife <= $maxLife) {
                $hero->setLife($newLife);
                $this->em->persist($hero);
                $this->em->flush();
                return "You regain " . $bonus. " life !";
            } else {
                $lifeRegained = $bonus + $maxLife - $newLife;
                $hero->setLife($maxLife);
                $this->em->persist($hero);
                $this->em->flush();
                return "You regain " . $lifeRegained. " life !";

            }

        }
    }

    public static function equippedSpecialItem(Hero $hero, SpecialItem $item) : void
    {
        $attribute = $item->getAttributeTargeted();
        $bonus = $item->getBonusGiven();
        switch ($attribute) {
            case "life":
                $hero->setLife($hero->getLife() + $bonus);
                break;
            case "ability":
                $hero->setAbility($hero->getAbility() + $bonus);
                break;
        }
    }

    public static function removeSpecialItem(Hero $hero, SpecialItem $item) : void
    {
        $attribute = $item->getAttributeTargeted();
        $bonus = $item->getBonusGiven();
        switch ($attribute) {
            case "life":
                $hero->setLife($hero->getLife() - $bonus);
                break;
            case "ability":
                $hero->setAbility($hero->getAbility() - $bonus);
                break;
        }
    }

    public static function weaponSkillBonus(Hero $hero, Weapon $weapon) : bool
    {
        $weaponSkill = $hero->getWeaponskill();
        if (isset($weaponSkill)) {
            $ws = $weaponSkill->getWeaponMastered();
            if ($ws === $weapon) {
                $hero->setAbility($hero->getAbility() + 2);
                return true;
            }
        }
        return false;
    }
}