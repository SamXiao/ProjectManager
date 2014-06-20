<?php
namespace Components\View\Helper\Form;


use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormButton  as ZVHFormButton;
class FormButton extends ZVHFormButton
{

    /**
     * Create a string of all attribute/value pairs
     *
     * Escapes all attribute values
     *
     * @param  array $attributes
     * @return string
     */
    public function createAttributesString(array $attributes)
    {
        $attributes = $this->prepareAttributes($attributes);
        $escape     = $this->getEscapeHtmlHelper();
        $escapeAttr = $this->getEscapeHtmlAttrHelper();
        $strings    = array();

        foreach ($attributes as $key => $value) {
            $key = strtolower($key);

            if (!$value && isset($this->booleanAttributes[$key])) {
                // Skip boolean attributes that expect empty string as false value
                if ('' === $this->booleanAttributes[$key]['off']) {
                    continue;
                }
            }

            //check if attribute is translatable
            if (isset($this->translatableAttributes[$key]) && !empty($value)) {
                if (($translator = $this->getTranslator()) !== null) {
                    $value = $translator->translate($value, $this->getTranslatorTextDomain());
                }
            }

            //@TODO Escape event attributes like AbstractHtmlElement view helper does in htmlAttribs ??
            $strings[] = sprintf('%s="%s"', $escape($key), $escapeAttr($value));
        }

        return implode(' ', $strings);
    }



}

