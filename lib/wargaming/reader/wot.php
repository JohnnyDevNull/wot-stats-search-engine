<?php
/**
 * "World of Tanks" api reader class.
 *
 * @see https://eu.wargaming.net/developers/api_reference/
 *
 * @package jpWargamingApiReader
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2016, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWargamingReaderWot extends jpWargamingBase
{
	/**
	 * Request /wot/account/list/<br><br>Method returns partial list of players.
	 * The list is filtered by initial characters of user name and sorted
	 * alphabetically.
	 *
	 * @param string $search <p>Player name search string. Parameter 'type'
	 * defines minimum length and type of search. Maximum length: 24 symbols.</p>
	 * @param string|string[] $fields <p>Response field. The fields are separated
	 * with commas. Embedded fields are separated with dots.<br>To exclude a
	 * field, use “-” in front of its name. In case the parameter is not defined,
	 * the ethod returns all fields.<p>
	 * @param string $type [optional] <p>Search type. Defines minimum length and
	 * type of search. Default value: startswith.<br> Valid values:<br>
	 * "startswith" - Search by initial characters of player name. Minimum
	 * length: 3 characters. Case insensitive. (by default)<br> "exact" - Search
	 * by exact match of player name. Minimum length: 1 character. Case
	 * insensitive.</p>
	 * @param int $limit [optional] Number of returned entries (fewer can be
	 * returned, but not more than 100). If the limit sent exceeds 100, an limit
	 * of 100 is applied (by default).
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/account/list/
	 */
	public function getAccountList($search, $fields = '', $type = '', $limit = 100)
	{
		return $this->request->perform('/wot/account/list/', [
			'search' => $search,
			'fields' => $this->toListString($fields),
			'type' => $type,
			'limit' => $limit,
		]);
	}

	/**
	 * Request /wot/account/info/<br><br>Method returns player details.
	 *
	 * @param int|int[] $accountId Player account ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots. <br>
	 * To exclude a field, use “-” in front of its name. In case the parameter
	 * is not defined, the method returns all fields.
	 * @param string $accessToken [optional] Access token is used to access
	 * personal user data.<br>The token is obtained via authentication and has
	 * expiration time.
	 * @param string|string[] $extra [optional] Extra fields to be included into
	 * the response.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/account/info/
	 */
	public function getAccountInfo($accountId, $fields = '', $accessToken = '',
		$extra = ''
	) {
		return $this->request->perform('/wot/account/info/', [
			'account_id' => $this->toListString($accountId),
			'fields' => $this->toListString($fields),
			'access_token' => $accessToken,
			'extra' => $this->toListString($extra),
		]);
	}

	/**
	 * Request /wot/account/tanks/<br><br>Method returns details on player's
	 * vehicles.
	 *
	 * @param int|int[] $accountId Player account ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $accessToken [optional] Access token is used to access
	 * personal user data.<br>The token is obtained via authentication and has
	 * expiration time.
	 * @param int|int[] $tankId Player's vehicle ID
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/account/tanks/
	 */
	public function getAccountVehicles($accountId, $fields = '',
		$accessToken = '', $tankId = 0
	) {
		return $this->request->perform('/wot/account/tanks/', [
			'account_id' => $this->toListString($accountId),
			'fields' => $this->toListString($fields),
			'access_token' => $accessToken,
			'tank_id' => $this->toListString($tankId),
		]);
	}

	/**
	 * Request /wot/account/achievements/<br><br>Method returns players'
	 * achievement details.
	 *
	 * Achievement properties define the achievements field values:
	 * <ul><li>1-4 for Mastery Badges and Stage Achievements (type: "class");</li>
	 * <li>maximum value of Achievement series (type: "series");</li>
	 * <li>number of achievements earned from sections:<br>Battle Hero, Epic
	 * Achievements, Group Achievements, Special Achievements, etc.<br>(type:
	 * "repeatable, single, custom").</li>
	 *
	 * @param string $accountId
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/account/achievements/
	 */
	public function getAccountAchievments($accountId, $fields = '')
	{
		return $this->request->perform('/wot/account/achievements/', [
			'account_id' => $this->toListString($accountId),
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wot/stronghold/info/<br><br>Method returns information on clan's
	 * Stronghold.
	 *
	 * @param int|int[] $clanId Clan ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $accessToken [optional] Access token is used to access
	 * personal user data.<br>The token is obtained via authentication and
	 * has expiration time.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/stronghold/info/
	 */
	public function getStrongholdInfo($clanId, $fields = '', $accessToken = '')
	{
		return $this->request->perform('/wot/stronghold/info/', [
			'clan_id' => $this->toListString($clanId),
			'fields' => $this->toListString($fields),
			'access_token' => $this->toListString($accessToken),
		]);
	}

	/**
	 * Request /wot/stronghold/buildings/<br><br>Method returns encyclopedia
	 * information on all structures of the Stronghold.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are separated
	 * with commas. Embedded fields are separated with dots.<br>To exclude a
	 * field, use “-” in front of its name. In case the parameter is not defined,
	 * the method returns all fields.
	 *
	 * @return mixed
	 * @seehttps://eu.wargaming.net/developers/api_reference/wot/stronghold/buildings/
	 */
	public function getStrongholdStructure($fields = '')
	{
		return $this->request->perform('/wot/stronghold/buildings/', [
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wot/stronghold/accountstats/<br><br>Method returns player stats
	 * for the current clan's Stronghold.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $accessToken [optional] Access token is used to access
	 * personal user data.<br>The token is obtained via authentication and
	 * has expiration time.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/stronghold/accountstats/
	 */
	public function getStrongholdAccountstats($fields = '', $accessToken = '')
	{
		return $this->request->perform('/wot/stronghold/accountstats/', [
			'fields' => $this->toListString($fields),
			'access_token' => $accessToken,
		]);
	}

	/**
	 * Request /wot/stronghold/plannedbattles/<br><br>Method returns information
	 * on Clan's Battles for Stronghold. Only battles planned in 2 weeks range
	 * from the current date are returned in response.
	 *
	 * @param int|int[] $clanId Clan ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/stronghold/plannedbattles/
	 */
	public function getStrongholdPlannedbattles($clanId, $fields = '')
	{
		return $this->request->perform('/wot/stronghold/accountstats/', [
			'clan_id' => $this->toListString($clanId),
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wot/encyclopedia/vehicles/<br><br> Method returns list of
	 * available vehicles.
	 *
	 * @param int|int[] $tankId [optional] Vehicle ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string|string[] $nation [optional] Nation
	 * @param string $type [optional] Vehicle type. Valid values:
	 * <ul><li>"heavyTank" — Heavy Tank</li>
	 * <li>"AT-SPG" — Tank Destroyer</li>
	 * <li>"mediumTank" — Medium Tank</li>
	 * <li>"lightTank" — Light Tank</li>
	 * <li>"SPG" — SPG</li></ul>
	 * @param int|int[] $tier [optional] Tier
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/encyclopedia/vehicles/
	 */
	public function getEncyclopediaVehicles($tankId = 0, $fields = '',
		$nation = '', $type = '', $tier = 0
	) {
		return $this->request->perform('/wot/encyclopedia/vehicles/', [
			'tank_id' => $this->toListString($tankId),
			'fields' => $this->toListString($fields),
			'nation' => $this->toListString($nation),
			'type' => $type,
			'tier' => $this->toListString($tier),
		]);
	}

	/**
	 * Request /wot/encyclopedia/vehicleprofile/<br><br>Method returns vehicle
	 * configuration characteristics based on the specified module IDs.
	 *
	 * @param int $tankId [optional] Vehicle ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param int $engineId [optional] Engine ID. If module is not specified,
	 * standard module is used by default.
	 * @param int $gunId [optional] Gun ID. If module is not specified, standard
	 * module is used by default.
	 * @param int $suspensionId [optional] Suspension ID. If module is not
	 * specified, standard module is used by default.
	 * @param int $turretId [optional] Turret ID. If module is not specified,
	 * standard module is used by default.
	 * @param int $radioId [optional] Radio ID. If module is not specified,
	 * standard module is used by default.
	 * @param string $profileId [optional] Configuration ID. If specified,
	 * parameters of IDs of separate modules are ignored.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/encyclopedia/vehicleprofile/
	 */
	public function getEncyclopediaVehicleprofile($tankId, $fields = '',
		$engineId = 0, $gunId = 0, $suspensionId = 0, $turretId = 0,
		$radioId = 0, $profileId = ''
	) {
		return $this->request->perform('/wot/encyclopedia/vehicleprofile/', [
			'tank_id' => $this->toListString($tankId),
			'fields' => $this->toListString($fields),
			'engine_id' => (int)$engineId,
			'gun_id' => (int)$gunId,
			'suspension_id' => (int)$suspensionId,
			'turret_id' => (int)$turretId,
			'radio_id' => (int)$radioId,
			'profile_id' => $profileId,
		]);
	}

	/**
	 * Request /wot/encyclopedia/vehicleprofiles/<br><br>Method returns vehicle
	 * configuration characteristics.
	 *
	 * @param int $tankId Vehicle ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $orderBy Sorting. Valid values:
	 * <ul><li>"price_credit" — by cost in credits</li>
	 * <li>"-price_credit" — by cost in credits, in reverse order</li></ul>
	 *
	 * @return mixed
	 * @see http://eu.wargaming.net/developers/api_reference/wot/encyclopedia/vehicleprofiles/
	 */
	public function getEncyclopediaVehicleprofiles($tankId, $fields = '',
		$orderBy = ''
	) {
		return $this->request->perform('/wot/encyclopedia/vehicleprofiles/', [
			'tank_id' => $this->toListString($tankId),
			'fields' => $this->toListString($fields),
			'order_by' => $orderBy,
		]);
	}

	/**
	 * Request /wot/encyclopedia/achievements/
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see http://eu.wargaming.net/developers/api_reference/wot/encyclopedia/achievements/
	 */
	public function getEncyclopediaAchievements($fields)
	{
		return $this->request->perform('/wot/encyclopedia/achievements/', [
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wot/encyclopedia/info/<br><br>Method returns information about
	 * Tankopedia.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see http://eu.wargaming.net/developers/api_reference/wot/encyclopedia/info/
	 */
	public function getEncyclopediaInfo($fields)
	{
		return $this->request->perform('/wot/encyclopedia/info/', [
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wot/encyclopedia/arenas/<br><br>Method returns information about
	 * maps.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see http://eu.wargaming.net/developers/api_reference/wot/encyclopedia/arenas/
	 */
	public function getEncyclopediaArenas($fields)
	{
		return $this->request->perform('/wot/encyclopedia/arenas/', [
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wot/encyclopedia/provisions/<br><br>Method returns a list of
	 * available equipment and consumables.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $type Type. Valid values:
	 * <ul><li>"equipment" — Consumables</li>
	 * <li>"optionalDevice" — Equipment</li></ul>
	 * @param int|int[] $provisionId
	 *
	 * @return mixed
	 * @see http://eu.wargaming.net/developers/api_reference/wot/encyclopedia/provisions/
	 */
	public function getEncyclopediaProvisions($fields, $type = '',
		$provisionId = 0
	) {
		return $this->request->perform('/wot/encyclopedia/arenas/', [
			'fields' => $this->toListString($fields),
			'type' => $type,
			'provisionId' => $this->toListString($provisionId),
		]);
	}

	/**
	 * Request /wot/encyclopedia/personalmissions/<br><br>Method returns details
	 * on Personal Missions on the basis of specified campaign IDs, operation
	 * IDs, mission branch and tag IDs.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param int|int[] $campaignId [optional]
	 * @param int|int[] $operationId [optional]
	 * @param int|int[] $setId [optional]
	 * @param string|string[] $tag [optional]
	 *
	 * @return mixed
	 * @see http://eu.wargaming.net/developers/api_reference/wot/encyclopedia/personalmissions/
	 */
	public function getEncyclopediaPersonalmissions($fields = '',
		$campaignId = 0, $operationId = 0, $setId = 0, $tag = ''
	) {
		return $this->request->perform('/wot/encyclopedia/personalmissions/', [
			'fields' => $this->toListString($fields),
			'campaign_id' => $campaignId,
			'operation_id' => $operationId,
			'set_id' => $setId,
			'tag' => $tag,
		]);
	}

	/**
	 * Request /wot/encyclopedia/boosters<br><br>Method returns information
	 * about Personal Reserves
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see http://eu.wargaming.net/developers/api_reference/wot/encyclopedia/boosters/
	 */
	public function getEncyclopediaBoosters($fields = '')
	{
		return $this->request->perform('/wot/encyclopedia/boosters/', [
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wot/encyclopedia/modules/<br><br>Method returns the list of
	 * available modules that can be installed on vehicles, such as engines,
	 * turrets, etc.<br>At least one input filter parameter (module ID, type) is
	 * required to be indicated.
	 *
	 * @param string $type Module type. Valid values:
	 * <ul><li>"vehicleRadio" — Radio</li>
	 * <li>"vehicleEngine" — Engines "vehicleGun" — Gun</li>
	 * <li>"vehicleChassis" — Suspension</li>
	 * <li>"vehicleTurret" — Turret</li></ul>
	 * @param string $nation Nation
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string|string[] $extra [optional] Extra fields to be included into the
	 * response. Valid values: default_profile
	 * @param int|int[] Module ID. Max limit is 100
	 *
	 * @return mixed
	 * @see http://eu.wargaming.net/developers/api_reference/wot/encyclopedia/modules/
	 */
	public function getEncyclopediaModules($type, $nation, $fields = '',
		$extra = '', $moduleId = 0
	) {
		return $this->request->perform('/wot/encyclopedia/modules/', [
			'type' => $type,
			'nation' => $nation,
			'fields' => $this->toListString($fields),
			'extra' => $this->toListString($extra),
			'module_id' => $moduleId,
		]);
	}

	/**
	 * Request /wot/ratings/types/<br><br>Method returns dictionary of rating
	 * periods and ratings details.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $battleType [optional] Battle types. Valid values:
	 * <ul><li>"company" — Tank Company Battles</li>
	 * <li>"random" — Random Battles</li>
	 * <li>"team" — Team Battles</li>
	 * <li>"default" — any battle type (by default)</li></ul>
	 *
	 * @return mixed
	 * @see http://eu.wargaming.net/developers/api_reference/wot/ratings/types/
	 */
	public function getRatingsTypes($fields = '', $battleType = '')
	{
		return $this->request->perform('/wot/ratings/types/', [
			'fields' => $this->toListString($fields),
			'extra' => $battleType,
		]);
	}

	/**
	 * Request /wot/ratings/dates/<br><br>Method returns dates with available
	 * rating data.
	 *
	 * @param string $type Rating period
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $battleType [optional] Battle types. Valid values:
	 * <ul><li>"company" — Tank Company Battles</li>
	 * <li>"random" — Random Battles</li>
	 * <li>"team" — Team Battles</li>
	 * <li>"default" — any battle type (by default)</li></ul>
	 * @param int|int[] $accountId Player account ID
	 *
	 * @return mixed
	 * @see http://eu.wargaming.net/developers/api_reference/wot/ratings/dates/
	 */
	public function getRatingsDates($type, $fields = '', $battleType = '',
		$accountId = 0
	) {
		return $this->request->perform('/wot/ratings/dates/', [
			'type' => $type,
			'fields' => $this->toListString($fields),
			'battle_type' => $battleType,
			'account_id' => $accountId,
		]);
	}

	/**
	 * Request /wot/ratings/accounts/<br><br>Method returns player ratings by
	 * specified IDs.
	 *
	 * @param string $type
	 * @param int|int[] $accountId
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $battleType Battle types. Valid values:
	 * <ul><li>"company" — Tank Company Battles</li>
	 * <li>"random" — Random Battles</li>
	 * <li>"team" — Team Battles</li>
	 * <li>"default" — any battle type (by default)</li></ul>
	 * @param int|string $date [optional] Ratings calculation date. Up to 7 days
	 * before the current date; default value: yesterday.<br>Date in UNIX
	 * timestamp or ISO 8601 format. E.g.: 1376542800 or 2013-08-15T00:00:00
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/ratings/accounts/
	 */
	public function getRatingsAccounts($type, $accountId, $fields = '',
		$battleType = '', $date = 0
	) {
		return $this->request->perform('/wot/ratings/accounts/', [
			'type' => $type,
			'account_id' => $accountId,
			'fields' => $this->toListString($fields),
			'battle_type' => $battleType,
			'date' => $date,
		]);
	}

	/**
	 * Request /wot/ratings/neighbors/<br><br>Method returns list of adjacent
	 * positions in specified rating.
	 *
	 * @param string $type
	 * @param int $accoutnId
	 * @param string $rankField
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $battleType Battle types. Valid values:
	 * <ul><li>"company" — Tank Company Battles</li>
	 * <li>"random" — Random Battles</li>
	 * <li>"team" — Team Battles</li>
	 * <li>"default" — any battle type (by default)</li></ul>
	 * @param int|string $date [optional] Ratings calculation date. Up to 7 days
	 * before the current date; default value: yesterday.<br>Date in UNIX
	 * timestamp or ISO 8601 format. E.g.: 1376542800 or 2013-08-15T00:00:00
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/ratings/neighbors/
	 */
	public function getRatingsNeighbors($type, $accoutnId, $rankField,
		$fields = '', $battleType = '', $date = 0
	) {
		return $this->request->perform('/wot/ratings/neighbors/', [
			'type' => $type,
			'account_id' => $accoutnId,
			'rank_field' => $rankField,
			'fields' => $this->toListString($fields),
			'battle_type' => $battleType,
			'date' => $date,
		]);
	}

	/**
	 * Request /wot/ratings/top/<br><br>Method returns the list of top players
	 * by specified parameter.
	 *
	 * @param string $type
	 * @param string $rankField
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $battleType Battle types. Valid values:
	 * <ul><li>"company" — Tank Company Battles</li>
	 * <li>"random" — Random Battles</li>
	 * <li>"team" — Team Battles</li>
	 * <li>"default" — any battle type (by default)</li></ul>
	 * @param int|string $date [optional] Ratings calculation date. Up to 7 days
	 * before the current date; default value: yesterday.<br>Date in UNIX
	 * timestamp or ISO 8601 format. E.g.: 1376542800 or 2013-08-15T00:00:00
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wot/ratings/top/
	 */
	public function getRatingsTop($type, $rankField, $fields = '',
		$battleType = '', $date = 0
	) {
		return $this->request->perform('/wot/ratings/neighbors/', [
			'type' => $type,
			'rank_field' => $rankField,
			'fields' => $this->toListString($fields),
			'battle_type' => $battleType,
			'date' => $date,
		]);
	}
}
