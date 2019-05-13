<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Elogic\Divine\Setup;

use Elogic\Divine\Model\Employee;
use Elogic\Divine\Model\Vendor;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

// use Elogic\Divine\VirtualTypes\Adapter\ZendAdapter;
use Magento\Framework\Escaper;
// use Magento\Framework\View\Element;
// use Magento\Framework\DB\Ddl\Table;
// Zend_Db_Adapter_Abstract
/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
    protected $_vendor;

    protected $_employee;

    public function __construct(Vendor $vendor, Employee $employee){

        $this->_vendor = $vendor;
        $this->_employee = $employee;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        //Get Object Manager Instance
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $escaper = $objectManager->create('Magento\Framework\Escaper');

        $adapter = $setup->getConnection();
        $setup->startSetup();
        $auxiliaryDataType = ['DATA_TYPE'=>'text', 'NULLABLE' => ''];

        // Action to do if module version is less than 1.0.0.1
        if (version_compare($context->getVersion(), '1.0.0.1') < 0) {

            $vendorProductFixturesData = [['Microsoft',
                'Sed cautela nimia in peiores haeserat plagas, ut narrabimus postea,
                aemulis consarcinantibus insidias  graves apud Constantium, cetera medium principem sed
                siquid auribus eius huius modi quivis infudisset ignotus, acerbum et inplacabilem et in
                hoc causarum titulo dissimilem sui.'],[
                'Google',
                'Post hanc adclinis Libano monti Phoenice, regio plena gratiarum et
                venustatis, urbibus decorata magnis et pulchris; in quibus amoenitate celebritateque
                nominum Tyros excellit, Sidon et Berytus isdemque pares Emissa et Damascus saeculis condita
                priscis.'],[
                'Divine',
                'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.'
            ]];

            $vendorProductFixturesSql = [];
            foreach ($vendorProductFixturesData as $data) {
                $vendorProductFixturesSql[] = "
INSERT IGNORE INTO `elogic_divine_vendor_product` 
SET `name`='" . $escaper->escapeQuote($data['0'], true) . "', 
`description` = '" . $escaper->escapeQuote($data['1'], true) . "'";
            }

            foreach ($vendorProductFixturesSql as $sql){
                $adapter->query($sql);
            }

        }

        // Action to do if module version is less than 1.0.0.1
        if (version_compare($context->getVersion(), '1.0.0.5') < 0) {

            $employeeProductFixturesData = [
                [
                'Bee',
                '1500',
                'How doth the little busy bee
Improve each shining hour,
And gather honey all the day
From every shining flower!


How skilfully she builds her cell!
How neat she spreads the wax!
And labours hard to store it well
With the sweet food she makes.',
                'On flowers'
            ],
                [
                'Queen Bee',
                '1000000',
                'When I was in the garden,

I saw a great Queen Bee;

She was the very largest one

That I did ever see.

She wore a shiny helmet

And a lovely velvet gown,

But I was rather sad, because

She didn\'t wear a crown.',
                'In hive'
            ],
                [
                'Bumblebee',
                '40000',
                'You better not fool with a Bumblebee!—
Ef you don\'t think they can sting—you\'ll see!
They\'re lazy to look at, an\' kind o\' go
Buzzin\' an\' bummin\' aroun\' so slow,
An\' ac\' so slouchy an\' all fagged out,
Danglin\' their legs as they drone about
The hollyhawks \'at they can\'t climb in
\'Ithout ist a-tumble-un out ag\'in!
Wunst I watched one climb clean \'way
In a jimson-blossom, I did, one day,—
An\' I ist grabbed it — an\' nen let go—
An\' "Ooh-ooh! Honey! I told ye so!"
Says The Raggedy Man; an\' he ist run
An\' pullt out the stinger, an\' don\'t laugh none,
An\' says: "They has be\'n folks, I guess,
\'At thought I wuz predjudust, more er less,—
Yit I still muntain \'at a Bumblebee
Wears out his welcome too quick fer me!"',
                'Underground'
            ]
            ];


            $employeeProductFixturesSql = [];
            foreach ($employeeProductFixturesData as $data){
                $employeeProductFixturesSql[] = "
INSERT IGNORE INTO `elogic_divine_employee` 
SET `name`='".$escaper->escapeQuote($data['0'], true)."', 
`salary`='".$escaper->escapeQuote($data['1'], true)."', 
`description`='".$escaper->escapeQuote($data['2'], true)."', 
`address`='".$escaper->escapeQuote($data['3'], true)."'";
            }

            foreach ($employeeProductFixturesSql as $sql){
                $adapter->query($sql);
            }

        }

        $setup->endSetup();
    }
}