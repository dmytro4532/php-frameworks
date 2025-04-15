<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Issue;
use App\Entity\Reader;
use App\Entity\ReturnEntry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IssueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('IssuedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('book', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'id',
            ])
            ->add('Reader', EntityType::class, [
                'class' => Reader::class,
                'choice_label' => 'id',
            ])
            ->add('returnEntry', EntityType::class, [
                'class' => ReturnEntry::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Issue::class,
        ]);
    }
}
