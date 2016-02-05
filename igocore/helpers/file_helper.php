<?php defined('BASEPATH') || exit('No direct script access allowed');
/**
 * File helper functions.
 *
*/

if ( ! function_exists('get_filenames_by_extension')) {
    /**
     * Get filenames by extension.
     *
     * Read the specified directory and build an array containing the filenames.
     * Any sub-folders contained within the specified path are also read.
     *
     * @param string $sourceDir   Path to the directory.
     * @param array $extensions   Extensions of files to retrieve.
     * @param bool $includePath Whether the path will be included with the
     * filename.
     * @param bool $_recursion   Internal variable to determine recursion status.
     * Not intended for external use.
     *
     * @return array    An array of filenames.
     */
	function get_filenames_by_extension($sourceDir, $extensions = array(), $includePath = false, $_recursion = false)
	{
		static $_filedata = array();

		if ($fp = @opendir($sourceDir)) {
			// Reset the array and ensure $sourceDir has a trailing slash on the
            // initial call
			if ($_recursion === false) {
				$_filedata = array();
				$sourceDir = rtrim(realpath($sourceDir), DIRECTORY_SEPARATOR)
                    . DIRECTORY_SEPARATOR;
			}

			while (false !== ($file = readdir($fp))) {
                if (strncmp($file, '.', 1) === 0) {
                    continue;
                }

                if (@is_dir("{$sourceDir}{$file}")) {
                    get_filenames_by_extension(
                        "{$sourceDir}{$file}" . DIRECTORY_SEPARATOR,
                        $extensions,
                        $includePath,
                        true
                    );
                } elseif (in_array(pathinfo($file, PATHINFO_EXTENSION), $extensions)) {
                    $_filedata[] = $includePath ? "{$sourceDir}{$file}" : $file;
                }
			}

			return $_filedata;
		}

		return false;
	}
}
/* End file_helper.php */