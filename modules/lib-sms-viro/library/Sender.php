<?php
/**
 * Sender
 * @package lib-sms-viro
 * @version 0.0.1
 */

namespace LibSmsViro\Library;

use LibCurl\Library\Curl;

class Sender implements \LibSms\Iface\Sender
{
    static $last_error;
    static $last_errno;

    static function send(string $phone, string $message): bool
    {
        $conf = \Mim::$app->config->libSmsViro;
        $phone = preg_replace('!^0!', '62', $phone);
        $opts = [
            'url'       => 'https://api.smsviro.com/restapi/sms/1/text/single',
            'method'    => 'POST',
            'agent'     => 'LibSmsViro v0.0.1',
            'headers'       => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'App ' . $conf->apikey
            ],
            'body' => [
                'from' => $conf->senderid,
                'to'   => $phone,
                'text' => $message
            ]
        ];

        $result = Curl::fetch($opts);
        if (!$result) {
            return self::setError(100, 'Unknow Error');
        }

        if (!isset($result->messages)) {
            return self::setError(100, 'Invalid Vendor API Response');
        }

        foreach ($result->messages as $message) {
            $status = $message->status;

            if ($status->groupName != 'ACCEPTED') {
                return self::setError($status->id, $status->description);
            }
        }

        return true;
    }

    static function lastError(): ?string
    {
        return self::$last_error;
    }

    static function lastErrno(): ?int
    {
        return self::$last_errno;
    }

    static function setError(int $num, string $text): bool
    {
        self::$last_errno = $num;
        self::$last_error = $text;

        return false;
    }
}
