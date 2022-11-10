<?php

if (! function_exists('print_balance')) {
    function print_balance($value): string
    {
        return sprintf('%.8f', floatval($value));
    }
}
