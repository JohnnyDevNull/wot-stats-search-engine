<?php
/**
 * "World of Warships" api reader class.
 *
 * @see https://eu.wargaming.net/developers/api_reference/
 *
 * @package jp-wargaming-api-reader
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2016, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWargamingReaderWows extends jpWargamingBase
{
	/**
	 * @var string
	 */
	protected $api = 'worldofwarships';

	/**
	 * Request /wows/account/list/<br><br>Method returns partial list of players.
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
	 * @see https://eu.wargaming.net/developers/api_reference/wows/account/list/
	 */
	public function getAccountList($search, $fields = '', $type = '', $limit = 100)
	{
		return $this->request->perform('/wows/account/list/', [
			'search' => $search,
			'fields' => $this->toListString($fields),
			'type' => $type,
			'limit' => $limit,
		]);
	}

	/**
	 * Request /wows/account/info/<br><br>Method returns player details.
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
	 * @see https://eu.wargaming.net/developers/api_reference/wows/account/info/
	 */
	public function getAccountInfo($accountId, $fields = '', $accessToken = '',
		$extra = ''
	) {
		return $this->request->perform('/wows/account/info/', [
			'account_id' => $this->toListString($accountId),
			'fields' => $this->toListString($fields),
			'access_token' => $accessToken,
			'extra' => $this->toListString($extra),
		]);
	}

	/**
	 * Request /wows/account/achievements/<br><br>Method returns information
	 * about players' achievements. Accounts with hidden game profiles are
	 * excluded from response. Hidden profiles are listed in the field
	 * meta.hidden.
	 *
	 * @param string $accountId
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/account/achievements/
	 */
	public function getAccountAchievments($accountId, $fields = '')
	{
		return $this->request->perform('/wows/account/achievements/', [
			'account_id' => $this->toListString($accountId),
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wows/encyclopedia/info/<br><br>Method returns information about
	 * encyclopedia.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/info/
	 */
	public function getEncyclopediaInfo($fields)
	{
		return $this->request->perform('/wows/encyclopedia/info/', [
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wot/encyclopedia/ships/<br><br> Method returns the list of ships
	 * available.
	 *
	 * @param int|int[] $shipId [optional] Ship ID
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
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/ships/
	 */
	public function getEncyclopediaVehicles($shipId = 0, $fields = '',
		$nation = '', $type = ''
	) {
		return $this->request->perform('/wot/encyclopedia/ships/', [
			'ship_id' => $this->toListString($shipId),
			'fields' => $this->toListString($fields),
			'nation' => $this->toListString($nation),
			'type' => $type,
		]);
	}

	/**
	 * Request /wows/encyclopedia/achievements/<br><br>Method returns
	 * information about achievements.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/achievements/
	 */
	public function getEncyclopediaAchievements($fields)
	{
		return $this->request->perform('/wows/encyclopedia/achievements/', [
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wot/encyclopedia/shipprofile/<br><br> Method returns parameters
	 * of ships in all existing configurations.
	 *
	 * @param int $shipId Ship ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param int $artilleryId Main Battery ID. If the module is not indicated,
	 * module of basic configuration is used.
	 * @param int $torpedosId Torpedo tubes' ID. If the module is not indicated,
	 * module of basic configuration is used.
	 * @param int $fireControlId ID of Gun Fire Control System. If the module is
	 * not indicated, module of basic configuration is used.
	 * @param int $flightControlId ID of Flight Control System. If the module is
	 * not indicated, module of basic configuration is used.
	 * @param int $hullId Hull ID. If the module is not indicated, module of
	 * basic configuration is used.
	 * @param int $endingeId Engine ID. If the module is not indicated, module
	 * of basic configuration is used.
	 * @param int $fighterId Fighters' ID. If the module is not indicated,
	 * module of basic configuration is used.
	 * @param int $diveBomberId Dive bombers' ID. If the module is not
	 * indicated, module of basic configuration is used.
	 * @param int $torpedoBomberId Torpedo bombers' ID. If the module is not
	 * indicated, module of basic configuration is used.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/shipprofile/
	 */
	public function getEncyclopediaShipprofile($shipId, $fields = '',
		$artilleryId = 0, $torpedosId = 0, $fireControlId = 0,
		$flightControlId = 0, $hullId = 0, $endingeId = 0, $fighterId = 0,
		$diveBomberId = 0, $torpedoBomberId = 0
	) {
		return $this->request->perform('/wot/encyclopedia/shipprofile/', [
			'ship_id' => $shipId,
			'fields' => $this->toListString($fields),
			'artillery_id' => $artilleryId,
			'torpedo_id' => $torpedosId,
			'fire_control_id' => $fireControlId,
			'flight_control_id' => $flightControlId,
			'hull_id' => $hullId,
			'engine_id' => $endingeId,
			'fighter_id' => $fighterId,
			'dive_bomber_id' => $diveBomberId,
			'torpedo_bomber_id' => $torpedoBomberId,
		]);
	}

	/**
	 * Request /wows/encyclopedia/modules/<br><br>Method returns the list of
	 * available modules that can be installed on ships, such as hulls, engines,
	 * etc. At least one input filter parameter (module_id, type) is required
	 * to be indicated.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $type Module type.
	 * @param int $moduleId Module ID
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/modules/
	 */
	public function getEncyclopediaModules($fields = '', $type = '',
		$moduleId = 0
	) {
		return $this->request->perform('/wows/encyclopedia/modules/', [
			'fields' => $this->toListString($fields),
			'type' => $type,
			'module_id' => $moduleId,
		]);
	}

	/**
	 * Request /wows/encyclopedia/exterior/<br><br>Method returns information
	 * about signals & camouflages.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param int $exteriorId Module ID
	 * @param string $type Module type.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/exterior/
	 */
	public function getEncyclopediaExterior($fields = '', $exteriorId = 0,
		$type = ''
	) {
		return $this->request->perform('/wows/encyclopedia/exterior/', [
			'fields' => $this->toListString($fields),
			'exterior_id' => $exteriorId,
			'type' => $type,
		]);
	}

	/**
	 * Request /wows/encyclopedia/upgrades/<br><br>Method returns the list of
	 * available ship upgrades.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param int $upgradeId Upgrade ID
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/upgrades/
	 */
	public function getEncyclopediaUpgrades($fields = '', $upgradeId = 0)
	{
		return $this->request->perform('/wows/encyclopedia/upgrades/', [
			'fields' => $this->toListString($fields),
			'upgrade_id' => $upgradeId,
		]);
	}

	/**
	 * Request /wows/encyclopedia/accountlevels/<br><br>Method returns
	 * information about Service Record levels.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/accountlevels/
	 */
	public function getEncyclopediaAccountlevels($fields = '')
	{
		return $this->request->perform('/wows/encyclopedia/accountlevels/', [
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wows/encyclopedia/crews/<br><br>Method returns the information
	 * about Commanders.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param int|int[] $commanderId Commander ID
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/crews/
	 */
	public function getEncyclopediaCrews($fields = '', $commanderId = 0)
	{
		return $this->request->perform('/wows/encyclopedia/crews/', [
			'fields' => $this->toListString($fields),
			'commander_id' => $this->toListString($commanderId),
		]);
	}

	/**
	 * Request /wows/encyclopedia/crewskills/<br><br>Method returns the
	 * information about Commanders' skills.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param int|int[] $skillId Skill ID
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/crewskills/
	 */
	public function getEncyclopediaCrewskills($fields = '', $skillId = 0)
	{
		return $this->request->perform('/wows/encyclopedia/crewskills/', [
			'fields' => $this->toListString($fields),
			'skill_id' => $this->toListString($skillId),
		]);
	}

	/**
	 * Request /wows/encyclopedia/crewranks/<br><br>Method returns the
	 * information about Commanders' ranks.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $nation Nation
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/crewranks/
	 */
	public function getEncyclopediaCrewranks($fields = '', $nation = '')
	{
		return $this->request->perform('/wows/encyclopedia/crewskills/', [
			'fields' => $this->toListString($fields),
			'nation' => $nation,
		]);
	}

	/**
	 * Request /wows/encyclopedia/battletypes/<br><br>The method returns
	 * information about battle types.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/battletypes/
	 */
	public function getEncyclopediaBattletypes($fields = '')
	{
		return $this->request->perform('/wows/encyclopedia/battletypes/', [
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wows/ships/stats/<br><br>Method returns general statistics for
	 * each ship of a player. Accounts with hidden game profiles are excluded
	 * from response. Hidden profiles are listed in the field meta.hidden.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param int|int[] $seasonId
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/battletypes/
	 */
	public function getShipsStats($fields = '', $seasonId = 0)
	{
		return $this->request->perform('/wows/ships/stats/', [
			'fields' => $this->toListString($fields),
			'season_id' => $seasonId,
		]);
	}

	/**
	 * Request /wows/seasons/info/<br><br>Method returns information about
	 * Ranked Battles seasons.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param int $seasonId Season ID
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/seasons/info/
	 */
	public function getSeasonsInfo($fields = '', $seasonId = 0)
	{
		return $this->request->perform('/wows/ships/stats/', [
			'fields' => $this->toListString($fields),
			'extra' => $this->toListString($seasonId),
		]);
	}

	/**
	 * Request /wows/seasons/shipstats/<br><br>Method returns players' ships
	 * statistics in Ranked Battles seasons. Accounts with hidden game profiles
	 * are excluded from response. Hidden profiles are listed in the field
	 * meta.hidden.
	 *
	 * @param int $accountId Player account ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $accessToken Access token is used to access personal user
	 * data. The token is obtained via authentication and has expiration time.
	 * @param int $seasonId Season ID
	 * @param int $shipId Ship ID
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/seasons/shipstats/
	 */
	public function getSeasonsShipstats($accountId, $fields = '',
		$accessToken = '', $seasonId = 0, $shipId = 0
	) {
		return $this->request->perform('/wows/ships/shipstats/', [
			'account_id' => $accountId,
			'fields' => $this->toListString($fields),
			'access_token' => $accessToken,
			'season_id' => $seasonId,
			'ship_id' => $shipId,
		]);
	}

	/**
	 * Request /wows/seasons/accountinfo/<br><br>Method returns players'
	 * statistics in Ranked Battles seasons. Accounts with hidden game profiles
	 * are excluded from response. Hidden profiles are listed in the field
	 * meta.hidden.
	 *
	 * @param int $accountId Player account ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $accessToken Access token is used to access personal user
	 * data. The token is obtained via authentication and has expiration time.
	 * @param int $seasonId Season ID
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/seasons/accountinfo/
	 */
	public function getSeasonsAccountinfo($accountId, $fields = '',
		$accessToken = '', $seasonId = 0
	) {
		return $this->request->perform('/wows/ships/accountinfo/', [
			'account_id' => $accountId,
			'fields' => $this->toListString($fields),
			'access_token' => $accessToken,
			'season_id' => $seasonId,
		]);
	}
}
