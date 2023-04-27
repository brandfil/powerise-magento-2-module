<?php
namespace Powerise\Integration\Controller\Adminhtml\Connect;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Powerise\Integration\Helper\Configuration;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Index
 */
class Index extends Action
{
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

        throw new NotFoundHttpException();
    }
}
