<?php

namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegistrationFormType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
$builder
->add('email')
->add('roles', ChoiceType::class, [
'choices' => [
'Admin' => 'ROLE_ADMIN','User' => 'ROLE_USUARIO','Manager'=>'ROLE_MANAGER'
],
'multiple' => true, // Permitir múltiples opciones
'expanded' => true, ])// Renderiza como checkboxes
//->add('password') quitar este y sustituir por este
->add('password', RepeatedType::class, [
'type' => PasswordType::class,
'first_options' => ['label' => 'Password'],
'second_options' => ['label' => 'Repeat Password'],
]);
;
}
public function configureOptions(OptionsResolver $resolver): void
{
$resolver->setDefaults([
'data_class' => User::class,
]);
}
}