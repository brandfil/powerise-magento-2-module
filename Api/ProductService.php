<?php
namespace Powerise\Integration\Api;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product\Visibility;
use Powerise\Integration\Api\Traits\NormalizeTrait;

class ProductService extends AbstractApiService
{
    use NormalizeTrait;

    /**
     * @return null
     * @throws \ReflectionException
     */
    public function getList()
    {
        $this->checkPermission();

        $currentPage = (int) $this->getRequest()->get('page', 1);
        $collection = $this->collectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter(ProductInterface::VISIBILITY, Visibility::VISIBILITY_BOTH);
        $collection->addAttributeToFilter(ProductInterface::STATUS, 1);
        $collection->setPageSize(50);
        $collection->addStoreFilter($this->configuration->getGeneralConfig('store_id'));
        $collection->setCurPage($currentPage);

        $data = [];
        if ($currentPage <= $collection->getLastPageNumber()) {
            $data = $this->productMapper->mapToCKProducts($collection);
        }

        return $this->jsonResponse([
            'page' => $currentPage,
            'data' => $data,
        ]);
    }
}
