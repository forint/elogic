<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/20/19
 * Time: 11:44 PM
 */

namespace Pulsestorm\TutorialPlugin\Model\Example;


class Plugin
{

    public function afterGetMessage($subject, $result)
    {
        echo "Calling " , __METHOD__ , "\n";
        echo "Value of \$result: " . $result,"\n";
        return 'From Plugin 1';
    }
//    public function beforeGetMessage($subject, $thing='World', $should_lc=false)
//    {
//        return ['Changing the argument', $should_lc];
//    }
//
//    public function afterGetMessage($subject, $thing='World', $should_lc=false)
//    {
//        return 'We are so tired of saying '.$should_lc;
//    }

//    public function aroundGetMessage($subject, $procede, $thing='World', $should_lc=false)
//    {
//        var_dump(is_callable($procede));die;
//        echo 'Calling' . __METHOD__ . ' -- before',"\n";
//        $result = $procede();
//        echo 'Calling' . __METHOD__ . ' -- after',"\n";
//        return $result;
//    }
}