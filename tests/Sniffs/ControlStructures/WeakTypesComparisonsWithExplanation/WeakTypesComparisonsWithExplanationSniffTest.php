<?php

namespace DTForce\CodingStandard\Tests\Sniffs\ControlStructures\WeakTypesComparisonsWithExplanation;

use DTForce\CodingStandard\Tests\CodeSnifferRunner;
use PHPUnit_Framework_TestCase;


/**
 * @covers DTForceCodingStandard\Sniffs\ControlStructures\WeakTypesComparisonsWithExplanationSniff
 */
final class WeakTypesComparisonsWithExplanationSniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner(
				'DTForceCodingStandard.ControlStructures.WeakTypesComparisonsWithExplanation'
		);
		$this->assertSame(2, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
