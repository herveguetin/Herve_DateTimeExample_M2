<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Hervé Guétin <herve.guetin@gmail.com> <@herveguetin>
 */

namespace Herve\DateTimeExample\Controller\Index;


use Herve\DateTimeExample\Model\DateTimeFactory;
use Herve\DateTimeExample\Model\FlagFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class Post extends Action
{
    /**
     * @var FlagFactory
     */
    private $flagFactory;
    /**
     * @var DateTimeFactory
     */
    private $dateTimeFactory;

    public function __construct(
        DateTimeFactory $dateTimeFactory,
        FlagFactory $flagFactory,
        Context $context
    )
    {
        parent::__construct($context);
        $this->flagFactory = $flagFactory;
        $this->dateTimeFactory = $dateTimeFactory;
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Flag $flag */
        $flag = $this->flagFactory->create()->getFlag();

        /** @var \Herve\DateTimeExample\Model\DateTime $dateTime */
        $dateTime = $this->dateTimeFactory->create();

        $flag->setFlagData($dateTime->getCurrentDateTimeUTC());
        $flag->getResource()->save($flag);

        $this->_redirect('*');
    }
}