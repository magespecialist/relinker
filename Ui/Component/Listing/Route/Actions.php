<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\ReLinker\Ui\Component\Listing\Route;

use Magento\Ui\Component\Listing\Columns\Column;
use MSP\ReLinkerApi\Api\Data\RouteInterface;

class Actions extends Column
{
    /**
     * @inheritdoc
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                $id = $item[RouteInterface::ID];

                $item[$name]['edit'] = [
                    'href' => $this->getContext()->getUrl('msp_relinker/route/edit', [RouteInterface::ID => $id]),
                    'label' => __('Edit')
                ];

                $item[$name]['delete'] = [
                    'href' => $this->getContext()->getUrl('msp_relinker/route/delete', [RouteInterface::ID => $id]),
                    'label' => __('Delete')
                ];
            }
        }

        return $dataSource;
    }
}
