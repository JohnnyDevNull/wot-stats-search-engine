<?php
/**
 * "Wargaming.NET" api reader class.
 *
 * @see https://eu.wargaming.net/developers/api_reference/
 *
 * @package jp-wargaming-api-reader
 * @author Philipp John <info@jplace.de>
 * @copyright (c) 2016, Philipp John
 * @license http://opensource.org/licenses/MIT MIT see LICENSE.md
 */
class jpWargamingReaderClans extends jpWargamingBase
{
	/**
	 * @var string
	 */
	protected $api = 'worldoftanks';

	/**
	 * Request /wgn/clans/list/<br><br>Method searches through clans and sorts
	 * them by the following logic:<ul><li>the exact match of clan tag is placed
	 * first</li><li>the exact match of clan name is placed second</li><li>name
	 * or tag matches are placed next</li><li>all comparisons performed are case
	 * insensitive</li><li>expression [wg] is considered as the clan tag</li>
	 * <li>search for expression "[wg] clan" is performed by exact match of clan
	 * name and tag</li></ul>Disbanded, NPC, and technically frozen clans are
	 * excluded from response.
	 *
	 * @param string $search [optional] Part of name or tag for clan search.
	 * Minimum 2 characters
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param int $limit [optional] Number of returned entries (fewer can be
	 * returned, but not more than 100). If the limit sent exceeds 100, an limit
	 * of 100 is applied (by default).
	 * @param int $pageNo [optional] Page number
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wgn/clans/list/
	 */
	public function getClansList($search = '', $fields = '', $limit = 100,
		$pageNo = 0
	) {
		return $this->request->perform('/wgn/clans/list/', [
			'search' => $search,
			'fields' => $this->toListString($fields),
			'limit' => $limit,
			'page_no' => $pageNo,
		]);
	}

	/**
	 * Request /wgn/clans/info/<br><br>Method returns detailed clan information.
	 *
	 * @param int|int[] $clanId Clan ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 * @param string $accessToken Access token is used to access personal user
	 * data. The token is obtained via authentication and has expiration time.
	 * @param string $extra Extra fields to be included into the response. Valid
	 * values:<ul><li>private.online_members</li></ul>
	 * @param string $membersKey
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wgn/clans/info/
	 */
	public function getClansInfo($clanId, $fields = '', $accessToken = '',
		$extra = '', $membersKey = ''
	) {
		return $this->request->perform('/wgn/clans/info/', [
			'clan_id' => $clanId,
			'fields' => $this->toListString($fields),
			'access_token' => $accessToken,
			'extra' => $this->toListString($extra),
			'member_key' => $membersKey,
		]);
	}

	/**
	 * Request /wgn/clans/membersinfo/ Method returns clan member info and short
	 * info on the clan.
	 *
	 * @param int|int[] $accountId Account ID
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wgn/clans/membersinfo/
	 */
	public function getClansMembersinfo($accountId, $fields = '')
	{
		return $this->request->perform('/wgn/clans/membersinfo/', [
			'account_id' => $accountId,
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wgn/clans/glossary/ Method returns information on clan entities.
	 *
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wgn/clans/membersinfo/
	 */
	public function getClansGlossary($fields = '')
	{
		return $this->request->perform('/wgn/clans/glossary/', [
			'fields' => $this->toListString($fields),
		]);
	}

	/**
	 * Request /wgn/clans/messageboard/ Method returns messages of clan Message
	 * Board.
	 *
	 * @param string $accessToken Access token is used to access
	 * personal user data. The token is obtained via authentication and has
	 * expiration time.
	 * @param string|string[] $fields [optional] Response field. The fields are
	 * separated with commas. Embedded fields are separated with dots.<br>To
	 * exclude a field, use “-” in front of its name. In case the parameter is
	 * not defined, the method returns all fields.
	 *
	 * @return mixed
	 * @see https://eu.wargaming.net/developers/api_reference/wgn/clans/membersinfo/
	 */
	public function getClansMessageboard($accessToken = '', $fields = '')
	{
		return $this->request->perform('/wgn/clans/glossary/', [
			'access_token' => $accessToken,
			'fields' => $this->toListString($fields),
		]);
	}
}
