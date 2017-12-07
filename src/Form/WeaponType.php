<?php

namespace App\Form;

use App\Entity\Weapon;
use App\Entity\Story;
use App\Entity\Skill;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class WeaponType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $story = $options['story'];
        
        
        $builder->add("name",
                    TextType::class, [
                        "label" => "name of the weapon"
                    ])
                ->add("description",
                    TextareaType::class, [
                        "label" => "description of the weapon"
                    ])
                ->add("weaponSkill", 
                    EntityType::class, [
                        "label" => "Skill improving the weapon mastery",
                        "class" => Skill::class,
                        "choices" => $story->getSkills(),
                        "choice_label" => "name",
                        "expanded" => false,
                        "multiple" => false,
                        "required" => false,
                        "empty_data" => "None"                  
                    ])
                ->add("save", 
                    SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Weapon::class,
            "story" => null
        ]);
    }
}