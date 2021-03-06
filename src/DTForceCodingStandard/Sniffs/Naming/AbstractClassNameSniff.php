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

namespace DTForceCodingStandard\Sniffs\Naming;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - Abstract class should have prefix "Abstract"
 */
final class AbstractClassNameSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var PHP_CodeSniffer_File
	 */
	private $file;

	/**
	 * @var int
	 */
	private $position;


	/**
	 * {@inheritdoc}
	 */
	public function register()
	{
		return [T_CLASS];
	}


	/**
	 * {@inheritdoc}
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$this->file = $file;
		$this->position = $position;

		if ( ! $this->isClassAbstract()) {
			return;
		}

		if (strpos($this->getClassName(), 'A') === 0) {
			return;
		}

		$file->addError('Abstract class should have prefix "A".', $position);
	}


	/**
	 * @return bool
	 */
	private function isClassAbstract()
	{
		$classProperties = $this->file->getClassProperties($this->position);
		return $classProperties['is_abstract'];
	}


	/**
	 * @return string|FALSE
	 */
	private function getClassName()
	{
		$namePosition = $this->file->findNext(T_STRING, $this->position);
		if ( ! $namePosition) {
			return FALSE;
		}

		return $this->file->getTokens()[$namePosition]['content'];
	}

}
