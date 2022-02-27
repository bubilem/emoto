<?php

class SignatureModel
{
    private $signature;

    public function __construct(string $secret, array $data)
    {
        $this->signature = self::make($secret, $data);
    }

    /**
     * Make a signature
     *
     * @param string $secret
     * @param array $data
     * @return string signature
     */
    public static function make(string $secret, array $data): string
    {
        return hash(
            'sha1',
            self::serializeDataValues($data) . '|' . $secret
        );
    }

    /**
     * Check the signature
     *
     * @param string $secret
     * @param array $data
     * @return bool true if the signature in data is correct
     */
    public static function check(string $secret, array $data): bool
    {
        if (empty($data['signature'])) {
            return false;
        }
        $signature = $data['signature'];
        unset($data['signature']);
        return strlen($signature) === 40
            && self::make($secret, $data) === $signature;
    }

    /**
     * Serialize data for signature
     *
     * @param array $data
     * @return string serialized data
     */
    public static function serializeDataValues(array $data): string
    {
        $output = "";
        foreach ($data as $value) {
            $output .=
                ($output ? "|" : "") .
                (is_array($value) ? implode("|", $value) : $value);
        }
        return $output;
    }

    public function __toString()
    {
        return $this->signature;
    }
}
