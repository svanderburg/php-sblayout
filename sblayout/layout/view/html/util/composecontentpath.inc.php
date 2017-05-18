<?php
/**
 * Checks whether the given path is absolute and if not it prefixes it with the
 * provided base dir.
 *
 * @param string $baseDir Base dir to prefix
 * @param string $path Path to examine
 * @return An absolute path, optionally with base dir as prefix
 */
function composeContentPath($baseDir, $path)
{
	if(substr($path, 0, 1) === "/")
		return $path; // If path is absolute, just include the module
	else
		return $baseDir."/".$path; // If path is relative, prefix the basedir
}
?>
