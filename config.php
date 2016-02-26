<?php
/**
 * @package jpWot
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2014, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
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
				'members_count',
				'name',
				'color',
				'clan_id',
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
	public static $debug = false;
}
