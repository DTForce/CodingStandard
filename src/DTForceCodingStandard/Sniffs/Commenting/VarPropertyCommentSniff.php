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

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Standards_AbstractVariableSniff;


/**
 * Rules:
 * - Property should have docblock comment (except for {@inheritdoc}).
 *
 * @see PHP_CodeSniffer_Standards_AbstractVariableSniff is used, because it's very difficult to
 * separate properties from variables (in args, method etc.). This class does is for us.
 */
final class VarPropertyCommentSniff extends PHP_CodeSniffer_Standards_AbstractVariableSniff
{

	/**
	 * {@inheritdoc}
	 */
	protected function processMemberVar(PHP_CodeSniffer_File $file, $position)
	{
		$commentString = $this->getPropertyComment($file, $position);

		if (strpos($commentString, '{@inheritdoc}') !== FALSE) {
			return;
		}

		if (strpos($commentString, '@var') !== FALSE) {
			return;
		}

		$file->addError('Property should have docblock comment.', $position);
	}


	/**
	 * {@inheritdoc}
	 */
	protected function processVariable(PHP_CodeSniffer_File $file, $position)
	{
	}


	/**
	 * {@inheritdoc}
	 */
	protected function processVariableInString(PHP_CodeSniffer_File $file, $position)
	{
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return string
	 */
	private function getPropertyComment(PHP_CodeSniffer_File $file, $position)
	{
		$commentEnd = $file->findPrevious([T_DOC_COMMENT_CLOSE_TAG], $position);
		if ($commentEnd === FALSE) {
			return '';
		}

		$tokens = $file->getTokens();
		if ($tokens[$commentEnd]['code'] !== T_DOC_COMMENT_CLOSE_TAG) {
			return '';

		} else {
			// Make sure the comment we have found belongs to us.
			$commentFor = $file->findNext(T_VARIABLE, $commentEnd + 1);
			if ($commentFor !== $position) {
				return '';
			}
		}

		$commentStart = $file->findPrevious(T_DOC_COMMENT_OPEN_TAG, $position);
		return $file->getTokensAsString($commentStart, $commentEnd - $commentStart + 1);
	}

}
