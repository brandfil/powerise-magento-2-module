<?php

namespace Powerise\Integration\Mapper\Product;

use Magento\Catalog\Api\Data\ProductInterface;

interface ProductMapperInterface
{
    /**
     * @param ProductInterface $mageProduct
     * @return array
     */
    public function map(ProductInterface $mageProduct): array;
}
