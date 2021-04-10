<?php
// Override a Form: https://sylius-try.readthedocs.io/en/latest/bundles/general/overriding_forms.html
namespace App\Bundle\CoreBundle\Form\Type;

use Sylius\Bundle\CoreBundle\Form\Type\Customer\CustomerRegistrationType as baseCustomerRegistrationType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class CustomerSimpleRegistrationType extends AbstractTypeExtension
{

        public function buildForm(FormBuilderInterface $builder, array $options = []): void {

            $builder
                ->add('firstName', TextType::class, [
                    'label' => 'sylius.form.customer.first_name',
                ])
                ->add('lastName', TextType::class, [
                    'label' => 'sylius.form.customer.last_name',
                ])
                ->add('phoneNumber', TextType::class, [
                    'required' => false,
                    'label' => 'sylius.form.customer.phone_number',
                ])
                ->add('subscribedToNewsletter', CheckboxType::class, [
                    'required' => false,
                    'label' => 'sylius.form.customer.subscribed_to_newsletter',
                ])
                /** New Captcha to avoid robots */
                ->add('captcha', CaptchaType::class, [
                    'label' => 'Are you human? Please repeat this characters:'
                ])
            ;
    }


    public static function getExtendedTypes(): iterable
    {
        return [baseCustomerRegistrationType::class];
    }

        public function getBlockPrefix(): string
    {
        return 'sylius_customer_registration';
    }
}
