<?php

namespace Powerise\Integration\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\FormKey;
use Powerise\Integration\Helper\Configuration;

class Connect extends Field
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

    /**
     * Set template to itself
     *
     * @return $this
     * @since 100.1.0
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate('Powerise_Integration::system/config/connect.phtml');
        return $this;
    }

    /**
     * Unset some non-related element parameters
     *
     * @param AbstractElement $element
     * @return string
     * @since 100.1.0
     */
    public function render(AbstractElement $element)
    {
        $element = clone $element;
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Get the button and scripts contents
     *
     * @param AbstractElement $element
     * @return string
     * @since 100.1.0
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $settingsController = $this->_urlBuilder->getUrl('integration/test/index');
        $baseUrl = $this->_storeManager->getStore()->getBaseUrl();
        $redirectUrl = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $originalData = $element->getOriginalData();
        $this->addData(
            [
                'button_label' => __($originalData['button_label']),
                'html_id' => $element->getHtmlId(),
                'url' => $this->_urlBuilder->getUrl('powerise_integration/connect/connect'),
                'formKey' => $this->formKey->getFormKey(),
                'firstName' => $this->configuration->getGeneralConfig('first_name'),
                'lastName' => $this->configuration->getGeneralConfig('last_name'),
                'email' => $this->configuration->getGeneralConfig('email'),
                'connected' => $this->configuration->getGeneralConfig('connected'),
                'settingsController' => $settingsController,
                'baseUrl' => $baseUrl,
                'ref' => $redirectUrl,
            ]
        );

        return $this->_toHtml();
    }
}
