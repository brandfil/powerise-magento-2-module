<?php

namespace Powerise\Integration\Mapper;

use Magento\Catalog\Api\Data\ProductInterface;
use Powerise\Integration\Mapper\Product\SimpleProductMapper;
use Psr\Log\LoggerInterface;

class ProductMapper
{
    private $simpleProductMapper;
    private $logger;

    public function __construct(
        SimpleProductMapper $simpleProductMapper,
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
        $this->simpleProductMapper = $simpleProductMapper;
    }

    /**
     * @param ProductInterface[] $mageProducts
     * @return array[]
     */
    public function mapToCKProducts($mageProducts): array
    {
        $products = [];

        foreach ($mageProducts as $mageProduct) {
            if (!$mageProduct->isSaleable()) {
                continue;
            }

            try {
                $products[] = $this->simpleProductMapper->map($mageProduct);
            } catch (\Throwable $e) {
                $this->logger->error(sprintf('Product with id: "%s" is invalid', $mageProduct->getId()));
            }
        }

        return $products;
    }
}
