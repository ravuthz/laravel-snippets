<?php

namespace App\Services;

class PassportUtils
{
    /**
     * @param $filePath
     * @param $content
     * @return string
     */
    public static function setKey($filePath, $content): string
    {
        if (str_starts_with($content, 'base64:')) {
            $content = base64_decode(substr($content, 7), true);
        }

        file_put_contents($filePath, $content);

        if (!windows_os()) {
            chmod($filePath, 0660);
        }

        return $content;
    }

    /**
     * @param $text
     * @return string
     */
    public static function encodeKey($text): string
    {
        return 'base64:' . base64_encode($text);
    }

    /**
     * @param string $keyPath
     * @param bool $isPublicKey
     * @return array [$resultCode, $output]
     */
    public static function checkKey($keyPath, $isPublicKey): array
    {
        $command = $isPublicKey
            ? "openssl rsa -pubin -in $keyPath -text -noout"
            : "openssl rsa -check -in $keyPath";

        $output = null;
        $resultCode = null;

        exec($command, $output, $resultCode);

        $output = implode("\n", $output);

        return [$resultCode, $output];
    }
}
