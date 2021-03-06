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

namespace DTForceCodingStandard\Sniffs\Commenting;

use DTForceCodingStandard\Helper\Commenting\MethodDocBlock;
use DTForceCodingStandard\Helper\Parsing\ParsingUtilities;
use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - Getters should have @return tag (except for {@inheritdoc}).
 */
final class MethodCommentReturnTagSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var string[]
	 */
	private $getterMethodPrefixes = ['get', 'is', 'has'];


	/**
	 * {@inheritdoc}
	 */
	public function register()
	{
		return [T_FUNCTION];
	}


	/**
	 * {@inheritdoc}
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$methodName = $file->getDeclarationName($position);
		if (!$this->guessIsGetterMethod($methodName)
			|| ParsingUtilities::hasFunctionReturnType($file, $position) // If function has return type, dockblock with anotations is not necessary.
		) {
			return;
		}

		if (!MethodDocBlock::hasMethodDocBlock($file, $position)) {
			$file->addError('Getters should have docblock.', $position);
			return;
		}

		$commentString = MethodDocBlock::getMethodDocBlock($file, $position);

		if (strpos($commentString, '{@inheritdoc}') !== FALSE) {
			return;
		}

		if (strpos($commentString, '@return') !== FALSE) {
			return;
		}

		$file->addError('Getters should have @return tag (except {@inheritdoc}).', $position);
	}


	/**
	 * @param string $methodName
	 * @return bool
	 */
	private function guessIsGetterMethod($methodName)
	{
		foreach ($this->getterMethodPrefixes as $getterMethodPrefix) {
			if (strpos($methodName, $getterMethodPrefix) === 0) {
				if (strlen($methodName) === strlen($getterMethodPrefix)) {
					return TRUE;
				}

				$endPosition = strlen($getterMethodPrefix);
				$firstLetterAfterGetterPrefix = $methodName[$endPosition];

				if (ctype_upper($firstLetterAfterGetterPrefix)) {
					return TRUE;
				}
			}
		}

		return FALSE;
	}

}
