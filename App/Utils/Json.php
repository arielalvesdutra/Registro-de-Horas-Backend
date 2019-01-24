<?php

namespace App\Utils;

class Json {

    public static function convertArrayToJson($array = [])
    {
        $json = '[';

        foreach ($array as $element) {

            if ($element == end($array)) {
                $json .= json_encode($element);
            } else {
                $json .= json_encode($element) . ',';
            }
        }

        $json .= ']';

        return $json;
    }
}