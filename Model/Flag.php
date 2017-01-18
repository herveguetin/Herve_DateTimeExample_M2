<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Hervé Guétin <herve.guetin@gmail.com> <@herveguetin>
 */

namespace Herve\DateTimeExample\Model;


use Magento\Framework\FlagFactory;

class Flag
{
    const FLAG_CODE = 'herve_datetimeexample';

    /**
     * @var \Magento\Framework\Flag
     */
    private $flag;

    public function __construct(
        FlagFactory $flagFactory
    )
    {
        $this->flag = $flagFactory->create(['data' => ['flag_code' => self::FLAG_CODE]]);
        $this->flag->loadSelf();
    }

    /**
     * @return \Magento\Framework\Flag
     */
    public function getFlag()
    {
        return $this->flag;
    }

}