<?php
class Conversions {
    /**
     * Convert bytes to a human-readable format.
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    public static function bytesToReadable($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Convert bits to bytes.
     *
     * @param int $bits
     * @return float
     */
    public static function bitsToBytes($bits) {
        return $bits / 8;
    }

    /**
     * Convert bytes to bits.
     *
     * @param int $bytes
     * @return int
     */
    public static function bytesToBits($bytes) {
        return $bytes * 8;
    }

    /**
     * Convert seconds to minutes.
     *
     * @param int $seconds
     * @return float
     */
    public static function secondsToMinutes($seconds) {
        return $seconds / 60;
    }

    /**
     * Convert minutes to seconds.
     *
     * @param int $minutes
     * @return int
     */
    public static function minutesToSeconds($minutes) {
        return $minutes * 60;
    }

    /**
     * Convert minutes to hours.
     *
     * @param int $minutes
     * @return float
     */
    public static function minutesToHours($minutes) {
        return $minutes / 60;
    }

    /**
     * Convert hours to minutes.
     *
     * @param int $hours
     * @return int
     */
    public static function hoursToMinutes($hours) {
        return $hours * 60;
    }

    /**
     * Convert kilobits per second (kbps) to megabits per second (Mbps).
     *
     * @param float $kbps
     * @return float
     */
    public static function kbpsToMbps($kbps) {
        return $kbps / 1000;
    }

    /**
     * Convert megabits per second (Mbps) to kilobits per second (kbps).
     *
     * @param float $mbps
     * @return float
     */
    public static function mbpsToKbps($mbps) {
        return $mbps * 1000;
    }

    /**
     * Convert megabytes per second (MBps) to megabits per second (Mbps).
     *
     * @param float $MBps
     * @return float
     */
    public static function MBpsToMbps($MBps) {
        return $MBps * 8;
    }

    /**
     * Convert megabits per second (Mbps) to megabytes per second (MBps).
     *
     * @param float $Mbps
     * @return float
     */
    public static function MibpsToMBps($Mbps) {
        return $Mbps / 8;
    }
}

