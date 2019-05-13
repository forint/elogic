<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/26/19
 * Time: 8:25 AM
 */

namespace Elogic\Divine\Observer;


class TestEventModuleBefore implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /**
        $modelField = $observer->getField();
        $modelValue = $observer->getValue();
        $modelObject = $observer->getObject();
        $event = $observer->getEvent();
        $collection = $event->getCollection();

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/events.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->debug(get_class());
        $logger->debug(get_class_methods($context));
        die;*/

        // $moduleBeforeEvent = $observer->getData('module_load_before');


        /*$displayText = $observer->getData('mp_text');
        echo $displayText->getText() . " - Event </br>";
        $displayText->setText('Execute event successfully.');*/

        return $this;
    }
}