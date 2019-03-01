<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DataTransformer\TimestampToDateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use App\Entity\Users;
use App\Repository\UserRepository;

class ArticleType extends AbstractType
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
            ])
            ->add('content')
            ->add('publishedAt', NumberType::class, [

            ])
            ->add('author', EntityType::class, [
                'placeholder' => 'Выеберите автора',
                'class' => Users::class,
                'choices' => $this->userRepository->findAllMoreTwo(2),
                'choice_label' => 'mail',
                'invalid_message' => 'Symfony is too smart for your hacking!'
            ])
            ->add('heartCount')
//            ->add('imageFileName')
        ;

        $builder ->get('publishedAt')->addModelTransformer(new TimestampToDateTimeTransformer()) ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
