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


/**
 * Rules:
 * - Integer operator should be spelled 'int'
 */
class IntSniff extends AbstractNamingSniffer
{

	/**
	 * {@inheritdoc}
	 */
	protected function getPossibleForms()
	{
		return ['int', 'integer'];
	}


	/**
	 * {@inheritdoc}
	 */
	protected function getAllowedForm()
	{
		return 'int';
	}


	/**
	 * {@inheritdoc}
	 */
	protected function getErrorMessage()
	{
		return 'Integer operator should be spelled "%s"; "%s" found';
	}

}
