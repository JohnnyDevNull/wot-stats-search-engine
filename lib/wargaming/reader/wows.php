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
	 * @param string          $search
	 * @param string|string[] $fields
	 * @param string          $type [optional]
	 * @param int             $limit [optional]
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
	 * @param int|int[]       $accountId
	 * @param string|string[] $fields [optional]
	 * @param string          $accessToken [optional]
	 * @param string|string[] $extra [optional]
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
	 * @param string          $accountId
	 * @param string|string[] $fields [optional]
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
	 * Request /wows/account/statsbydate/<br><br>Method returns statistics
	 * lices by dates in specified time span.
	 *
	 * @param int             $accountId
	 * @param string|string[] $fields
	 * @param string|string[] $dates  Format: YYYYMMDD; Max. 10
	 * @param string|string[] $extra
	 *
	 * @return mixed
	 * @see https://developers.wargaming.net/reference/all/wows/account/statsbydate/
	 */
	public function getAccountStatsByDate($accountId, $fields = '',
		$dates = '', $extra = ''
	) {
		return $this->request->perform('/wows/account/statsbydate/', [
			'account_id' => $this->toListString($accountId),
			'fields' => $this->toListString($fields),
			'dates' => $this->toListString($dates),
			'extra' => $this->toListString($extra),
		]);
	}

	/**
	 * Request /wows/encyclopedia/info/<br><br>Method returns information about
	 * encyclopedia.
	 *
	 * @param string|string[] $fields [optional]
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
	 * @param int|int[]       $shipId [optional]
	 * @param string|string[] $fields [optional]
	 * @param string|string[] $nation [optional]
	 * @param string          $type [optional]
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/ships/
	 */
	public function getEncyclopediaShips($shipId = 0, $fields = '',
		$nation = '', $type = ''
	) {
		return $this->request->perform('/wows/encyclopedia/ships/', [
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
	 * @param string|string[] $fields [optional]
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
	 * @param int             $shipId Ship ID
	 * @param string|string[] $fields [optional]
	 * @param int             $artilleryId
	 * @param int             $torpedosId
	 * @param int             $fireControlId
	 * @param int             $flightControlId
	 * @param int             $hullId
	 * @param int             $endingeId
	 * @param int             $fighterId
	 * @param int             $diveBomberId
	 * @param int             $torpedoBomberId
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
	 * @param string|string[] $fields [optional]
	 * @param string $type
	 * @param int $moduleId
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
	 * @param string|string[] $fields [optional]
	 * @param int $exteriorId
	 * @param string $type
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
	 * @param string|string[] $fields [optional]
	 * @param int             $upgradeId
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
	 * @param string|string[] $fields [optional]
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
	 * @param string|string[] $fields [optional]
	 * @param int|int[] $commanderId
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
	 * @param string|string[] $fields [optional]
	 * @param int|int[] $skillId
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
	 * @param string|string[] $fields [optional]
	 * @param string $nation [optional]
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
	 * @param string|string[] $fields [optional]
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
	 * @param int             $accountId
	 * @param string|string[] $fields [optional]
	 * @param int|int[]       $seasonId
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/encyclopedia/battletypes/
	 */
	public function getShipsStats($accountId, $fields = '', $seasonId = 0)
	{
		return $this->request->perform('/wows/ships/stats/', [
			'account_id' => $accountId,
			'fields' => $this->toListString($fields),
			'season_id' => $seasonId,
		]);
	}

	/**
	 * Request /wows/seasons/info/<br><br>Method returns information about
	 * Ranked Battles seasons.
	 *
	 * @param string|string[] $fields [optional]
	 * @param int             $seasonId
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/seasons/info/
	 */
	public function getSeasonsInfo($fields = '', $seasonId = 0)
	{
		return $this->request->perform('/wows/seasons/info/', [
			'fields' => $this->toListString($fields),
			'season_id' => $this->toListString($seasonId),
		]);
	}

	/**
	 * Request /wows/seasons/shipstats/<br><br>Method returns players' ships
	 * statistics in Ranked Battles seasons. Accounts with hidden game profiles
	 * are excluded from response. Hidden profiles are listed in the field
	 * meta.hidden.
	 *
	 * @param int             $accountId
	 * @param string|string[] $fields [optional]
	 * @param string          $accessToken
	 * @param int             $seasonId
	 * @param int             $shipId
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/seasons/shipstats/
	 */
	public function getSeasonsShipstats($accountId, $fields = '',
		$accessToken = '', $seasonId = 0, $shipId = 0
	) {
		return $this->request->perform('/wows/seasons/shipstats/', [
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
	 * @param int             $accountId
	 * @param string|string[] $fields [optional]
	 * @param string          $accessToken
	 * @param int             $seasonId
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wows/seasons/accountinfo/
	 */
	public function getSeasonsAccountinfo($accountId, $fields = '',
		$accessToken = '', $seasonId = 0
	) {
		return $this->request->perform('/wows/seasons/accountinfo/', [
			'account_id' => $accountId,
			'fields' => $this->toListString($fields),
			'access_token' => $accessToken,
			'season_id' => $seasonId,
		]);
	}

	/**
	 * Request /wows/clans/list/<br><br> Method searches through clans
	 * and sorts them in a specified order.
	 *
	 * @param string          $search
	 * @param string|string[] $fields [optional]
	 * @param int             $limit [optional]
	 * @param int             $pageNo [optional]
	 *
	 * @return mixed
	 * @see https://developers.wargaming.net/reference/all/wows/clans/list/
	 */
	public function getClanList($search, $fields = '',
		$limit = 100, $pageNo = 1
	) {
		return $this->request->perform('/wows/clans/list/', [
			'search' => $search,
			'fields' => $this->toListString($fields),
			'limit' => $limit,
			'page_no' => $pageNo,
		]);
	}

	/**
	 * Request /wows/clans/info/<br><br>Method returns detailed clan
	 * information.
	 *
	 * @param int|int[]       $clanId
	 * @param string|string[] $fields
	 * @param string|string[] $extra
	 *
	 * @return mixed
	 * @see https://developers.wargaming.net/reference/all/wows/clans/info/
	 */
	public function getClanInfo($clanId, $fields = '',
		$extra = ''
	) {
		return $this->request->perform('/wows/clans/info/', [
			'clan_id' => $this->toListString($clanId),
			'fields' => $this->toListString($fields),
			'extra' => $this->toListString($extra),
		]);
	}

	/**
	 * Request /wows/clans/accountinfo/<br><br>Method returns player clan
	 * data. Player clan data exist only for accounts, that were participating
	 * in clan activities: sent join requests, were clan members etc.
	 *
	 * @param int|int[]       $accountId
	 * @param string|string[] $fields [optional]
	 * @param string|string[] $extra [optional]
	 *
	 * @return mixed
	 * @see https://developers.wargaming.net/reference/all/wows/clans/accountinfo/
	 */
	public function getClanAccountInfo($accountId, $fields = '',
		$extra = ''
	) {
		return $this->request->perform('/wows/clans/accountinfo/', [
			'account_id' => $this->toListString($accountId),
			'fields' => $this->toListString($fields),
			'extra' => $this->toListString($extra),
		]);
	}

	/**
	 * Request /wows/clans/glossary/<br><br> Method returns information on
	 * clan entities.
	 *
	 * @param string|string[] $fields [optional]
	 * @param string|string[] $extra [optional]
	 *
	 * @return mixed
	 * @see https://developers.wargaming.net/reference/all/wows/clans/glossary/
	 */
	public function getClanGlossary($fields = '', $extra = '')
	{
		return $this->request->perform('/wows/clans/glossary/', [
			'fields' => $this->toListString($fields),
			'extra' => $this->toListString($extra),
		]);
	}
}
