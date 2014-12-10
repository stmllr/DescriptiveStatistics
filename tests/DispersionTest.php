<?php
namespace Stmllr\DescriptiveStatistics;

/**
 * This file is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 3
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 *
 */
use Stmllr\DescriptiveStatistics\CentralTendency;

/**
 * Unit Test for Dispersion
 */
class DispersionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * dispersionSampleValuesDataProvider
	 *
	 * @return array
	 */
	public function dispersionSampleValuesDataProvider() {
		return [
			'Negative integer' => [
				[1, -2, -2], // values
				-1, // mean
				2, // variance
				1.414 // standard derivation
			],
			'Positive integer' => [
				[1, 2, 3],
				2,
				0.667,
				0.816
			],
			'Float' => [
				[0, 0.5, 0.5],
				0.33,
				0.055,
				0.235
			],
			'strong dispersion' => [
				[1, 1, 1, 1, 5, 5, 5, 5],
				3,
				4,
				2
			],
			'very strong dispersion' => [
				[1, 2, 1, 2, 1, 2, 1, 70],
				10,
				514.5,
				22.682
			],
			'weak dispersion' => [
				[2, 3, 3, 3, 3, 3, 3, 4],
				3,
				0.25,
				0.5
			],
		];
	}

	/**
	 * @test
	 * @dataProvider dispersionSampleValuesDataProvider
	 */
	public function varianceCalculatesVarianceForGivenValues(array $values, $mean, $expectedResult) {
		$centralTendency = $this->getMock(CentralTendency::class, array('mean'));
		$centralTendency->expects($this->any())->method('mean')->willReturn($mean);

		$subject = new Dispersion($centralTendency);
		$result = $subject->variance($values);

		$this->assertEquals($expectedResult, $result, '', 0.001);

	}

	/**
	 * @test
	 * @expectedException \Stmllr\DescriptiveStatistics\Exception\DivisionByZeroException
	 */
	public function varianceThrowsDivisionByZeroExceptionForLessThanTwoValues() {
		$centralTendency = $this->getMock(CentralTendency::class, array('mean'));
		$centralTendency->expects($this->any())->method('mean')->willReturn(42);

		$subject = new Dispersion($centralTendency);
		$subject->variance(array(42));
	}

	/**
	 * @test
	 * @dataProvider dispersionSampleValuesDataProvider
	 */
	public function standardDeviationCalculatesStandardDeviationForGivenValues(array $values, $mean, $variance, $expectedResult) {
		$centralTendency = $this->getMock(CentralTendency::class, array('mean'));
		$centralTendency->expects($this->any())->method('mean')->willReturn($mean);

		$subject = new Dispersion($centralTendency);
		$result = $subject->standardDeviation($values);

		$this->assertEquals($expectedResult, $result, '', 0.001);
	}

	/**
	 * @test
	 * @expectedException \Stmllr\DescriptiveStatistics\Exception\DivisionByZeroException
	 */
	public function standardDeviationThrowsDivisionByZeroExceptionForLessThanTwoValues() {
		$centralTendency = $this->getMock(CentralTendency::class, array('mean'));
		$centralTendency->expects($this->any())->method('mean')->willReturn(42);

		$subject = new Dispersion($centralTendency);
		$subject->standardDeviation(array(42));
	}

}
