<?php

/**
 * Casts anything to array.
 * For primitive values:
 *  1.23 => [1.23];
 *  'abc' => ['abc'];
 * For CSV:
 *  '123, 456, 890' => ['123','456','890'], note: still Strings.
 * For JSON's
 * ... an assoc Array interpretation of a JSON
 * @param mixed $el
 * @return array
 */
function castToArray($el): array
{
    try {
        if ($el === null) return [$el];
        if (is_numeric($el)) return [$el];
        if (is_array($el)) return $el;
        if (is_object($el)) return (array)$el;

        $res = json_decode($el, true, 512);
        if (json_last_error() === JSON_ERROR_NONE) {

            /**
             * Here we keep in mind, the next primitives are VALID JSON values:
             * "a simple string";
             * (int)12345
             * (float)1.2345
             */
            if ($res === null) return [$res];
            if (is_numeric($res)) return [$res];
            if (is_string($res)) return array_map('trim', explode(',', $res));

            return $res;
        }
    } catch (\Throwable  $exception) {
        // Do Nothing
    }
    return array_map('trim', explode(',', $el));
}
