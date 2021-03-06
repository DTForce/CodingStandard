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
 */

namespace DTForceCodingStandard\Helper\Parsing;


use PHP_CodeSniffer_File;

class ParsingUtilities
{

	public static function skipTokens($tokens, $position, $toSkip, $forward)
	{
		$token = null;

		do {
			$position = $forward === true ? $position + 1 : $position - 1;
			$token = $tokens[$position];
		} while ($token && in_array($token['code'], $toSkip));

		return $token;
	}


	public static function hasFunctionReturnType(PHP_CodeSniffer_File $file, $position)
	{
		$openCurlyPos = $file->findNext(T_CLOSE_PARENTHESIS, $position);
		$openCurlyPrevToken = ParsingUtilities::skipTokens(
			$file->getTokens(),
			$openCurlyPos,
			[T_WHITESPACE, T_COLON, T_INLINE_ELSE, T_INLINE_THEN, T_NULLABLE],
			true
		);

		return $openCurlyPrevToken['code'] === T_RETURN_TYPE;
	}

}
