<?php
namespace Components\View\Helper\Form;


use Zend\Form\View\Helper\FormSubmit  as ZVHFormSubmit;
use Zend\Form\FieldsetInterface;
class FormActions extends ZVHFormSubmit
{

    /**
     * Invoke helper as functor
     *
     * Proxies to {@link render()}.
     *
     * @param  ElementInterface|null $element
     * @return string|FormInput
     */
    public function __invoke(FieldsetInterface $fieldset = null)
    {
        if (!$fieldset) {
            return $this;
        }

        return $this->render($element);
    }



    /**
     * Render a <button> element from the provided $element
     *
     * @param  ElementInterface $element
     * @throws Exception\DomainException
     * @return string
     */
    public function render(FieldsetInterface $element)
    {
        $name = $element->getName();
        if ($name === null || $name === '') {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned name; none discovered',
                __METHOD__
            ));
        }

        $attributes          = $element->getAttributes();
        $attributes['name']  = $name;
        $attributes['type']  = $this->getType($element);
        $label = $element->getValue();

        return sprintf(
            '<button %s >' . $label . '</button>',
            $this->createAttributesString($attributes)
        );
    }

}

