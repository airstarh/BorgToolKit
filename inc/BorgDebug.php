<?php

define('BORG_MICROTIME', $_SERVER['REQUEST_TIME_FLOAT'] ?: microtime(TRUE));

class BorgDebug
{
    ##################################################
    //region FIELDS

    public const LOG_YII_PATH = '/runtime/logs';
    private static string $startMicrotime;
    private static array $flagStarted = [];
    private static array $counterCalls = [];
    public static int $countSome1 = 0;
    public static int $countSome2 = 0;
    public static int $countSome3 = 0;

    //endregion FIELDS
    ##################################################
    //region INIT

    static private function initMicrotime()
    {
        if (static::$startMicrotime)
            return static::$startMicrotime;
        static::$startMicrotime = $_SERVER['REQUEST_TIME_FLOAT'] ?? microtime(TRUE);
        return static::$startMicrotime;
    }

    static protected function initLogFilePath(?string $fPath = null, $transform = null)
    {
        $fPath = $fPath ?? BORG_ROOT . DIRECTORY_SEPARATOR . 'DEBUG.html';

        switch ($transform) {
            case 'php':
                $fPath = $fPath . '.php';
                break;

            case 'json':
                $fPath = $fPath . '.yaml';
                break;
            default:
                break;
        }

        return $fPath;
    }

    //endregion INIT
    ##################################################
    // region DEBUG

    static public function prepareOutput()
    {
        #TODO or Delete
    }

    static public function fDebug($data, $isLog = false, $fPath = null, string $transform = null): void
    {
        $fPath = static::initLogFilePath($fPath, $transform);
        $prefix = [];

        ###############################
        # region FLAGS, COUNTERs, etc.
        static::$flagStarted[$fPath] = static::$flagStarted[$fPath] ?? false;
        static::$counterCalls[$fPath] = isset(static::$counterCalls[$fPath])
            ? ++static::$counterCalls[$fPath]
            : 1;
        # endregion FLAGS, COUNTERs, etc.
        ###############################
        # region CLARIFY TEMPLATE

        switch ($transform) {
            case 'php':
                $output = $data;

                ##################################################
                #region TEMPLATE

                ob_start();
                ob_implicit_flush(FALSE);
                echo PHP_EOL;
                echo '<?php';
                echo PHP_EOL;
                echo sprintf('$XXX_%s = ', static::$counterCalls[$fPath]);
                echo PHP_EOL;

                static::dump($output);

                echo PHP_EOL;
                echo ';';
                echo PHP_EOL;
                echo '?>';
                echo PHP_EOL;

                #endregion TEMPLATE
                ##################################################

                $output = ob_get_clean();

                break;

            case 'json':
                $output = static::jsonEncodeBeautiful($data);
                break;
            case 'flat':
                //ToDO:
                //$output = static::dataToFlat($data);
                break;
            default:
                $output = $data;
                ##################################################
                #region TEMPLATE
                ob_start();
                ob_implicit_flush(FALSE);
                echo PHP_EOL;
                echo '<h1> >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> </h1>';
                echo PHP_EOL;
                echo '<pre>';
                echo PHP_EOL;
                static::dump($output);
                echo PHP_EOL;
                echo '</pre>';
                echo PHP_EOL;
                echo '<h2> <<<<<<<<<<<<<<<<<<<< </h2>';
                echo PHP_EOL;
                #endregion TEMPLATE
                ##################################################

                $output = ob_get_clean();

                break;
        }

        # endregion CLARIFY TEMPLATE
        ###############################
        # region PREFIX

        if (static::$flagStarted[$fPath] === false) {
            static::$flagStarted[$fPath] = true;

            // WIPE LOG FILE
            if ($isLog === false) {
                file_put_contents($fPath, PHP_EOL, 0);
            }

            if ($isLog) {

                $method = static::getReqMethod();
                $ip = static::getUserIp();
                $from = $_SERVER['HTTP_REFERER'] ?? $ip;

                $prefix = [
                    'LOG STARTED ##########################################################################################',
                    $method,
                    "FROM: $from",
                    'SERVER_NAME:' . $_SERVER['SERVER_NAME'] ?? '~HOST',
                    'REQUEST_URI:' . $_SERVER['REQUEST_URI'] ?? '~URI',
                    '$_GET:',
                    json_encode($_GET),
                    '$_POST:',
                    json_encode($_POST),
                ];
            }
        }

        if ($isLog) {

            $date = static::getNow();
            $memory = static::getMemoryUsed() . ' bytes';

            $prefix = array_merge($prefix, [
                "MEM: $memory",
                "AT $date",
            ]);

            $prefix = implode(PHP_EOL . '#> ', $prefix);

            file_put_contents($fPath, PHP_EOL, FILE_APPEND);
            file_put_contents($fPath, PHP_EOL, FILE_APPEND);
            file_put_contents($fPath, $prefix, FILE_APPEND);
        }
        # endregion PREFIX
        ###############################
        # region LOG

        file_put_contents($fPath, $output, FILE_APPEND);
        file_put_contents($fPath, PHP_EOL . PHP_EOL, FILE_APPEND);

        # endregion LOG
        ###############################
    }

    static public function dDebug($data)
    {
        ob_start();
        ob_implicit_flush(FALSE);
        echo BorgTemplate::allCss();
        echo BorgTemplate::allJs();
        echo PHP_EOL;
        echo '<pre>';
        echo PHP_EOL;
        static::dump($data);
        echo PHP_EOL;
        echo '</pre>';
        echo PHP_EOL;
        $output = ob_get_clean();
        echo $output;
        exit();
    }

    static public function jDebug($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    static public function dump($data, $depth = 5)
    {
        try {
            var_export($data, 0);
        } catch (Exception $e) {
            static::print_limited_r($data, $depth);
        }
    }

    static public function print_limited_r($object, $depth = 5)
    {
        if ($depth == 0) {
            return ''; // Stop the recursion
        }

        $output = print_r($object, true);

        if (is_array($object) || is_object($object)) {
            foreach ($object as $key => $value) {
                $output .= static::print_limited_r($value, $depth - 1) . PHP_EOL . '<===>' . PHP_EOL;
            }
        }

        return $output;
    }

    static public function checkExecution($data)
    {
        $data = self::jsonEncodeBeautiful($data);
        $path = BORG_ROOT . DIRECTORY_SEPARATOR . 'DEBUG.txt';
        file_put_contents($path, $data);
    }

    static public function buffer($callback, ...$params)
    {
        ob_start();
        ob_implicit_flush(FALSE);
        call_user_func($callback, $params);
        $output = ob_get_clean();

        return $output;
    }

    static public function returnPrintR($data)
    {
        ob_start();
        ob_implicit_flush(FALSE);
        echo '<hr><pre>';
        echo PHP_EOL;
        print_r($data);
        echo PHP_EOL;
        echo '</pre>';
        $output = ob_get_clean();

        return $output;
    }

    static public function dumpBeautiful($data)
    {
        echo PHP_EOL;
        echo PHP_EOL;
        echo '##################################################';
        echo PHP_EOL;
        var_export($data);
        echo PHP_EOL;
        echo '##################################################';
        echo PHP_EOL;
        echo PHP_EOL;
    }

    // endregion DEBUG
    ##################################################
    // region UTILS/HELPERS

    static public function getMicroTimeDifferenceFromNow($microtime)
    {
        return microtime(TRUE) - $microtime;
    }

    static public function getSpentTime($prepend = [], $append = [])
    {
        $initMicrotime = static::initMicrotime();
        return number_format(static::getMicroTimeDifferenceFromNow($initMicrotime), 10, '.', ' ');
    }

    static public function getNow()
    {
        return date('Y-m-d H:i:s');
    }

    static public function getUserIp()
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        if (!empty($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }
        if (!empty($_SERVER['USER_IP'])) {
            return $_SERVER['USER_IP'];
        }

        return '127.0.0.1';
    }

    static public function getReqMethod()
    {
        if (!empty($_SERVER['REQUEST_METHOD'])) {
            return $_SERVER['REQUEST_METHOD'];
        }

        return 'CONSOLE';
    }

    static public function getMemoryUsed()
    {
        return number_format(memory_get_usage(), 0, '.', ' ');
    }

    static public function template($fileFullPath, $data = NULL)
    {
        $fileFullPath = realpath($fileFullPath);
        ob_start(NULL, 0, PHP_OUTPUT_HANDLER_CLEANABLE | PHP_OUTPUT_HANDLER_FLUSHABLE | PHP_OUTPUT_HANDLER_REMOVABLE);
        ob_implicit_flush(FALSE);
        require($fileFullPath);
        $output = ob_get_clean();

        return $output;
    }

    static public function jsonEncodeBeautiful($s)
    {
        $flags = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
        if (is_array($s) || is_object($s)) {
            return json_encode($s, $flags);
        }
        if (static::isStringValidJson($s, $res)) {
            return json_encode($res, $flags);
        } else {
            return $s;
        }
    }

    static public function isStringValidJson($string, &$strJsonDecoded = null)
    {
        try {
            $strJsonDecoded = json_decode((string) $string, false, 512);
            return (json_last_error() === JSON_ERROR_NONE);
        } // Executed only in PHP 7, will not match in PHP 5
        catch (\Throwable $exception) {
            return false;
        } // Executed only in PHP 5, will not be reached in PHP 7
        catch (\Exception $exception) {
            return false;
        }
    }

    static public function toObject($v)
    {
        if (!isset($v) || empty($v)) {
            return new \stdClass();
        }
        if (is_object($v)) {
            return $v;
        }
        if (is_array($v)) {
            // ToDo: Make less heavy
            return json_decode(json_encode($v), false);
        }
        if (is_string($v)) {
            $res = json_decode($v);
            if (json_last_error() == JSON_ERROR_NONE) {
                return $res;
            }
        }

        //throw new \Exception('Unable to convert to object');
        return (object) [];
    }

    static public function getCallStack(array $backtrace = null): array
    {
        if ($backtrace === null) {
            $backtrace = debug_backtrace();
        }

        $stack = [];
        foreach ($backtrace as $trace) {
            $functionName = '';
            $functionName .= $trace['class'] ?? '';
            $functionName .= $trace['type'] ?? '';
            $functionName .= $trace['function'] ?? '';

            $stack[] = $functionName;
        }
        $stack['$_GET'] = $_GET;
        $stack['$_POST'] = $_POST;
        return $stack;
    }

    // endregion UTILS/HELPERS
    ##################################################
}
