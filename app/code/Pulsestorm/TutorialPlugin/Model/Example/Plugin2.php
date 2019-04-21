<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/21/19
 * Time: 12:25 AM
 */

namespace Pulsestorm\TutorialPlugin\Model\Example;


class Plugin2
{
    public function afterGetMessage($subject, $result)
    {
        echo "Calling " , __METHOD__ , "\n";
        echo "Value of \$result: " . $result,"\n";
        return 'From Plugin 2';
    }
}