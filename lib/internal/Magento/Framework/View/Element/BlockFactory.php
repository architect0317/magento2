<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Framework\View\Element;

use Magento\Framework\ObjectManagerInterface;

/**
 * Class BlockFactory
 */
class BlockFactory
{
    /**
     * Object manager
     *
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Constructor
     *
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Create block
     *
     * @param string $blockName
     * @param array $arguments
     * @return \Magento\Framework\View\Element\BlockInterface
     * @throws \LogicException
     */
    public function createBlock($blockName, array $arguments = [])
    {
        $block = $this->objectManager->create($blockName, $arguments);
        if (!$block instanceof BlockInterface) {
            throw new \LogicException($blockName . ' does not implemented BlockInterface');
        }
        if ($block instanceof Template) {
            $block->setTemplateContext($block);
        }
        return $block;
    }
}
