<?php

function a(){
    echo 1;
    register_shutdown_function('b');
}

function b()
{
    echo 2;
}

a();