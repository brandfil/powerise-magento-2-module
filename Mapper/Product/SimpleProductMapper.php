<?php

namespace Powerise\Integration\Mapper\Product;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Helper\Data;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Store\Model\StoreManagerInterface;

class SimpleProductMapper implements ProductMapperInterface
{
    private $storeManager;
    private $taxHelper;
    private $configurableType;
    private $productRepository;

    public function __construct(
        StoreManagerInterface $storeManager,
        Data $taxHelper,
        Configurable $configurableType,
        ProductRepositoryInterface $productRepository
    ) {
        $this->storeManager = $storeManager;
        $this->taxHelper = $taxHelper;
        $this->configurableType = $configurableType;
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritdoc
     */
    public function map(ProductInterface $mageProduct): array
    {
        $parentIds = $this->configurableType->getParentIdsByChild($mageProduct->getId());
        $parentId = array_shift($parentIds);

        $description = $mageProduct->getCustomAttribute(ProductAttributeInterface::CODE_DESCRIPTION);
        $image = $this->getMediaBaseUrl() . 'media/catalog/product' . $mageProduct->getImage();
        if (!$mageProduct->getImage()) {
            $parent = $this->productRepository->getById($parentId);
            $image = $this->getMediaBaseUrl() . 'media/catalog/product' . $parent->getImage();
        }

        return [
            'id' => $mageProduct->getId(),
            'name' => $mageProduct->getName(),
            'sku' => $mageProduct->getSku(),
            'url' => $mageProduct->getProductUrl(),
            'image' => (string) $image,
            'description' => $description ? $description->getValue() : null,
            'price' => $this->taxHelper->getTaxPrice($mageProduct, $this->getRegularPrice($mageProduct), true),
        ];
    }

    private function getRegularPrice(ProductInterface $product): float
    {
        $regularPrice = $product->getPriceInfo()->getPrice('regular_price');
        return $regularPrice->getValue();
    }

    private function getMediaBaseUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl();
    }
}
