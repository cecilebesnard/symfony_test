<?php

namespace adminBundle\Form;

use adminBundle\Form\Type\HTMLEditorType;
use adminBundle\Subscriber\CategorieFormSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title' , HTMLEditorType::class)
              //description gerée directement dans le souscripteur
              //->add('description')
                ->add('position')
                ->add('active' , ChoiceType::class,[
                    'choices' => [
                        'oui' => 1,
                        'non' => 0,
                    ],
                    'expanded' => true
                ]);

        $builder->addEventSubscriber(new CategorieFormSubscriber());
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'adminBundle\Entity\Categorie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_categorie';
    }


}
