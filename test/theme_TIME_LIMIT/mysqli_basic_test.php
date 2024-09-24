<?php
define('TIME_START', microtime(true));

/**
 * В этом классе все, что надо задать руками
 */
class DbUsage
{

    /**
     * Всё, что касается БД
     * , включая дополнительные опции соединения.
     * Просто гугли названия функций и добавляй-убирай настройки.
     */
    public function mysqli()
    {
        $host     = '127.0.0.1';
        $user     = 'bonusdev';
        $password = 'XXX';
        $db       = 'bonusdev';
        $port     = 3306;
        $timeout  = 10;

        /**
         * Получаем PHP-объект Драйвера mysqli.
         */
        $mysqli = mysqli_init();

        /**
         * Вот здесь задаём время ожидания сервера.
         */
        $mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, $timeout);

        $mysqli->real_connect($host, $user, $password, $db, $port);

        return $mysqli;
    }

    /**
     * Твой запрос в БД. Меняё, на что хочешь..
     */
    public function sql()
    {
        return "
        EXPLAIN SELECT * 
        FROM Logs 
        LIMIT 10
        ";
    }

    /**
     * Всё, что надо знать о PHP
     * Просто гугли названия функций и добавляй-убирай имена настроек.
     */
    public function aboutPhp()
    {
        return [
            'phpversion'         => phpversion(),
            'safe_mode'          => ini_get('safe_mode'),
            'max_execution_time' => ini_get('max_execution_time'),
        ];
    }
}

######################################################################################################################################################

function testDbUsage()
{
    /**
     * Устанавливаем Время Выполнения PHP скрипта
     */
    set_time_limit(30);

    $answer = [];
    $obj    = new DbUsage();

    /**
     * Получаем базовые параметры PHP сервера
     */
    $answer['info_php'] = $obj->aboutPhp();

    /**
     * Подключаемся к БД
     */
    $mysqli             = $obj->mysqli();
    $answer['info_sql'] = $mysqli->host_info;

    /**
     * Делаем запрос к БД
     */
    $sql                  = $obj->sql();
    $sqlGenerator         = $mysqli->query($sql);
    $sqlResult            = $sqlGenerator->fetch_all(MYSQLI_ASSOC);
    $answer['$sqlResult'] = $sqlResult;

    /**
     * Получаем время выполнения скрпита.
     */
    $timeSpent                                = microtime(true) - TIME_START;
    $answer['SCRIPT SPENT TIME MILLISECONDS'] = $timeSpent;

    /**
     * Вывод результата твоего скрипта в консоль или браузер.
     */
    echo PHP_EOL;
    echo '<pre>';
    echo PHP_EOL;
    echo '##################################################';
    echo PHP_EOL;
    echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    echo PHP_EOL;
    echo '##################################################';
    echo PHP_EOL;
    echo PHP_EOL;
}

testDbUsage();