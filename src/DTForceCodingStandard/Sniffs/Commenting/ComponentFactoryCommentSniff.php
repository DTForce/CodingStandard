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

use DTForceCodingStandard\Helper\Parsing\ParsingUtilities;
use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - CreateComponent* method should have a doc comment.
 * - CreateComponent* method should have a return tag.
 * - Return tag should contain type.
 */
final class ComponentFactoryCommentSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var int
	 */
	private $position;

	/**
	 * @var PHP_CodeSniffer_File
	 */
	private $file;

	/**
	 * @var array
	 */
	private $tokens;


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
		$this->file = $file;
		$this->position = $position;
		$this->tokens = $file->getTokens();

		if ( ! $this->isComponentFactoryMethod()
			|| ParsingUtilities::hasFunctionReturnType($file, $position)
		) {
			return;
		}

		$commentEnd = $this->getCommentEnd();
		if ( ! $this->hasMethodComment($commentEnd)) {
			$file->addError('CreateComponent* method should have a doc comment', $position);
			return;
		}

		$commentStart = $this->tokens[$commentEnd]['comment_opener'];
		$this->processReturnTag($commentStart);
	}


	/**
	 * @return bool
	 */
	private function isComponentFactoryMethod()
	{
		$functionName = $this->file->getDeclarationName($this->position);
		return (strpos($functionName, 'createComponent') === 0);
	}


	/**
	 * @return bool|int
	 */
	private function getCommentEnd()
	{
		return $this->file->findPrevious(T_WHITESPACE, ($this->position - 3), NULL, TRUE);
	}


	/**
	 * @param int $position
	 * @return bool
	 */
	private function hasMethodComment($position)
	{
		if ($this->tokens[$position]['code'] === T_DOC_COMMENT_CLOSE_TAG) {
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * @param int $commentStartPosition
	 */
	private function processReturnTag($commentStartPosition)
	{
		$return = NULL;
		foreach ($this->tokens[$commentStartPosition]['comment_tags'] as $tag) {
			if ($this->tokens[$tag]['content'] === '@return') {
				$return = $tag;
			}
		}
		if ($return !== NULL) {
			$content = $this->tokens[($return + 2)]['content'];
			if (empty($content) === TRUE || $this->tokens[($return + 2)]['code'] !== T_DOC_COMMENT_STRING) {
				$error = 'Return tag should contain type';
				$this->file->addError($error, $return);
			}

		} else {
			$error = 'CreateComponent* method should have a @return tag';
			$this->file->addError($error, $this->tokens[$commentStartPosition]['comment_closer']);
		}
	}

}
