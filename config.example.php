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
	 * Set it to empty string '' if you don't want to display a title.
	 *
	 * @var string
	 */
	public static $title = 'WGGames Search Engine';

	/**
	 * @var bool
	 */
	public static $debug = true;

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
	public static $cacheParams = [
		'host' => null,
		'port' => null,
	];

	/**
	 * @var string
	 */
	public static $cssTheme = '';

	/**
	 * @var string
	 */
	public static $template = 'default';

	/**
	 * @var string[]
	 */
	public static $apiFields = [
		'wot' => [
			'accounts' => [
				'search' => [
					'account_id',
					'nickname',
				],
				'detail' => [
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
				],
			],
		],
		'wows' => [
			'accounts' => [
				'search' => [
					'account_id',
					'nickname',
				],
				'detail' => [
					'account_id',
					'hidden_profile',
					'created_at',
					'hidden_profile',
					'last_battle_time',
					'leveling_points',
					'leveling_tier',
					'nickname',
					'updated_at',
					'statistics',
				],
			],
		],
		'clans' => [
			'search' => [
				'clan_id',
				'color',
				'created_at',
				'members_count',
				'name',
				'tag',
			],
			'detail' => [
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
			],
		],
		'wiki' => [
			'tankinfo' => [
				'name',
				'nation',
				'tank_id',
				'type',
				'tier',
				'short_name',
				'images',
			],
			'shipinfo' => [
				'name',
				'nation',
				'ship_id',
				'ship_id_str',
				'type',
				'tier',
				'images',
			],
		],
		'ratings' => [
			'accounts' => [
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
				'xp_max',
			],
		],
	];

	/**
	 * @var string[]
	 */
	public static $menuItems = [
		0 => [
			'page' => 'accounts',
			'lang_constant' => 'ACCOUNTS',
		],
		1 => [
			'page' => 'clans',
			'lang_constant' => 'CLANS',
		],
		2 => [
			'page' => 'ratings',
			'lang_constant' => 'RATINGS',
			'hide' => 1,
		],
		3 => [
			'page' => 'clanratings',
			'lang_constant' => 'CLANRATINGS',
			'hide' => 1,
		],
		4 => [
			'page' => 'clans',
			'static_name' => 'Spitze Voraus',
			'static_key' => 'spvo',
			'params' => [
				'call' => 'detail',
				'sub' => 'detail',
				'game' => 'wows',
				'detail' => 500075945,
			],
		],
	];

	/**
	 * @var mixed[]
	 */
	public static $layouts = [
		'main.navigation' => [
			'hide' => false,
		],
		'accounts.filterarea' => [
			'hide' => false,
		],
		'clans.filterarea' => [
			'hide' => false,
		],
		'language_switcher' => [
			'hide' => false,
		]
	];
}
