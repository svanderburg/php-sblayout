<?php
/**
 * @file
 * @brief View-HTML-Util module
 * @defgroup View-HTML-Util
 * @{
 */

namespace SBLayout\View\HTML\Util;

/**
 * Checks whether the given path is absolute and if not it prefixes it with the
 * provided base dir.
 *
 * @param $baseDir Base dir to prefix
 * @param $path Path to examine
 * @return An absolute path, optionally with base dir as prefix
 */
function composeContentPath(string $baseDir, string $path): string
{
	if(substr($path, 0, 1) === "/")
		return $path; // If path is absolute, just include the module
	else
		return $baseDir."/".$path; // If path is relative, prefix the basedir
}

/**
 * @}
 */
?>
