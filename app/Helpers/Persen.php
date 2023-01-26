<?php

function persen($value, $total)
{
    return $value == 0 ? 0 : round(($value / $total) * 100);
}
