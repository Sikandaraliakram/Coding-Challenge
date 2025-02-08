<?php

namespace App\Helpers;

class VersionComparisonHelper
{
    /**
     * Compare version for timezone.
     *
     * @param string $version The version to compare.
     * @return string The corresponding timezone.
     */
    public static function compareVersion(string $version): string
    {
        if (version_compare($version, Constant::VERSION_COMPARE_VAL, ">=")) {
            return Constant::TIMEZONES['UTC'];
        }

        return Constant::TIMEZONES['EB'];
    }

}