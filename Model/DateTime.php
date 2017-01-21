<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Hervé Guétin <herve.guetin@gmail.com> <@herveguetin>
 */

namespace Herve\DateTimeExample\Model;


use Magento\Framework\Stdlib\DateTime as MagentoDateTime;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class DateTime
{
    /**
     * @var string
     */
    private $usedDatetime;
    /**
     * @var TimezoneInterface
     */
    private $timezone;

    public function __construct(
        TimezoneInterface $timezone
    )
    {
        $this->timezone = $timezone;
    }

    /**
     * @param string $usedDatetime
     */
    public function setUsedDatetime(string $usedDatetime)
    {
        $this->usedDatetime = $usedDatetime;
    }

    /**
     * @return string
     */
    public function getCurrentDateTimeUTC()
    {
        return (new \DateTime())->format(MagentoDateTime::DATETIME_PHP_FORMAT);
    }

    /**
     * @return string
     */
    public function formatISO()
    {
        $usedDateTime = ($this->usedDatetime) ? $this->usedDatetime : $this->getCurrentDateTimeUTC();

        return $this->timezone->date(new \DateTime($usedDateTime))->format(MagentoDateTime::DATETIME_PHP_FORMAT);
    }

    /**
     * @return string
     */
    public function formatFull()
    {
        $usedDateTime = ($this->usedDatetime) ? $this->usedDatetime : $this->getCurrentDateTimeUTC();
        $formattedDateTime = $this->timezone->formatDateTime($usedDateTime, \IntlDateFormatter::MEDIUM);

        return $formattedDateTime . ' ' . $this->timezone->getConfigTimezone();
    }
}
