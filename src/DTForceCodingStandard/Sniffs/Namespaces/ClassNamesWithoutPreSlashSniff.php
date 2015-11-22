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

namespace DTForceCodingStandard\Sniffs\Namespaces;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - Class name after new/instanceof should not start with slash
 */
final class ClassNamesWithoutPreSlashSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var string[]
	 */
	private $excludedClassNames = [
		'DateTime', 'stdClass', 'splFileInfo', 'Exception'
	];


	/**
	 * {@inheritdoc}
	 */
	public function register()
	{
		return [T_NEW, T_INSTANCEOF];
	}


	/**
	 * {@inheritdoc}
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		$classNameStart = $tokens[$position + 2]['content'];

		if ($classNameStart === '\\') {
			if ($this->isExcludedClassName($tokens[$position + 3]['content'])) {
				return;
			}
			$file->addError('Class name after new/instanceof should not start with slash.', $position);
		}
	}


	/**
	 * @param string $className
	 * @return bool
	 */
	private function isExcludedClassName($className)
	{
		if (in_array($className, $this->excludedClassNames)) {
			return TRUE;
		}
		return FALSE;
	}

}
