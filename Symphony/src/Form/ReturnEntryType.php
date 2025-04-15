<?php

namespace App\Form;

use App\Entity\Issue;
use App\Entity\ReturnEntry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReturnEntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('returnedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('issue', EntityType::class, [
                'class' => Issue::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReturnEntry::class,
        ]);
    }
}
