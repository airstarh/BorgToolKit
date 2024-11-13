<?php
require_once __DIR__ . '/../index.php';

class A
{
    private $propPrivate = 'prop';

    public function methodPublic()
    {
        register_shutdown_function(function () {
            \BorgDebug::dumpBeautiful($this);
        });

        return __METHOD__;
    }

    static public function methodPublicStatic()
    {
        $OOO = new self();
        register_shutdown_function(function () use ($OOO) {
            \BorgDebug::dumpBeautiful((new self()));
        });

        return __METHOD__;
    }

    static public function test()
    {
        echo $name = 'my name';
    }
}

class B
{
    private $propPrivate = 'Property Private';
}

###$XXX = (new A)->methodPublic();
###$XXX = A::methodPublicStatic();
###BorgDebug::dumpBeautiful($XXX);

function ASD(
    $par1 = '1',
    $par2 = 2,
    $par3 = 'par3',
)
{

    $rf = new ReflectionFunction(__FUNCTION__);
    foreach ($rf->getParameters() as $p) {
        echo $p->getName(), ' - ', $p->isDefaultValueAvailable() ?
            $p->getDefaultValue() : 'none', PHP_EOL;
    }

    return func_get_args();
}

BorgDebug::dumpBeautiful(ASD());
