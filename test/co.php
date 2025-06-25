<?php

class MyClass
{
    private static ?string $aString;

    public function XXX()
    {
        static::$aString = static::$aString ?: 'asd';
    }
}

echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;
echo $zk->getState();
echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;