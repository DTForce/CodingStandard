<?php

namespace DTForce\CodingStandard\Tests\Sniffs\Naming\InheritDoc;

use DTForce\CodingStandard\Tests\CodeSnifferRunner;
use PHPUnit_Framework_TestCase;


/**
 * @covers DTForceCodingStandard\Sniffs\Naming\InheritDocSniff
 */
final class InheritDocSniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('DTForceCodingStandard.Naming.InheritDoc');

		$this->assertSame(4, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
