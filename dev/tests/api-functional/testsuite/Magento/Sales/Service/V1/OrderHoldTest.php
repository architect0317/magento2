<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Sales\Service\V1;

use Magento\TestFramework\TestCase\WebapiAbstract;
use Magento\Webapi\Model\Rest\Config as RestConfig;

class OrderHoldTest extends WebapiAbstract
{
    const SERVICE_VERSION = 'V1';

    const SERVICE_NAME = 'salesOrderManagementV1';

    /**
     * @magentoApiDataFixture Magento/Sales/_files/order.php
     */
    public function testOrderHold()
    {
        $objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
        $order = $objectManager->get('Magento\Sales\Model\Order')->loadByIncrementId('100000001');
        $serviceInfo = [
            'rest' => [
                'resourcePath' => '/V1/order/' . $order->getId() . '/hold',
                'httpMethod' => RestConfig::HTTP_METHOD_POST,
            ],
            'soap' => [
                'service' => self::SERVICE_NAME,
                'serviceVersion' => self::SERVICE_VERSION,
                'operation' => self::SERVICE_NAME . 'hold',
            ],
        ];
        $requestData = ['id' => $order->getId()];
        $result = $this->_webApiCall($serviceInfo, $requestData);
        $this->assertTrue($result);
    }
}
