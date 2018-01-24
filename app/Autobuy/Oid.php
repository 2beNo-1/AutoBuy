<?php

namespace App\Autobuy;

class Oid
{

    const OID_LENGTH = 17;

    public function get()
    {
        return date('YmdHis') . mt_rand(100, 999);
    }

    public function validate($oid)
    {
        if (strlen($oid) != self::OID_LENGTH) {
            return false;
        }
        if (substr($oid, 0, 8) != date('Ymd')) {
            return false;
        }
        return true;
    }

}