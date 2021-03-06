<?php

namespace DTForce\CodingStandard\Tests;

use DTForce\CodingStandard\Tests\Exception\FileNotFoundException;
use DTForce\CodingStandard\Tests\Exception\StandardRulesetNotFoundException;
use PHP_CodeSniffer;


final class CodeSnifferRunner
{

	/**
	 * @var PHP_CodeSniffer
	 */
	private $codeSniffer;

	/**
	 * @var string[]
	 */
	private $standardRulesets = [
		'DTForceCodingStandard' => __DIR__ . '/../src/DTForceCodingStandard/ruleset.xml'
	];


	/**
	 * @param string $sniff
	 */
	public function __construct($sniff)
	{
		$ruleset = $this->detectRulesetFromSniffName($sniff);

		$this->codeSniffer = new PHP_CodeSniffer;
		$this->codeSniffer->initStandard($ruleset, [$sniff]);
	}


	/**
	 * @param string $source
	 * @return int
	 */
	public function getErrorCountInFile($source)
	{
		$this->ensureFileExists($source);

		$file = $this->codeSniffer->processFile($source);
		return $file->getErrorCount();
	}


	/**
	 * @param string $name
	 * @return string
	 */
	public function detectRulesetFromSniffName($name)
	{
		$standard = $this->detectStandardFromSniffName($name);

		if (isset($this->standardRulesets[$standard])) {
			return $this->standardRulesets[$standard];
		}

		throw new StandardRulesetNotFoundException(
			sprintf('Ruleset for standard "%s" not found.', $standard)
		);
	}


	/**
	 * @param string $source
	 */
	private function ensureFileExists($source)
	{
		if ( ! file_exists($source)) {
			throw new FileNotFoundException(
				sprintf('File "%s" was not found.', $source)
			);
		}
	}


	/**
	 * @param string $sniff
	 * @return string
	 */
	private function detectStandardFromSniffName($sniff)
	{
		$parts = explode('.', $sniff);
		if (isset($parts[0])) {
			return $parts[0];
		}

		return NULL;
	}

}
