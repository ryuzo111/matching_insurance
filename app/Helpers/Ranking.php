<?php
namespace App\Helpers;

class Ranking {

	public static function getRanking($collection) {
		$rank = 1;
		$count = 1;
		$before_point = 0;
		$ranking_array = [];
		foreach ($collection as $value) {
			if ($before_point != $value->goods_count) {
				$rank = $count;
			}
			$ranking_array[] = $rank;
			$before_point = $value['goods_count'];
			$count++;
		}

		$collection->map(function ($item, $key) use($ranking_array) {
			$item['rank'] = $ranking_array[$key];
			return $item;
		});
		return $collection;

	}
}
