<?php
class StatusModel
{
    private static $statuses = [
        0 => 'OK',
        1 => 'Communication failure',
        2 => 'Bad operation',
        3 => 'Class not found',
        4 => 'Incomplete input data',
        5 => 'Cannot connect to database',
        6 => 'Vehicle not found in database',
        7 => 'Cannot insert log to database',
        8 => 'No log'

    ];

    public static function mess(int $statusKey): string
    {
        return (self::$statuses[$statusKey] ?? '');
    }
}
