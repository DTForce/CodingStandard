<?php

namespace DTForce\CodingStandard\Tests\Sniffs\WhiteSpace\OperatorSpacing;

use DTForce\CodingStandard\Tests\CodeSnifferRunner;
use PHPUnit_Framework_TestCase;


/**
 * @covers DTForceCodingStandard\Sniffs\WhiteSpace\OperatorSpacingSniff
 */
final class OperatorSpacingSniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('DTForceCodingStandard.WhiteSpace.OperatorSpacing');

		$this->assertSame(3, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
