<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Newsletter\Test\Constraint;

use Magento\Newsletter\Test\Fixture\Template;
use Magento\Newsletter\Test\Page\Adminhtml\TemplateQueue;
use Mtf\Constraint\AbstractAssertForm;

/**
 * Class AssertNewsletterQueue
 * Assert that "Edit Queue" page opened and subject, sender name, sender email and template content correct
 */
class AssertNewsletterQueue extends AbstractAssertForm
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Skipped fields for verify data
     *
     * @var array
     */
    protected $skippedFields = ['code'];

    /**
     * Assert that "Edit Queue" page opened and subject, sender name, sender email and template content correct
     *
     * @param TemplateQueue $templateQueue
     * @param Template $newsletter
     * @return void
     */
    public function processAssert(TemplateQueue $templateQueue, Template $newsletter)
    {
        $dataDiff = $this->verifyData($newsletter->getData(), $templateQueue->getEditForm()->getData($newsletter));
        \PHPUnit_Framework_Assert::assertEmpty($dataDiff, $dataDiff);
    }

    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function toString()
    {
        return 'Edit Queue content equals to passed from fixture.';
    }
}
