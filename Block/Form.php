<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Hervé Guétin <herve.guetin@gmail.com> <@herveguetin>
 */

namespace Herve\DateTimeExample\Block;


use Herve\DateTimeExample\Model\DateTime;
use Herve\DateTimeExample\Model\DateTimeFactory;
use Herve\DateTimeExample\Model\Flag;
use Herve\DateTimeExample\Model\FlagFactory;
use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Zend\Json\Json;

class Form extends Template
{
    private $flag;

    /**
     * @var DateTimeFactory
     */
    private $dateTimeFactory;
    /**
     * @var DateTime
     */
    private $dateTime;

    public function __construct(
        DateTimeFactory $dateTimeFactory,
        FlagFactory $flagFactory,
        Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);

        /** @var Flag $dateTimeFlag */
        $dateTimeFlag = $flagFactory->create();
        $this->flag = $dateTimeFlag->getFlag();
        $this->dateTimeFactory = $dateTimeFactory;
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('herve_datetimeexample/index/post', ['_secure' => true]);
    }

    /**
     * @return DataObject|null
     */
    public function getSavedDateTimeForLocale()
    {
        if (!$this->flag->getFlagData()) {
            return null;
        }

        $savedDateTimeData = $this->getSavedDateTimeData();

        return new DataObject([
            'iso' => $savedDateTimeData['iso'],
            'full' => $savedDateTimeData['full'],
            'json' => Json::encode($savedDateTimeData),
        ]);
    }

    /**
     * @return array
     */
    private function getSavedDateTimeData()
    {
        $this->initDateTime();

        return [
            'iso' => $this->getSavedDateTimeISO(),
            'full' => $this->getSavedDateTimeFull()
        ];
    }

    private function initDateTime()
    {
        $this->dateTime = $this->dateTimeFactory->create();
        $this->dateTime->setUsedDatetime($this->flag->getFlagData());
    }

    /**
     * @return string
     */
    private function getSavedDateTimeISO()
    {
        return $this->dateTime->formatISO();
    }

    /**
     * @return string
     */
    private function getSavedDateTimeFull()
    {
        return $this->dateTime->formatFull();
    }
}