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
 * Unit Test for Central Tendency
 */
class CentralTendencyTest extends \PHPUnit_Framework_TestCase {

	/**
	 * meanSampleValuesDataProvider
	 *
	 * @return array
	 */
	public function meanSampleValuesDataProvider() {
		return [
			'Zero value' => [
				[0],
				0
			],
			'Single value' => [
				[2],
				2
			],
			'Negative integer' => [
				[1, -2, -2],
				-1
			],
			'Positive integer' => [
				[1, 2, 3],
				2
			],
			'Float' => [
				[0, 0.5, 0.5],
				0.33
			],
			'PI' => [
				[pi()],
				3.14
			],
		];
	}

	/**
	 * @test
	 * @dataProvider meanSampleValuesDataProvider
	 */
	public function meanCalculatesMeanForGivenValues(array $values, $expectedResult) {
		$subject = new CentralTendency();
		$result = $subject->mean($values);

		$this->assertEquals($expectedResult, $result, '', 0.01);
	}

	/**
	 * @test
	 * @expectedException \Stmllr\DescriptiveStatistics\Exception\DivisionByZeroException
	 */
	public function meanThrowsDivisionByZeroExceptionForEmptyValue() {
		$subject = new CentralTendency();
		$subject->mean(array());
	}

	/**
	 * medianSampleValuesDataProvider
	 *
	 * @return array
	 */
	public function medianSampleValuesDataProvider() {
		return [
			'Zero value' => [
				[0],
				0
			],
			'Single value' => [
				[2],
				2
			],
			'Negative integer' => [
				[1, -2, -2],
				-2
			],
			'odd number of values' => [
				[1, 2, 4, 4, 4, 5, 15],
				4
			],
			'even number of values' => [
				[1, 2, 4, 6, 9, 15],
				5
			],
			'Float' => [
				[0, 0.33, 0.33],
				0.33
			],
		];
	}

	/**
	 * @test
	 * @dataProvider medianSampleValuesDataProvider
	 */
	public function medianCalculatesMedianForGivenValues(array $values, $expectedResult) {
		$subject = new CentralTendency();
		$result = $subject->median($values);

		$this->assertEquals($expectedResult, $result, '', 0.01);
	}

	/**
	 * @test
	 * @expectedException \Stmllr\DescriptiveStatistics\Exception\DivisionByZeroException
	 */
	public function medianThrowsDivisionByZeroExceptionForEmptyValue() {
		$subject = new CentralTendency();
		$subject->median(array());
	}
}
