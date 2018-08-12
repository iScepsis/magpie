<?php
/**
 * Created by PhpStorm.
 * User: Scepsis
 * Date: 11.08.2018
 * Time: 15:45
 */

namespace src\Validators;

use src\Entity\Tasks;
use src\Validators\Validator;

class TasksValidator extends Validator
{
    public static function validate( $task){
        if (!$task instanceof Tasks) throw new \Exception('Incorrect class. Expected src\Entity\Tasks');

        if (self::checkRequired($task->getTitle())) {
            self::$validateLog['title'] = ['validateMessage' => 'Tile must be filled'];
        }

        if (self::checkRequired($task->getDescription())) {
            self::$validateLog['description'] = ['validateMessage' => 'Description must be filled'];
        }

        if (!empty($task->getTimeToNotify()) && !self::checkTimestamp($task->getTimeToNotify())) {
            self::$validateLog['time_to_notify'] = [
                'validateMessage' => 'Time to notify is incorrect, check time format'
            ];
        }

        if ( !empty($task->getIsActual()) && !in_array($task->getIsActual(), ['0', '1']) ) {
            self::$validateLog['is_actual'] = [
                'validateMessage' => "I don'n know how you get here, but your value is incorrect"
            ];
        }

        return empty($validateLog);

    }
}