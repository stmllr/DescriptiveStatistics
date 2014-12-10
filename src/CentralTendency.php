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
 * Central Tendency
 */
class CentralTendency {

	/**
	 * Calculates the mean for the given values
	 *
	 * @param array $values
	 * @return float
	 */
	public function mean(array $values) {
		if (empty($values)) {
			throw new DivisionByZeroException ('Requires a minimum of one value, but zero values given.');
		}

		return array_sum($values) / count($values);
	}

	/**
	 * Calculates the median for the given values
	 *
	 * @param array $values
	 * @return float
	 */
	public function median(array $values) {
		if (empty($values)) {
			throw new DivisionByZeroException ('Requires a minimum of one value, but zero values given.');
		}

		natsort($values);
		$count = count($values);
		if ($count % 2 === 0) {
			// even
			return ($values[$count / 2 - 1] + $values[$count / 2]) / 2;
			//return array_sum(array_slice($values, $count / 2 - 1, 2)) / 2;
		} else {
			// odd
			return $values[$count / 2];
		}
	}
}
