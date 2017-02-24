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
		$openCurlyPos = $file->findNext(T_OPEN_CURLY_BRACKET, $position);
		$openCurlyPrevToken = ParsingUtilities::skipTokens(
			$file->getTokens(),
			$openCurlyPos,
			[T_WHITESPACE],
			false
		);

		$returnTypeTokens = [T_STRING, T_ARRAY, T_ARRAY_HINT];
		return in_array($openCurlyPrevToken['code'], $returnTypeTokens);
	}

}
