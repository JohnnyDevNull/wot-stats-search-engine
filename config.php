<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license GNU General Public License version 3 or later; see LICENSE.md
 */
abstract class jpWotConfig
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
				'nickname',
				'id',
				'account_id',
			),
			'detail' => array (
				'nickname',
				'account_id',
				'created_at',
				'updated_at',
				'global_rating',
				'client_language',
				'clan_id',
				'statistics.all',
				'statistics.max_xp',
			),
		),
		'clans' => array (
			'search' => array (
				'owner_name',
				'members_count',
				'name',
				'color',
				'abbreviation',
				'clan_id',
				'owner_id',
			),
			'detail' => array (
				'abbreviation',
				'clan_id',
				'color',
				'created_at',
				'description',
				'description_html',
				'is_clan_disbanded',
				'map_id',
				'members_count',
				'motto',
				'name',
				'owner_id',
				'request_availability',
				'updated_at',
				'victory_points',
				'victory_points_step_delta',
				'members',
			),
		),
		'wiki' => array (
			'tankinfo' => array (
				'name',
				'name_i18n',
				'nation',
				'nation_i18n',
				'tank_id',
				'type',
				'type_i18n',
				'contour_image',
				'image',
				'image_small',
				'level',
				'short_name_i18n',
			)
		),
	);

	/**
	 * @var bool
	 */
	public static $debug = true;
}
