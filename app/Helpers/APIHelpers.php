<?php

namespace App\Helpers;

class APIHelpers
{
    public static function createApiResponse($is_error, $code, $message, $content)
    {
        $result = [];

        if ($is_error) {
            $result['success'] = false;
            $result['code'] = $code;
            $result['message'] = $message;
        } else {
            $result['success'] = true;
            $result['code'] = $code;

            if (is_null($content)) {
                $result['message'] = $message;
            } else {
                $result['data'] = $content;
            }
        }

        return $result;
    }
}

?>
