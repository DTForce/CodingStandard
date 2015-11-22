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

namespace DTForce\CodingStandard\Composer;


final class ScriptHandler
{

	public static function addPhpCsToPreCommitHook()
	{
		$originFile = getcwd() . '/.git/hooks/pre-commit';
		$templateContent = file_get_contents(__DIR__ . '/templates/git/hooks/pre-commit-phpcs');
		if (file_exists($originFile)) {
			$originContent = file_get_contents($originFile);
			if (strpos($originContent, '# run phpcs') === FALSE) {
				$newContent = $originContent . PHP_EOL . PHP_EOL . $templateContent;
				file_put_contents($originFile, $newContent);
			}

		} else {
			file_put_contents($originFile, $templateContent);
		}
		chmod($originFile, 0755);
	}

}
