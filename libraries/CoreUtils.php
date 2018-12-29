<?php

namespace app\libraries;

use app\libraries\CoreUtils;

class CoreUtils{
	$SYSTEM_LOG_LEVEL = 'C:\wamp64\logs\mula_groups\\';
	$logDirectory = 'C:\wamp64\logs\mula_groups\\';

    /**
     * Log String to log File in a predetermined format
     *
     * @param int/text $logLevel
     *          0 = 'CRITICAL', 1 = 'FATAL', 2 = 'ERROR', 3 = 'WARNING', 4 = 'INFO', 5 = 'SEQUEL', 6 = 'TRACE', 7 = 'DEBUG', 8 = 'CUSTOM', 9 = 'UNDEFINED';
     * @param string $logString
     * @param string $filename
     * @param string $function
     * @param int $lineNo
     */
    public static function flog($logLevel, $logString = NULL, $fileName = NULL, $function = NULL, $lineNo = NULL) {
        //$SYSTEM_LOG_LEVEL = self::getConfigurationValue('SYSTEM_LOG_LEVEL', 10);

        //$logDirectory = self::getConfigurationValue('LOG_DIRECTORY');
        $file = $logDirectory . "DEBUG.log";
        $date = self::now($format ="M j H:i:s");
        $logType = null;
        $logType [0] = 'CRITICAL';
        $logType [1] = 'FATAL';
        $logType [2] = 'ERROR';
        $logType [3] = 'WARNING';
        $logType [4] = 'INFO';
        $logType [5] = 'SEQUEL';
        $logType [6] = 'TRACE';
        $logType [7] = 'DEBUG';
        $logType [8] = 'CUSTOM';
        $logType [9] = 'UNDEFINED';
        $logTitle = 'UNDEFINED';

        // covert ID to file Name
        if (!is_int($logLevel)) { // level is a string convert back to int and overide the default file
            if (strtolower(substr($logLevel, (strlen($logLevel) - 4), 4)) == '.log' or strtolower(substr($logLevel, (strlen($logLevel) - 4), 4)) == '.txt') { // overide the current paths {{faster than changing all scripts with custom paths}}
                $file = $logDirectory . basename($logLevel);
            } else { // file does not have the correct extension.
                $file = $logDirectory . basename($logLevel) . '.log';
            }

            $logLevel = 8;
        } else {
            if (isset($logType [$logLevel])) {
                // overide the current paths {{faster than changing all scripts with custom paths}}
                $file = $logDirectory . basename($logType [$logLevel]) . ".log";
            } else {
                $logLevel = 9;
            }
        }

        $logTitle = $logType [$logLevel];

        if ($fileName == NULL)
            $fileName = $_SERVER ['PHP_SELF'];

        // should be <= $DEBUG_LEVEL
        if ($logLevel <= $SYSTEM_LOG_LEVEL) {
                if ($fo = fopen($file, 'ab')) {
                fwrite($fo, "$date ".$_SERVER['REMOTE_ADDR']." ".$_SERVER ['PHP_SELF'].": [$logTitle] $fileName:$lineNo $function| ".((is_array($logString)) ? print_r($logString,true) : $logString)."\n");
                fclose($fo);
            } else {
                trigger_error("flog Cannot log '$logString' to file '$file' ", E_USER_WARNING);
            }
        }
    }
}
?>