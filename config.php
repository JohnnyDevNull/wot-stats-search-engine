<?php
/**
 * @package jpWse
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
abstract class jpWseConfig
{
	/**
	 * @var string
	 */
	public static $region = 'EU';

	/**
	 * @var string
	 */
	public static $lang = 'en';

	/**
	 * @var string
	 */
	public static $app_id = '03e3653b14d26e8136d5870a1512e3c4';

	/**
	 * Possible Keys: 'wot' or 'wows'
	 *
	 * @var string
	 */
	public static $game = 'wot';

	/**
	 * @var string
	 */
	public static $cache = null;

	/**
	 * @var array
	 */
	public static $cacheParams = array (
		'host' => null,
		'port' => null
	);

	public static $wotApiFields = array (
		'accounts' => array (
			'search' => array (
				'account_id',
				'nickname',
			),
			'detail' => array (
				'account_id',
				'clan_id',
				'created_at',
				'global_rating',
				'last_battle_time',
				'nickname',
				'updated_at',
				'statistics.frags',
				'statistics.trees_cut',
				'client_language',
				'statistics.all',
			),
		),
		'clans' => array (
			'search' => array (
				'clan_id',
				'color',
				'created_at',
				'members_count',
				'name',
				'tag',
			),
			'detail' => array (
				'tag',
				'clan_id',
				'color',
				'created_at',
				'description',
				'description_html',
				'is_clan_disbanded',
				'members_count',
				'motto',
				'name',
				'creator_id',
				'creator_name',
				'updated_at',
				'members',
			),
		),
		'wiki' => array (
			'tankinfo' => array (
				'name',
				'nation',
				'tank_id',
				'type',
				'tier',
				'short_name',
				'images',
			),
		),
		'ratings' => array (
			'accounts' => array (
				'account_id',
				'battles_to_play',
				'battles_count',
				'capture_points',
				'damage_avg',
				'damage_dealt',
				'frags_avg',
				'frags_count',
				'global_rating',
				'hits_ratio',
				'spotted_avg',
				'spotted_count',
				'survived_ratio',
				'wins_ratio',
				'xp_amount',
				'xp_avg',
				'xp_max'
			),
		)
	);

	/**
	 * @var bool
	 */
	public static $debug = false;
}
