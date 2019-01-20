<?php

namespace Bank\Services\Persistance;

class ParseMethods
{
    public static function getMethods($className)
    {
        $allMethods = get_class_methods($className);

        foreach ($allMethods as $method_name) {
            if (strpos($method_name, 'get') === 0) {
                if (!strpos($method_name, 'Acc')) {
                    if (!strpos($method_name, 'Id')) {
                        if (!strpos($method_name, 'Name')) {
                            $methods[] = $method_name;
                        }
                    }
                }
            }
        }

        return $methods;
    }
}