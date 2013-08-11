<?php
namespace Mauris\Ini;

class Dumper
{
    public function dump($input)
    {
        $output = '';
        foreach ($input as $section => $array) {
            $output .= self::writeSection($section, $array);
        }
        return $output;
    }

    protected static function writeSection($section, $array)
    {
        $subsections = array();
        $output = "[$section]\n";
        foreach ($array as $key => $value) {
            if (is_array($value) || is_object($value)) {
                $key = $section . '.' . $key;
                if (isset($subsections[$key])) {
                    $subsections[$key] = array_merge($subsections[$key], (array)$value);
                } else {
                    $subsections[$key] = (array)$value;
                }
            } else {
                $output .= self::normalizeKey($key) . '=';
                if (is_string($value)) {
                    $output .= '"' . addslashes($value) .'"';
                } elseif (is_bool($value)) {
                    $output .= $value ? 'true' : 'false';
                } else {
                    $output .= $value;
                }
                $output .= "\n";
            }
        }

        if($subsections){
            $output .= "\n";
            foreach ($subsections as $section => $array) {
                $output .= self::writeSection($section, $array) . "\n";
            }
        }
        return $output;
    }

    protected static function normalizeKey($key)
    {
        return str_replace('=', '_', $key);
    }
}
