<?php

final class DataHelper
{
    // region OPERATORS

    /**
     * @template T
     * @param T $a
     * @param T $b
     * @return T
     */

    public static function increment(&$a, $b)
    {
        return $a += $b;
    }

    /**
     * @template T
     * @param T $a
     * @param T $b
     * @return T
     */

    public static function decrement(&$a, $b)
    {
        return $a -= $b;
    }

    public static function concat(string &$a, string $b): string
    {
        return $a .= $b;
    }

    // endregion OPERATORS

    // region ASSIGNEE

    /**
     * @template T
     * @param string $path
     * @param string $operator
     * @param T $value
     * @param array $array
     * @return T
     */
    public static function setByPath(
        string $path,
        string $operator,
        mixed $value,
        ?array &$array = []
    ) {
        $el = &$array;
        if ($path !== '') {
            foreach (explode('/', $path) as $string) {
                $el = &$el[$string];
            }
        }

        switch ($operator) {
            case '-=':
                $el ??= 0;
                $el = self::decrement($el, $value);
                break;
            case '+=':
                $el ??= 0;
                $el = self::increment($el, $value);
                break;
            case '.=':
                $el ??= '';
                $el = self::concat($el, $value);
                break;
            case 'timeDiff':
                $timeStart = $value;
                $timeEnd = 0;

                if (is_array($value)) {
                    $timeStart = $value[0] ?? microtime(true);
                    $timeEnd = $value[1] ?? microtime(true);
                }

                $el = self::timeDiff($timeStart, $timeEnd);
                break;
            case '=':
            default:
                $el = $value;
                break;
        }

        return $el;
    }

    // endregion ASSIGNEE

    // region OTHER
    public static function timeDiff(
        float $timeStart,
        ?float $timeEnd = 0
    ): float {
        if ($timeEnd === 0) {
            $timeEnd = microtime(true);
        }

        return $timeEnd - $timeStart;
    }

    // endregion OTHER
}
