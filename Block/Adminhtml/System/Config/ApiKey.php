<?php

namespace Powerise\Integration\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Powerise\Integration\Helper\Configuration;

class ApiKey extends Field
{
    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Context $context, Configuration $configuration, array $data = [])
    {
        parent::__construct($context);
        $this->configuration = $configuration;
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $disabled = $this->configuration->getGeneralConfig('connected') ? '' : 'disabled="disabled"';

        $element->setClass('input-text');
        return '<input class="input-text admin__control-text" id="' . $element->getHtmlId() . '" name="' . $element->getName() . '" value="' . $element->getEscapedValue() . '" ' . $element->serialize($element->getHtmlAttributes()) . ' '.$disabled.'/>';
    }
}
