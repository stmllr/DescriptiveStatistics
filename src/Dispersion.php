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
use Stmllr\DescriptiveStatistics\Exception\DivisionByZeroException;

/**
 * Dispersion
 */
class Dispersion {

	/**
	 * @var \Stmllr\DescriptiveStatistics\CentralTendency
	 */
	protected $centralTendency = NULL;


	public function __construct(CentralTendency $centralTendency) {
		$this->centralTendency = $centralTendency;
	}

	/**
	 * variance
	 *
	 * @param array $values
	 * @return float
	 */
	public function variance(array $values) {
		$count = count($values);
		if ($count < 2) throw new DivisionByZeroException('Requires a minimum of two items, but ' . $count . ' items given.');

		$mean = $this->centralTendency->mean($values);
		$sumOfSquares = 0;
		for ($i = 0; $i < $count; $i++) {
			$sumOfSquares += pow($values[$i] - $mean, 2);
		}

		return $sumOfSquares / $count;
	}

	/**
	 * standardDeviation
	 *
	 * @param array $values
	 * @return float
	 */
	public function standardDeviation(array $values) {
		$count = count($values);
		if ($count < 2) throw new DivisionByZeroException('Requires a minimum of two items, but ' . $count . ' items given.');

		return sqrt($this->variance($values));
	}
}

