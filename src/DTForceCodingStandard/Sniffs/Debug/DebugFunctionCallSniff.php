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

namespace DTForceCodingStandard\Sniffs\Debug;

use Generic_Sniffs_PHP_ForbiddenFunctionsSniff;


/**
 * Rules:
 * - Debug functions should not be left in the code
 *
 * @author Mikulas Dite <mikulas@dite.pro>
 */
class DebugFunctionCallSniff extends Generic_Sniffs_PHP_ForbiddenFunctionsSniff
{

	/**
	 * A list of forbidden functions with their alternatives.
	 *
	 * The value is NULL if no alternative exists. IE, the
	 * function should just not be used.
	 *
	 * @var array(string => string|NULL)
	 */
	public $forbiddenFunctions = [
		'd' => NULL,
		'dd' => NULL,
		'dump' => NULL,
		'var_dump' => NULL
	];

}
