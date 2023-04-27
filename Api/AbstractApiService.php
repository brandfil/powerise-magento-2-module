<?php
namespace Powerise\Integration\Api;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\ResourceConnection;
use Powerise\Integration\Helper\Configuration;
use Powerise\Integration\Mapper\ProductMapper;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractApiService
{
    protected $collectionFactory;
    protected $productMapper;
    protected $configuration;

    /**
     * @param ResourceConnection $resourceConnection
     * @param CollectionFactory $collectionFactory
     * @param ProductMapper $productMapper
     * @param Configuration $configuration
     */
    public function __construct(
        ResourceConnection $resourceConnection,
        CollectionFactory $collectionFactory,
        ProductMapper $productMapper,
        Configuration $configuration
    ) {
        $this->resourceConnection = $resourceConnection;
        $this->collectionFactory = $collectionFactory;
        $this->productMapper = $productMapper;
        $this->configuration = $configuration;
    }

    /**
     * @return Request
     */
    protected function getRequest()
    {
        return Request::createFromGlobals();
    }

    /**
     * @return void
     */
    public function checkPermission()
    {
        if ($this->getRequest()->headers->get('HTTP-X-API-KEY') !== $this->configuration->getGeneralConfig('api_key')) {
            $this->jsonResponse(['error' => 'Access denied'], 405);
        }
    }

    /**
     * @param $data
     * @param $statusCode
     * @return void
     */
    public function jsonResponse($data, $statusCode = 200)
    {
        header_remove();
        http_response_code($statusCode);
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        header('Content-Type: application/json');
        $status = [
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Moved Temporarily',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Time-out',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Large',
            415 => 'Unsupported Media Type',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Time-out',
            505 => 'HTTP Version not supported',
        ];
        header('Status: '.$statusCode.' '.$status[$statusCode]);
        echo json_encode($data);
        die();
    }
}
