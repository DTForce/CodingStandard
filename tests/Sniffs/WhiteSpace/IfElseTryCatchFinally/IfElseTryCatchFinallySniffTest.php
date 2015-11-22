<?php

namespace DTForce\CodingStandard\Tests\Sniffs\WhiteSpace\IfElseTryCatchFinally;

use DTForce\CodingStandard\Tests\CodeSnifferRunner;
use PHPUnit_Framework_TestCase;


/**
 * @covers DTForceCodingStandard\Sniffs\WhiteSpace\IfElseTryCatchFinallySniff
 */
final class IfElseTryCatchFinallySniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('DTForceCodingStandard.WhiteSpace.IfElseTryCatchFinally');

		$this->assertSame(3, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
