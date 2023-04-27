<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Powerise\Integration\Controller\Adminhtml\Test;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Powerise\Integration\Helper\Configuration;

/**
 * Class Index
 */
class Index extends Action
{
    const MENU_ID = 'Powerise_Integration::greetings_test';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Configuration $configuration
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->configuration = $configuration;
    }

    /**
     * Load the page defined in view/adminhtml/layout/exampleadminnewpage_helloworld_index.xml
     *
     * @return Page
     */
    public function execute()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->configuration->setGeneralConfig('api_key', $this->_request->getParam('apiKey'));
            $this->configuration->setGeneralConfig('user_id', $this->_request->getParam('userId'));
            $this->configuration->setGeneralConfig('first_name', $this->_request->getParam('firstName'));
            $this->configuration->setGeneralConfig('last_name', $this->_request->getParam('lastName'));
            $this->configuration->setGeneralConfig('email', $this->_request->getParam('email'));
            $this->configuration->setGeneralConfig('connected', true);

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => true]);
            die();
        }

        $url = $this->_backendUrl->getUrl('integration/test/index');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Hello World'));
        $block = $resultPage->getLayout()->getBlock('content_schedule_block1');

        return $resultPage;
    }
}
