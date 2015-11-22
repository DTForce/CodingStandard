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
 * - Interface should have suffix "Interface"
 */
final class InterfaceNameSniff implements PHP_CodeSniffer_Sniff
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
		return [T_INTERFACE];
	}


	/**
	 * {@inheritdoc}
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$this->file = $file;
		$this->position = $position;

		$interfaceName = $this->getInterfaceName();
		if ((strlen($interfaceName) - strlen('Interface')) === strrpos($interfaceName, 'Interface')) {
			return;
		}

		$file->addError('Interface should have suffix "Interface".', $position);
	}


	/**
	 * @return string|FALSE
	 */
	private function getInterfaceName()
	{
		$namePosition = $this->file->findNext(T_STRING, $this->position);
		if ( ! $namePosition) {
			return FALSE;
		}

		return $this->file->getTokens()[$namePosition]['content'];
	}

}
