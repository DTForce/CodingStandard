<?php

/**
 * This file is part of DTForce\CodingStandard
 *
 * Copyright for portions of project DTForce\CodingStandard
 * are held by Tomáš Votruba, 2012 as part of project Zenify.
 * All the other copyright for project DTForce\CodingStandard are
 * held by DTForce s.r.o, 2015.
 *
 * Copyright (c) 2015 DTForce s.r.o. (http://www.dtforce.com)
 * Copyright (c) 2012 Tomáš Votruba (http://tomasvotruba.cz)
 */

namespace DTForceCodingStandard\Helper\Commenting;

use PHP_CodeSniffer_File;


final class MethodDocBlock
{

	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	public static function hasMethodDocBlock(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		$currentToken = $tokens[$position];
		$docBlockClosePosition = $file->findPrevious(T_DOC_COMMENT_CLOSE_TAG, $position);

		if ($docBlockClosePosition === FALSE) {
			return FALSE;
		}

		$docBlockCloseToken = $tokens[$docBlockClosePosition];
		if ($docBlockCloseToken['line'] === ($currentToken['line'] - 1)) {
			return TRUE;
		}

		return FALSE;
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return string
	 */
	public static function getMethodDocBlock(PHP_CodeSniffer_File $file, $position)
	{
		if ( ! self::hasMethodDocBlock($file, $position)) {
			return '';
		}

		$commentStart = $file->findPrevious(T_DOC_COMMENT_OPEN_TAG, $position - 1);
		$commentEnd = $file->findPrevious(T_DOC_COMMENT_CLOSE_TAG, $position - 1);
		return $file->getTokensAsString($commentStart, $commentEnd - $commentStart + 1);
	}

}
