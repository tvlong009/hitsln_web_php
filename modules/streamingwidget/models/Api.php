<?php

namespace app\modules\streamingwidget\models;

class Api {

    protected $userName = 'Bean';
    protected $password = 'Binh';
    protected $portalID = 2;
    protected $sessionID;
    protected $userID;
    protected $outputType = 'json';
    protected $apiUrl = 'https://webserv.unplug.de/';

    /**
     * 
     * @param type $username
     * @param type $password
     * @param type $portalID
     */
    public function __construct($username = '', $password = '', $portalID = '') {
        if (!empty($username))
            $this->userName = $username;
        if (!empty($password))
            $this->password = $password;
        if ($portalID !== NULL && $portalID !== '')
            $this->portalID = $portalID;
    }

    /**
     * @param type $method
     * @param type $params
     * @return type
     * @throws Exception
     */
    protected function get($method, $params = NULL) {
        if (empty($this->apiUrl))
            throw new Exception('API Url is empty');
        $url = $this->apiUrl . $method . '/';
        foreach ($params as $key => $value)
            $url.= $key . '=' . $value . '/';
        if (!empty($this->outputType))
            $url .= 'output=' . $this->outputType;
        if (substr($url, 0, 5) == 'https') {
            if (!function_exists('curl_init') || !function_exists('curl_exec')) {
                throw new Exception('Missing CURL library');
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_REFERER, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $content = curl_exec($ch);
            curl_close($ch);
        } else
            $content = file_get_contents($url);
        return $content;
    }

    /**
     * 
     * @param type $method
     * @param type $params
     * @return type
     * @throws Exception
     */
    protected function post($method, $params) {
        if (empty($this->apiUrl))
            throw new Exception('API Url is empty');
        if (!function_exists('curl_init') || !function_exists('curl_exec'))
            throw new Exception('Missing CURL library');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $method . '/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_POST, 1);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

    public function setUserName($username) {
        $this->userName = $username;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setPortalID($portalID) {
        $this->portalID = $portalID;
    }

    public function getSessionID() {
        return $this->sessionID;
    }

    public function getLoggedUserID() {
        return $this->userID;
    }

    public function setOutput($type) {
        $this->outputType = strtolower($type) == 'json' ? 'json' : '';
    }

    public function getOutputType() {
        return $this->outputType;
    }

    public function setApiUrl($apiUrl) {
        $this->apiUrl = $apiUrl;
    }

    public function getApiUrl() {
        return $this->apiUrl;
    }

    public function response($response) {
        if ($this->outputType == 'json')
            return json_decode($response);
        else
            return $response;
    }

    /**
     * 
     * @return boolean
     */
    public function auth() {
        if (empty($this->userID) || empty($this->sessionID)) {
            $loggedData = $this->userLogin();
            if (isset($loggedData[0])) {
                $user = $loggedData[0];
                if (isset($user->sessionID))
                    $this->sessionID = $user->sessionID;
                if (isset($user->userID))
                    $this->userID = $user->userID;
                return TRUE;
            }
        }
        return FALSE;
    }
    /**
     * @function artistEditorialAdd
     * add an editorial for an artist.
     *
     ** @param type:PDO::PARAM_INT $contentOwnerID
     ** your content owner ID. if you don't already have one contact us for the id. 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $contentOwnerKey
     ** your content owner key. if you don't already have one contact us for the id. 											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** the artist you want to add the editorial for 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $title
     ** the title for the artist editorial 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $content
     ** the content of the editorial; can contain html. 											
     ** default: none
     *
     */
    public function artistEditorialAdd($contentOwnerID, $contentOwnerKey, $artistID, $title, $content) {
        return $this->response($this->get('artistEditorialAdd', array(
            'contentOwnerID' => $contentOwnerID,
            'contentOwnerKey' => $contentOwnerKey,
            'artistID' => $artistID, 
            'title' => $title, 'content' => $content)));
    }
    
    /**
     * @function artistEditorialRemove
     * remove and editorial for an artist.
     *
     ** @param type:PDO::PARAM_INT $contentOwnerID
     ** your content owner ID. if you don't already have one contact us for the id. 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $contentOwnerKey
     ** your content owner key. if you don't already have one contact us for the id. 											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** the artist you want to add the editorial for 											
     ** default: none
     *
     */
    public function artistEditorialRemove($contentOwnerID, $contentOwnerKey, $artistID) {
        return $this->response($this->get('artistEditorialRemove', array(
            'contentOwnerID' => $contentOwnerID,
            'contentOwnerKey' => $contentOwnerKey,
            'artistID' => $artistID
        )));
    }
    
    /**
     * @function artistEditorialUpdate
     * update an existing editorial for an artist.
     *
     ** @param type:PDO::PARAM_INT $contentOwnerID
     ** your content owner ID. if you don't already have one contact us for the id. 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $contentOwnerKey
     ** your content owner key. if you don't already have one contact us for the id. 											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** the artist you want to add the editorial for 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $title
     ** the title for the artist editorial 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $content
     ** the content of the editorial; can contain html. 											
     ** default: none
     *
     */
    public function artistEditorialUpdate($contentOwnerID, $contentOwnerKey, $artistID, $title, $content) {
        return $this->response($this->get('artistEditorialUpdate', array(
            'contentOwnerID' => $contentOwnerID, 'contentOwnerKey' => $contentOwnerKey, 'artistID' => $artistID, 'title' => $title, 'content' => $content
        )));
    }
    
    /**
     * @function findArtist
     * returns a list of artist objects based on a strict artist search
     *
     ** @param type:PDO::PARAM_STR $artist
     ** the artist name you are looking for 											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     */
    public function findArtist($artist, $portalID, $userID) {
        return $this->response($this->get('findArtist', array(
            'artist' => $artist, 'portalID' => $portalID, 'userID' => $userID
        )));
    }

    /**
     * @function findTrack
     * returns a list of track objects based on a title and artist search
     *
     ** @param type:PDO::PARAM_STR $artist
     ** (start of) the artist name you are looking for 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $title
     ** (start of) the title name you are looking for 											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     */
     public function findTrack($artist, $title, $portalID, $userID) {
        return $this->response($this->get('findTrack', array(
            'artist' => $artist, 'title' => $title, 'portalID' => $portalID, 'userID' => $userID
        )));
    }
    
    /**
     * @function getAlbum
     * get an album
     *
     ** @param type:PDO::PARAM_INT $playlistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $showTracks
     ** default: 1
     *
     */
     public function getAlbum($playlistID, $userID, $portalID, $showTracks = 1) {
        return $this->response($this->get('getAlbum', array(
            'playlistID' => $playlistID, 'userID' => $userID, 'portalID' => $portalID, 'showTracks' => $showTracks
        )));
    }

    /**
     * @function getAlbumAvailability
     * get a list of territories the playlist is available for
     *
     ** @param type:PDO::PARAM_INT $playlistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: 0
     *
     */
    public function getAlbumAvailability($playlistID, $portalID = 0) {
        return $this->response($this->get('getAlbumAvailability', array(
            'playlistID' => $playlistID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getAlbumPlaylists
     * get a list of userPlayLists that contain 1 or more tracks from the given Album.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $playlistID
     ** default: none
     *
     */
    public function getAlbumPlaylists($userID, $portalID, $playlistID) {
        return $this->response($this->get('getAlbumPlaylists', array(
            'userID' => $userID, 'portalID' => $portalID, 'playlistID' => $playlistID
        )));
    }

    /**
     * @function getAlbumTracks
     * get all tracks of an album
     *
     ** @param type:PDO::PARAM_INT $playlistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     */
    public function getAlbumTracks($playlistID, $userID) {
        return $this->response($this->get('getAlbumTracks', array(
            'playlistID' => $playlistID, 'userID' => $userID
        )));
    }

    /**
     * @function getArtist
     * get an artist
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $showAlbums
     ** default: 1
     *
     ** @param type:PDO::PARAM_BOOL $showTracks
     ** default: 1
     *
     ** @param type:PDO::PARAM_BOOL $showSimilar
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $albumTypeID
     ** The following ids are currently supported: 0-single 1-album 2-onetrack 3-bundle 											
     ** default: 0
     *
     */
    public function getArtist($artistID, $userID, $portalID, $showAlbums = 1, $showTracks = 1, $showSimilar = 0, $albumTypeID = 0) {
        return $this->response($this->get('getArtist', array(
            'artistID' => $artistID, 'userID' => $userID, 'portalID' => $portalID, 'showAlbums' => $showAlbums, 'showTracks' => $showTracks, 'showSimilar' => $showSimilar, 'albumTypeID' => $albumTypeID
        )));
    }

    /**
     * @function getArtistAlbums
     * get all albums for an artist
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $showTracks
     ** default: 1
     *
     ** @param type:PDO::PARAM_INT $albumTypeID
     ** The following ids are currently supported: 0-single 1-album 2-onetrack 3-bundle 											
     ** default: 0
     *
     */
    public function getArtistAlbums($artistID, $userID, $portalID, $showTracks = 1, $albumTypeID = 0) {
        return $this->response($this->get('getArtistAlbums', array(
            'artistID' => $artistID, 'userID' => $userID, 'portalID' => $portalID, 'showTracks' => $showTracks, 'albumTypeID' => $albumTypeID
        )));
    }

    /**
     * @function getArtistAlbumSummary
     * returns a list of albumcounts per albumtype.
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getArtistAlbumSummary($artistID, $portalID) {
        return $this->response($this->get('getArtistAlbumSummary', array(
            'artistID' => $artistID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getArtistEditorial
     * get an editorial for an artist.
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     */
    public function getArtistEditorial($portalID, $artistID) {
        return $this->response($this->get('getArtistEditorial', array(
            'portalID' => $portalID, 'artistID' => $artistID
        )));
    }

    /**
     * @function getArtistRadio
     * get a list of up to the 20 most popular tracks by an artist or artist similar to the artist.
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $startTrackID
     ** if supplied this will be the first track of the results. 											
     ** default: 0
     *
     */
    public function getArtistRadio($portalID, $artistID, $startTrackID = 0) {
        return $this->response($this->get('getArtistRadio', array(
            'portalID' => $portalID, 'artistID' => $artistID, 'startTrackID' => $startTrackID
        )));
    }

    /**
     * @function getArtistTags
     * get an list of tags that describe the artist
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getArtistTags($artistID, $userID, $portalID) {
        return $this->response($this->get('getArtistTags', array(
            'artistID' => $artistID, 'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getArtistTopTracks
     * get an list of most popular tracks by an artist
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     */
    public function getArtistTopTracks($userID, $portalID, $artistID) {
        return $this->response($this->get('getArtistTopTracks', array(
            'userID' => $userID, 'portalID' => $portalID, 'artistID' => $artistID
        )));
    }

    /**
     * @function getChartArchiveWeeks
     * returns a list of week numbers that have available lists for the given chartType and year number
     *
     ** @param type:PDO::PARAM_INT $chartTypeID
     ** use 2 for Top40, 3 for Hitzone 											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $year
     ** default: none
     *
     */
    public function getChartArchiveWeeks($chartTypeID, $portalID, $year) {
        return $this->response($this->get('getChartArchiveWeeks', array(
            'chartTypeID' => $chartTypeID, 'portalID' => $portalID, 'year' => $year
        )));
    }

    /**
     * @function getChartArchiveYears
     * returns a list of year numbers that have available lists for the given chartType
     *
     ** @param type:PDO::PARAM_INT $chartTypeID
     ** use 2 for Top40, 3 for Hitzone 											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getChartArchiveYears($chartTypeID, $portalID) {
        return $this->response($this->get('getChartArchiveYears', array(
            'chartTypeID' => $chartTypeID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getChartList
     * returns a chart list for the given week, year and chart type id
     *
     ** @param type:PDO::PARAM_INT $chartTypeID
     ** use 2 for Top40, 3 for Hitzone, 4 for HitsNL 											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $week
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $year
     ** default: none
     *
     */
    public function getChartList($chartTypeID, $portalID, $week, $year) {
        return $this->response($this->get('getChartList', array(
            'chartTypeID' => $chartTypeID, 'portalID' => $portalID, 'week' => $week, 'year' => $year
        )));
    }

    /**
     * @function getContracts
     * retrieves a list of available contracts for a portal
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getContracts($portalID) {
        return $this->response($this->get('getContracts', array(
            'portalID' => $portalID
        )));
    }

    /**
     * @function getFavoriteTypes
     * returns a list of available FavoriteTypes
     */
    public function getFavoriteTypes() {
        return $this->response($this->get('getFavoriteTypes', array()));
    }

    /**
     * @function getFile
     * get a file id
     *
     ** @param type:PDO::PARAM_INT $trackID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $format
     ** default: 36
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: 2
     *
     */
    public function getFile($trackID, $userID, $format = 36, $portalID = 2) {
        return $this->response($this->get('getFile', array(
            'trackID' => $trackID, 'userID' => $userID, 'format' => $format, 'portalID' => $portalID
        )));
    }

    /**
     * @function getFriendSuggestions
     * list of user objects detected as friend
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getFriendSuggestions($userID, $portalID) {
        return $this->response($this->get('getFriendSuggestions', array(
            'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getLabelList
     * return all available labels
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getLabelList($portalID) {
        return $this->response($this->get('getLabelList', array(
            'portalID' => $portalID
        )));
    }

    /**
     * @function getNewArtists
     * get a list artists that have new promopted albums
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $tagID
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $newAdded
     ** set to 1 to let the routine return new added artists instead of looking at the content. 											
     ** default: 0
     *
     */
    public function getNewArtists($userID, $portalID, $tagID = 0, $newAdded = 0) {
        return $this->response($this->get('getNewArtists', array(
            'userID' => $userID, 'portalID' => $portalID, 'tagID' => $tagID, 'newAdded' => $newAdded
        )));
    }

    /**
     * @function getNewReleases
     * get a list of promopted new releases
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $tagID
     */
    public function getNewReleases($userID, $portalID, $tagID) {
        return $this->response($this->get('getNewReleases', array(
            'userID' => $userID, 'portalID' => $portalID, 'tagID' => $tagID
        )));
    }

    /**
     * @function getNewReleasesByLabel
     * get a list of new releases for a content provider. set [days] to 0 to disable filtering on date.
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $contentProviderID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $days
     ** default: 10
     *
     ** @param type:PDO::PARAM_INT $result
     ** default: 50
     *
     */
    public function getNewReleasesByLabel($portalID, $userID, $contentProviderID, $days = 10, $result = 50) {
        return $this->response($this->get('getNewReleasesByLabel', array(
            'portalID' => $portalID, 'userID' => $userID, 'contentProviderID' => $contentProviderID, 'days' => $days, 'result' => $result
        )));
    }

    /**
     * @function getNewReleasesSimple
     * get a list of promopted new releases in a simple album format
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $tagID
     *
     ** @param type:PDO::PARAM_INT $page
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $itemCount
     ** default: 50
     *
     */
    public function getNewReleasesSimple($userID, $portalID, $tagID = 0, $page = 0, $itemCount = 50) {
        return $this->response($this->get('getNewReleasesSimple', array(
            'userID' => $userID, 'portalID' => $portalID, 'tagID' => $tagID, 'page' => $page, 'itemCount' => $itemCount
        )));
    }

    /**
     * @function getOfflineToken
     * request a token for track download for offline mode
     *
     ** @param type:PDO::PARAM_INT $trackID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $format
     ** default: 36
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: 2
     *
     ** @param type:PDO::PARAM_STR $sessionID
     ** default: none
     *
     */
    public function getOfflineToken($trackID, $userID, $sessionID, $format = 36, $portalID = 2) {
        return $this->response($this->get('getOfflineToken', array(
            'trackID' => $trackID, 'userID' => $userID, 'format' => $format, 'portalID' => $portalID, 'sessionID' => $sessionID
        )));
    }

    /**
     * @function getRadioStation
     * returns a list of 20 random tracks from the artist(s) in the radio station. (still under construction!)
     *
     ** @param type:PDO::PARAM_INT $radioStationID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     */
    public function getRadioStation($radioStationID, $portalID, $userID) {
        return $this->response($this->get('getRadioStation', array(
            'radioStationID' => $radioStationID, 'portalID' => $portalID, 'userID' => $userID
        )));
    }

    /**
     * @function getRandomArtistTracks
     * get records random tracks from an artist
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $records
     ** default: 10
     *
     ** @param type:PDO::PARAM_INT $page
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getRandomArtistTracks($artistID, $userID, $portalID, $records = 10, $page = 0) {
        return $this->response($this->get('getRandomArtistTracks', array(
            'artistID' => $artistID, 'records' => $records, 'page' => $page, 'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getRecentTracks
     * get the 10 last played tracks.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $result
     ** default: 10
     *
     */
    public function getRecentTracks($userID, $portalID, $result = 10) {
        return $this->response($this->get('getRecentTracks', array(
            'userID' => $userID, 'portalID' => $portalID, 'result' => $result
        )));
    }

    /**
     * @function getRedactionList
     * returns a redactional list, which can contain track, album, artist and playlist entities.
     *
     ** @param type:PDO::PARAM_INT $redactionListID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $showItems
     ** default: 1
     *
     */
    public function getRedactionList($redactionListID, $userID, $portalID, $showItems = 1) {
        return $this->response($this->get('getRedactionList', array(
            'redactionListID' => $redactionListID, 'userID' => $userID, 'portalID' => $portalID, 'showItems' => $showItems
        )));
    }

    /**
     * @function getSimilarArtists
     * get artists similar to an artist
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     */
    public function getSimilarArtists($portalID, $artistID) {
        return $this->response($this->get('getSimilarArtists', array(
            'portalID' => $portalID, 'artistID' => $artistID
        )));
    }

    /**
     * @function getStreamToken
     * get a file id and a streaming token used to request a stream.
     *
     ** @param type:PDO::PARAM_INT $trackID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $format
     ** 192kbps AAC+ = 36; 128kbps AAC+ = 39; 64kbps AAC+ = 35 											
     ** default: 36
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: 2
     *
     ** @param type:PDO::PARAM_STR $sessionID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $ip
     ** IPv4 address of the user 											
     ** default: none
     *
     */
    public function getStreamToken($trackID, $format = 36, $ip = '') {
        $this->auth();
        if (empty($this->userID) || empty($this->sessionID)) {
            throw new Exception('Require sign in');
            exit;
        }
        return $this->response($this->get('getStreamToken', array(
                            'trackID' => $trackID, 'userID' => $this->userID,
                            'portalID' => $this->portalID, 'sessionID' => $this->sessionID)));
    }

    /**
     * @function getTagAlbums
     * get all albums for an artist
     *
     ** @param type:PDO::PARAM_INT $tagID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $page
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $itemCount
     ** default: 20
     *
     */
    public function getTagAlbums($tagID, $userID, $portalID, $page = 0, $itemCount = 20) {
        return $this->response($this->get('getTagAlbums', array(
            'tagID' => $tagID, 'userID' => $userID, 'portalID' => $portalID, 'page' => $page, 'itemCount' => $itemCount
        )));
    }
    
    /**
     * @function getTagAlbumsByPopularity
     * get the most popular albums for a given tag
     *
     ** @param type:PDO::PARAM_INT $tagID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $page
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $itemCount
     ** default: 20
     *
     */
    public function getTagAlbumsByPopularity($tagID, $userID, $portalID, $page = 0, $itemCount = 20) {
        return $this->response($this->get('getTagAlbumsByPopularity', array(
            'tagID' => $tagID, 'userID' => $userID, 'portalID' => $portalID, 'page' => $page, 'itemCount' => $itemCount
        )));
    }

    /**
     * @function getTagList
     * return all available tags
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getTagList($portalID) {
        return $this->response($this->get('getTagList', array(
            'portalID' => $portalID
        )));
    }

    /**
     * @function getTagTracks
     * get a list of new tracks in a tag.
     *
     ** @param type:PDO::PARAM_INT $tagID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $page
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $itemCount
     ** default: 20
     *
     */
    public function getTagTracks($tagID, $userID, $portalID, $page = 0, $itemCount = 20) {
        return $this->response($this->get('getTagTracks', array(
            'tagID' => $tagID, 'userID' => $userID, 'portalID' => $portalID, 'page' => $page, 'itemCount' => $itemCount
        )));
    }

    /**
     * @function getTagTracksByPopularity
     * get a list of popular tracks in a tag.
     *
     ** @param type:PDO::PARAM_INT $tagID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $page
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $itemCount
     ** default: 50
     *
     */
    public function getTagTracksByPopularity($tagID, $userID, $portalID, $page = 0, $itemCount = 50) {
        return $this->response($this->get('getTagTracksByPopularity', array(
            'tagID' => $tagID, 'userID' => $userID, 'portalID' => $portalID, 'page' => $page, 'itemCount' => $itemCount
        )));
    }

    /**
     * @function getTop40YearAlbumList
     * get a top 10 tracks for the period @startYear - @endYear
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $startYear
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $endYear
     ** default: none
     *
     */
    public function getTop40YearAlbumList($userID, $portalID, $startYear, $endYear) {
        return $this->response($this->get('getTop40YearAlbumList', array(
            'userID' => $userID, 'portalID' => $portalID, 'startYear' => $startYear, 'endYear' => $endYear
        )));
    }

    /**
     * @function getTop40YearArtistList
     * get a top 40 artists list for the period @startYear - @endYear
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $startYear
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $endYear
     ** default: none
     *
     */
    public function getTop40YearArtistList($userID, $portalID, $startYear, $endYear) {
        return $this->response($this->get('getTop40YearArtistList', array(
            'userID' => $userID, 'portalID' => $portalID, 'startYear' => $startYear, 'endYear' => $endYear
        )));
    }

    /**
     * @function getTop40YearList
     * get a top 10 tracks for the period @startYear - @endYear
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $startYear
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $endYear
     ** default: none
     *
     */
    public function getTop40YearList($userID, $startYear, $endYear) {
        return $this->response($this->get('getTop40YearList', array(
            'userID' => $userID, 'startYear' => $startYear, 'endYear' => $endYear
        )));
    }

    /**
     * @function getTop40YearTagList
     * get a top 40 tag list for the period @startYear - @endYear
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $startYear
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $endYear
     ** default: none
     *
     */
    public function getTop40YearTagList($userID, $portalID, $startYear, $endYear) {
        return $this->response($this->get('getTop40YearTagList', array(
            'userID' => $userID, 'portalID' => $portalID, 'startYear' => $startYear, 'endYear' => $endYear
        )));
    }

    /**
     * @function getTopAlbums
     * gets the top 50 most popular albums in the last week.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $tagID
     *
     ** @param type:PDO::PARAM_INT $labelID
     *
     */
    public function getTopAlbums($userID, $portalID, $tagID, $labelID) {
        return $this->response($this->get('getTopAlbums', array(
            'userID' => $userID, 'portalID' => $portalID, 'tagID' => $tagID, 'labelID' => $labelID
        )));
    }

    /**
     * @function getTopAlbumsSimple
     * gets the top 50 most popular simple album objects.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $tagID
     *
     ** @param type:PDO::PARAM_INT $labelID
     *
     ** @param type:PDO::PARAM_INT $page
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $itemCount
     ** default: 50
     *
     */
    public function getTopAlbumsSimple($userID, $portalID, $tagID = 0, $labelID = 0, $page = 0, $itemCount = 50) {
        return $this->response($this->get('getTopAlbumsSimple', array(
            'userID' => $userID, 'portalID' => $portalID, 'tagID' => $tagID, 'labelID' => $labelID, 'page' => $page, 'itemCount' => $itemCount
        )));
    }
    
    /**
     * @function getTopArtists
     * gets the top 50 most popular artists in the last week.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $tagID
     *
     */
    public function getTopArtists($userID, $portalID, $tagID) {
        return $this->response($this->get('getTopArtists', array(
            'userID' => $userID, 'portalID' => $portalID, 'tagID' => $tagID
        )));
    }

    /**
     * @function getTopTags
     * list of most listened tags.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getTopTags($userID, $portalID) {
        return $this->response($this->get('getTopTags', array(
            'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getTopTracks
     * gets the top 50 most popular tracks in the last week.
     * @throws Exception
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $tagID
     *
     */
    public function getTopTracks() {
        $this->auth();
        if (empty($this->userID) || empty($this->sessionID)) {
            throw new Exception('Require sign in');
            exit;
        }
        return $this->response($this->get('getTopTracks', array('portalID' => 2, 'userID' => $this->userID)));
    }

    /**
     * @function getTopUserPlayLists
     * gets the top 50 most userPlaylists in the last week.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getTopUserPlayLists($userID, $portalID) {
        return $this->response($this->get('getTopUserPlayLists', array(
            'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getTrack
     * get a track
     *
     ** @param type:PDO::PARAM_INT $trackID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $position
     ** default: 1
     *
     ** @param type:PDO::PARAM_INT $parent
     ** default: 0
     *
     */
    public function getTrack($trackID, $userID, $position = 1, $parent = 0) {
        return $this->response($this->get('getTrack', array(
            'trackID' => $trackID, 'userID' => $userID, 'position' => $position, 'parent' => $parent
        )));
    }

    /**
     * @function getTrackAvailability
     * get a list of territories the track is available for
     *
     ** @param type:PDO::PARAM_INT $trackID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: 0
     *
     */
    public function getTrackAvailability($trackID, $portalID = 0) {
        return $this->response($this->get('getTrackAvailability', array(
            'trackID' => $trackID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getTrackSuggestions
     * generate a list of {resultCount} tracks starting from {trackID}
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $trackID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $resultCount
     ** default: 10
     *
     */
    public function getTrackSuggestions($userID, $portalID, $trackID, $resultCount = 10) {
        return $this->response($this->get('getTrackSuggestions', array(
            'userID' => $userID, 'portalID' => $portalID, 'trackID' => $trackID, 'resultCount' => $resultCount
        )));
    }

    /**
     * @function getUser
     * list of user objects detected as friend
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $details
     ** default: 1
     *
     */
    public function getUser($userID, $portalID, $details = 1) {
        return $this->response($this->get('getUser', array(
            'userID' => $userID, 'portalID' => $portalID, 'details' => $details
        )));
    }

    /**
     * @function getUserContracts
     * list all user contract objects
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getUserContracts($userID, $portalID) {
        return $this->response($this->get('getUserContracts', array(
            'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getUserFavorites
     * list of user favorite items
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $favoriteTypeId
     ** default: none
     *
     */
    public function getUserFavorites($userID, $portalID, $favoriteTypeId) {
        return $this->response($this->get('getUserFavorites', array(
            'userID' => $userID, 'portalID' => $portalID, 'favoriteTypeId' => $favoriteTypeId
        )));
    }

    /**
     * @function getUserFavoritesSimple
     * lists a summary of user favorite items
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getUserFavoritesSimple($userID, $portalID) {
        return $this->response($this->get('getUserFavoritesSimple', array(
            'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getUserFriends
     * list of user objects detected as friend
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getUserFriends($userID, $portalID) {
        return $this->response($this->get('getUserFriends', array(
            'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getUserFriendsStatus
     * returns a list of users and the current playing songs.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getUserFriendsStatus($userID, $portalID) {
        return $this->response($this->get('getUserFriendsStatus', array(
            'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getUserId
     * find the id for a username.
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** the portalID the request is done for. 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $userName
     ** The username you want to find the userID for. 											
     ** default: none
     *
     */
    public function getUserId($portalID, $userName) {
        return $this->response($this->get('getUserId', array(
            'portalID' => $portalID, 'userName' => $userName
        )));
    }

    /**
     * @function getUserLists
     * returns a list of userPlaylist objects with all playlists created by the given user.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $showTracks
     ** default: 1
     *
     */
    public function getUserLists($userID, $portalID, $showTracks = 1) {
        return $this->response($this->get('getUserLists', array(
            'userID' => $userID, 'portalID' => $portalID, 'showTracks' => $showTracks
        )));
    }

    /**
     * @function getUserPlaylist
     * returns a description of a userPlaylist in a default playlist structure
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $showTracks
     ** default: 1
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $showTrackIds
     ** returns a concatenated list of the tracks and their playList IDs in the list when set to true. 											
     ** default: 0
     *
     */
    public function getUserPlaylist($userPlaylistID, $userID, $showTracks = 1, $portalID, $showTrackIds = 0) {
        return $this->response($this->get('getUserPlaylist', array(
            'userPlaylistID' => $userPlaylistID, 'userID' => $userID, 'showTracks' => $showTracks, 'portalID' => $portalID, 'showTrackIds' => $showTrackIds
        )));
    }

    /**
     * @function getUserPlayListGroups
     * Gets the users playlist groups.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getUserPlayListGroups($userID, $portalID) {
        return $this->response($this->get('getUserPlayListGroups', array(
            'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getUserPlaylistTracks
     * returns the content of a userPlaylist in a default track structure
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     */
    public function getUserPlaylistTracks($userPlaylistID, $userID) {
        return $this->response($this->get('getUserPlaylistTracks', array(
            'userPlaylistID' => $userPlaylistID, 'userID' => $userID
        )));
    }

    /**
     * @function getUserRatings
     * get a list of all tracks rated by a user
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     */
    public function getUserRatings($userID) {
        return $this->response($this->get('getUserRatings', array(
            'userID' => $userID
        )));
    }

    /**
     * @function getUserTopArtists
     * list of most listened to artists by a user.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getUserTopArtists($userID, $portalID) {
        return $this->response($this->get('getUserTopArtists', array(
            'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getUserTopTags
     * list of most listened tags by a user.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function getUserTopTags($userID, $portalID) {
        return $this->response($this->get('getUserTopTags', array(
            'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function getWebText
     * get a webtext
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $key
     ** default: none
     *
     */
    public function getWebText($portalID, $key) {
        return $this->response($this->get('getWebText', array(
            'portalID' => $portalID, 'key' => $key
        )));
    }

    /**
     * @function listWebText
     * list webtexts for a portal
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function listWebText($portalID) {
        return $this->response($this->get('listWebText', array(
            'portalID' => $portalID
        )));
    }

    /**
     * @function radioStationArtistAdd
     * add an artist to a radioStation.
     *
     ** @param type:PDO::PARAM_INT $radioStationID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $portalKey
     ** the private authentication key for the portal. this key is provided by targetmusic. 											
     ** default: none
     *
     */
    public function radioStationArtistAdd($radioStationID, $artistID, $portalID, $portalKey) {
        return $this->response($this->get('radioStationArtistAdd', array(
            'radioStationID' => $radioStationID, 'artistID' => $artistID, 'portalID' => $portalID, 'portalKey' => $portalKey
        )));
    }

    /**
     * @function radioStationArtistList
     * returns all the artists in a radio station
     *
     ** @param type:PDO::PARAM_INT $radioStationID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     */
    public function radioStationArtistList($radioStationID, $portalID, $userID) {
        return $this->response($this->get('radioStationArtistList', array(
            'radioStationID' => $radioStationID, 'portalID' => $portalID, 'userID' => $userID
        )));
    }

    /**
     * @function radioStationArtistRemove
     * removes an artist from a radioStation.
     *
     ** @param type:PDO::PARAM_INT $radioStationID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $portalKey
     ** the private authentication key for the portal. this key is provided by targetmusic. 											
     ** default: none
     *
     */
    public function radioStationArtistRemove($radioStationID, $artistID, $portalID, $portalKey) {
        return $this->response($this->get('radioStationArtistRemove', array(
            'radioStationID' => $radioStationID, 'artistID' => $artistID, 'portalID' => $portalID, 'portalKey' => $portalKey
        )));
    }

    /**
     * @function radioStationCreate
     * create a new radio station
     *
     ** @param type:PDO::PARAM_STR $name
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $includeSimilar
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $portalKey
     ** the private authentication key for the portal. this key is provided by targetmusic. 											
     ** default: none
     *
     */
    public function radioStationCreate($name, $portalID, $portalKey, $includeSimilar = 0) {
        return $this->response($this->get('radioStationCreate', array(
            'name' => $name, 'includeSimilar' => $includeSimilar, 'portalID' => $portalID, 'portalKey' => $portalKey
        )));
    }

    /**
     * @function radioStationList
     * returns a list with all radio stations for the portal
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function radioStationList($portalID) {
        return $this->response($this->get('radioStationList', array(
            'portalID' => $portalID
        )));
    }

    /**
     * @function radioStationRemove
     * removes a radio station
     *
     ** @param type:PDO::PARAM_INT $radioStationID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $portalKey
     ** the private authentication key for the portal. this key is provided by targetmusic. 											
     ** default: none
     *
     */
    public function radioStationRemove($radioStationID, $portalID, $portalKey) {
        return $this->response($this->get('radioStationRemove', array(
            'radioStationID' => $radioStationID, 'portalID' => $portalID, 'portalKey' => $portalKey
        )));
    }

    /**
     * @function radioStationTruncate
     * removes all artists from a radio station
     *
     ** @param type:PDO::PARAM_INT $radioStationID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $portalKey
     ** the private authentication key for the portal. this key is provided by targetmusic. 											
     ** default: none
     *
     */
    public function radioStationTruncate($radioStationID, $portalID, $portalKey) {
        return $this->response($this->get('radioStationTruncate', array(
            'radioStationID' => $radioStationID, 'portalID' => $portalID, 'portalKey' => $portalKey
        )));
    }

    /**
     * @function radioStationUpdate
     * update an existing radio station
     *
     ** @param type:PDO::PARAM_INT $radioStationID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $name
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $includeSimilar
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $portalKey
     ** the private authentication key for the portal. this key is provided by targetmusic. 											
     ** default: none
     *
     */
    public function radioStationUpdate($radioStationID, $name, $portalID, $portalKey, $includeSimilar = 0) {
        return $this->response($this->get('radioStationUpdate', array(
            'radioStationID' => $radioStationID, 'name' => $name, 'includeSimilar' => $includeSimilar, 'portalID' => $portalID, 'portalKey' => $portalKey
        )));
    }

    /**
     * @function redactionListCreate
     * create a new user redactional list
     *
     ** @param type:PDO::PARAM_STR $name
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function redactionListCreate($name, $portalID) {
        return $this->response($this->get('redactionListCreate', array(
            'name' => $name, 'portalID' => $portalID
        )));
    }

    /**
     * @function redactionListItemAdd
     * add item to a redactional list
     *
     ** @param type:PDO::PARAM_INT $redactionListID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $position
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $trackID
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $playListID
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $userListID
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $radioStationID
     ** default: 0
     *
     */
    public function redactionListItemAdd($redactionListID, $portalID, $position = 0, $trackID = 0, $playListID = 0, $artistID = 0, $userListID = 0, $radioStationID = 0) {
        return $this->response($this->get('redactionListItemAdd', array(
            'redactionListID' => $redactionListID, 'portalID' => $portalID, 'position' => $position, 'trackID' => $trackID, 'playListID' => $playListID, 'artistID' => $artistID, 'userListID' => $userListID, 'radioStationID' => $radioStationID
        )));
    }

    /**
     * @function redactionListItemRemove
     * remove an item from a redactional list
     *
     ** @param type:PDO::PARAM_INT $redactionListID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $trackID
     *
     ** @param type:PDO::PARAM_INT $playListID
     *
     ** @param type:PDO::PARAM_INT $artistID
     *
     ** @param type:PDO::PARAM_INT $userListID
     *
     */
    public function redactionListItemRemove($redactionListID, $portalID, $trackID, $playListID, $artistID, $userListID) {
        return $this->response($this->get('redactionListItemRemove', array(
            'redactionListID' => $redactionListID, 'portalID' => $portalID, 'trackID' => $trackID, 'playListID' => $playListID, 'artistID' => $artistID, 'userListID' => $userListID
        )));
    }

    /**
     * @function redactionListItemsTruncate
     * remove all items from a redactional list
     *
     ** @param type:PDO::PARAM_INT $redactionListID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function redactionListItemsTruncate($redactionListID, $portalID) {
        return $this->response($this->get('redactionListItemsTruncate', array(
            'redactionListID' => $redactionListID, 'portalID' => $portalID
        )));
    }

    /**
     * @function redactionListRemove
     * truncate and remove a redactional list; this is an irreversible process.
     *
     ** @param type:PDO::PARAM_INT $redactionListID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function redactionListRemove($redactionListID, $portalID) {
        return $this->response($this->get('redactionListRemove', array(
            'redactionListID' => $redactionListID, 'portalID' => $portalID
        )));
    }

    /**
     * @function redactionListsList
     * returns a list of all redaction lists for the given portalID.
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function redactionListsList($portalID) {
        return $this->response($this->get('redactionListsList', array(
            'portalID' => $portalID
        )));
    }

    /**
     * @function searchAlbum
     * returns a list of album objects containing keyword in the title.
     *
     ** @param type:PDO::PARAM_STR $keyword
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     */
    public function searchAlbum($keyword, $portalID, $userID) {
        return $this->response($this->get('searchAlbum', array(
            'keyword' => $keyword, 'portalID' => $portalID, 'userID' => $userID
        )));
    }

    /**
     * @function searchArtist
     * returns a list of artist objects containing keyword in the artist name (or in their aliases).
     *
     ** @param type:PDO::PARAM_STR $keyword
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $page
     ** default: 0
     *
     ** @param type:PDO::PARAM_INT $itemCount
     ** default: 20
     *
     */
    public function searchArtist($keyword, $portalID, $userID, $page = 0, $itemCount = 20) {
        return $this->response($this->get('searchArtist', array(
            'keyword' => $keyword, 'portalID' => $portalID, 'userID' => $userID, 'page' => $page, 'itemCount' => $itemCount
        )));
    }

    /**
     * @function searchTrack
     * returns a list of track objects containing keyword in the title or artist name (or in their aliases).
     *
     ** @param type:PDO::PARAM_STR $keyword
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     */
    public function searchTrack($keyword, $portalID, $userID) {
        return $this->response($this->get('searchTrack', array(
            'keyword' => $keyword, 'portalID' => $portalID, 'userID' => $userID
        )));
    }

    /**
     * @function searchUser
     * returns a list of user objects containing keyword in the username
     *
     ** @param type:PDO::PARAM_STR $keyword
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function searchUser($keyword, $userID, $portalID) {
        return $this->response($this->get('searchUser', array(
            'keyword' => $keyword, 'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function setTrackRating
     * adds or replaces a rating for a track, returns void.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $trackID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $rating
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function setTrackRating($userID, $trackID, $rating, $portalID) {
        return $this->response($this->get('setTrackRating', array(
            'userID' => $userID, 'trackID' => $trackID, 'rating' => $rating, 'portalID' => $portalID
        )));
    }

    /**
     * @function setUserListPlay
     * log a play for a playlist, only one play per playlist/user is recorded each day.
     *
     ** @param type:PDO::PARAM_INT $userListID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: 2
     *
     */
    public function setUserListPlay($userListID, $userID, $portalID = 2) {
        return $this->response($this->get('setUserListPlay', array(
            'userListID' => $userListID, 'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function setUserPlaylistPositions
     * set the positions for the tracks in a userlist en masse
     * method: POST
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $data
     ** The data you want to be update. This should be in XML format like  											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function setUserPlaylistPositions($userPlaylistID, $data, $userID, $portalID) {
        return $this->response($this->post('setUserPlaylistPositions', array(
            'userPlaylistID' => $userPlaylistID, 'data' => $data, 'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function setWebText
     * add or update a webtext
     * method: POST
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $key
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $title
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $body
     ** default: none
     *
     */
    public function setWebText($portalID, $key, $title, $body) {
        return $this->response($this->post('setWebText', array(
            'portalID' => $portalID, 'key' => $key, 'title' => $title, 'body' => $body
        )));
    }

    /**
     * @function transactionTokenGet
     * Request a transaction token for a contract transacion.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $contractID
     ** the id of the contract the user is assigned (see getContracts) 											
     ** default: none
     *
     */
    public function transactionTokenGet($userID, $portalID, $contractID) {
        return $this->response($this->get('transactionTokenGet', array(
            'userID' => $userID, 'portalID' => $portalID, 'contractID' => $contractID
        )));
    }

    /**
     * @function transactionTokenUserGet
     * get user information for the user requesting a transaction.
     *
     ** @param type:PDO::PARAM_INT $token
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     *
     ** @param type:PDO::PARAM_INT $dwportalID
     ** the id of the digiwallet outlet. if supplied the portalID can be left empty. 											
     *
     */
    public function transactionTokenUserGet($token, $portalID, $dwportalID) {
        return $this->response($this->get('transactionTokenUserGet', array(
            'token' => $token, 'portalID' => $portalID, 'dwportalID' => $dwportalID
        )));
    }

    /**
     * @function userActivate
     * activate a user, should only be used when using two step registration.
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $userName
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $active
     ** indicates wheter the user account needs to be activated (1) or not (0). 											
     ** default: 1
     *
     */
    public function userActivate($portalID, $userName, $active = 1) {
        return $this->response($this->get('userActivate', array(
            'portalID' => $portalID, 'userName' => $userName, 'active' => $active
        )));
    }

    /**
     * @function userContractAdd
     * add a contract to an existing user
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $token
     ** transaction token must be aquired before the transaction using transactionTokenGet 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $transactionID
     ** custom transaction identifier 											
     ** default: none
     *
     */
    public function userContractAdd($userID, $portalID, $token, $transactionID) {
        return $this->response($this->get('userContractAdd', array(
            'userID' => $userID, 'portalID' => $portalID, 'token' => $token, 'transactionID' => $transactionID
        )));
    }

    /**
     * @function userContractEnd
     * end an active user contract
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userLogID
     ** the userLogID you wish to cancel. use getUserContracts to get the right value. 											
     ** default: none
     *
     */
    public function userContractEnd($userID, $portalID, $userLogID) {
        return $this->response($this->get('userContractEnd', array(
            'userID' => $userID, 'portalID' => $portalID, 'userLogID' => $userLogID
        )));
    }

    /**
     * @function userCreate
     * create a new user
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $userName
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $email
     ** validation should be done on the service side 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $passwordHash
     ** Hashed password for the user. Hashing is to be done on the service side, the passwordHash can be either SHA1 or mysql PASSWORD encrypted. hashing is to be done on the service side if version 1 is used. 											
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $active
     ** indicates wheter the user account needs to be activated (0) or is activated upon creation (1). 											
     ** default: 1
     *
     ** @param type:PDO::PARAM_STR $deviceID
     ** unique device identifier; use for mobile devices. Leave empty if not used. 											
     *
     ** @param type:PDO::PARAM_INT $version
     ** The version of the login mechanism to use. Version 1 assumes simple pre-hashed passwords and will be phased out. Version 2 uses a 'seasoned' password. 											
     ** default: 1
     *
     */
    public function userCreate($portalID, $userName, $email, $passwordHash, $active = 1, $deviceID = 1, $version = 1) {
        return $this->response($this->get('userCreate', array(
            'portalID' => $portalID, 'userName' => $userName, 'email' => $email, 'passwordHash' => $passwordHash, 'active' => $active, 'deviceID' => $deviceID, 'version' => $version
        )));
    }

    /**
     * @function userExternalIdentifierAdd
     * store a key value pair for a user.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $type
     ** external identifier type. (i.e. "fb" for facebook) 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $externalID
     ** default: none
     *
     */
    public function userExternalIdentifierAdd($userID, $type, $externalID) {
        return $this->response($this->get('userExternalIdentifierAdd', array(
            'userID' => $userID, 'type' => $type, 'externalID' => $externalID
        )));
    }

    /**
     * @function userExternalLogin
     * logs in the user using an external identifier (for example because an oAuth login is used) and returns the session id.
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $userName
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $externalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $externalIDType
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $ip
     ** IPv4 address of the user 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $sessionID
     ** leave this value empty. 											
     ** default: none
     *
     */
    public function userExternalLogin($portalID, $userName, $externalID, $externalIDType, $ip, $sessionID) {
        return $this->response($this->get('userExternalLogin', array(
            'portalID' => $portalID, 'userName' => $userName, 'externalID' => $externalID, 'externalIDType' => $externalIDType, 'ip' => $ip, 'sessionID' => $sessionID
        )));
    }
    
    /**
     * @function userFavoriteAdd
     * Add an item to the favorites for a user
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $favoriteTypeId
     ** The following types are currently supported: artistalbumtrackuserplaylistradiostationredactionlist 											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $value
     ** identifier of the item to be added 											
     ** default: none
     *
     */
    public function userFavoriteAdd($userID, $portalID, $favoriteTypeId, $value) {
        return $this->response($this->get('userFavoriteAdd', array(
            'userID' => $userID, 'portalID' => $portalID, 'favoriteTypeId' => $favoriteTypeId, 'value' => $value
        )));
    }

    /**
     * @function userFavoriteRemove
     * Removes an item from the favorites for a user
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $favoriteTypeId
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $value
     ** identifier of the item to be removed 											
     ** default: none
     *
     */
    public function userFavoriteRemove($userID, $portalID, $favoriteTypeId, $value) {
        return $this->response($this->get('userFavoriteRemove', array(
            'userID' => $userID, 'portalID' => $portalID, 'favoriteTypeId' => $favoriteTypeId, 'value' => $value
        )));
    }

    /**
     * @function userFriendAdd
     * Adds a user to your friend list.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $friendID
     ** default: none
     *
     */
    public function userFriendAdd($userID, $portalID, $friendID) {
        return $this->response($this->get('userFriendAdd', array(
            'userID' => $userID, 'portalID' => $portalID, 'friendID' => $friendID
        )));
    }

    /**
     * @function userFriendRemove
     * Removes a user from your friend list.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $friendID
     ** default: none
     *
     */
    public function userFriendRemove($userID, $portalID, $friendID) {
        return $this->response($this->get('userFriendRemove', array(
            'userID' => $userID, 'portalID' => $portalID, 'friendID' => $friendID
        )));
    }

    /**
     * @function userGetStreamServer
     * returns the streamServer hostname for a user.
     * @throws Exception
     * 
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     */
    public function userGetStreamServer() {
        $this->auth();
        if (empty($this->userID) || empty($this->sessionID)) {
            throw new Exception('Require sign in');
            exit;
        }
        return $this->response($this->get('userGetStreamServer', array('portalID' => $this->portalID, 'userID' => $this->userID)));
    }

    /**
     * @function userHasExternalLogin
     * Checks if the user has a external login available.
     *
     ** @param type:PDO::PARAM_STR $externalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $externalIDType
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $userName
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $email
     ** default: none
     *
     */
    public function userHasExternalLogin($externalID, $externalIDType, $userName, $email) {
        return $this->response($this->get('userHasExternalLogin', array(
            'externalID' => $externalID, 'externalIDType' => $externalIDType, 'userName' => $userName, 'email' => $email
        )));
    }

    /**
     * @function userInfoAdd
     * store a key value pair for a user.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $key
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $value
     ** default: none
     *
     */
    public function userInfoAdd($userID, $portalID, $key, $value) {
        return $this->response($this->get('userInfoAdd', array(
            'userID' => $userID, 'portalID' => $portalID, 'key' => $key, 'value' => $value
        )));
    }

    /**
     * @function userInfoGet
     * returns all key value pairs stored for the user.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function userInfoGet($userID, $portalID) {
        return $this->response($this->get('userInfoGet', array(
            'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function userInfoGetByKey
     * returns a key value pairs stored for the user.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $key
     ** default: none
     *
     */
    public function userInfoGetByKey($userID, $portalID, $key) {
        return $this->response($this->get('userInfoGetByKey', array(
            'userID' => $userID, 'portalID' => $portalID, 'key' => $key
        )));
    }

    /**
     * @function userLogin
     * logs in the user and returns the session id.
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: use class property
     *
     ** @param type:PDO::PARAM_STR $userName
     ** default: use class property
     *
     ** @param type:PDO::PARAM_STR $passwordHash
     ** default: use class property
     *
     ** @param type:PDO::PARAM_STR $ip
     ** IPv4 address of the user 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $sessionID
     ** leave this value empty. 											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $version
     ** The version of the login mechanism to use. Version 1 assumes simple hashed passwords and will be phased out. Version 2 uses a 'seasoned' password. 											
     ** default: 1
     *
     ** @param type:PDO::PARAM_INT $isMobile
     ** Indicates if the connection is made from the web (0) or a mobile (1) device. 											
     ** default: 0
     *
     ** @param type:PDO::PARAM_STR $appVersion
     ** contains the version of the app the user is using, if any. 											
     ** default: none
     *
     */
    public function userLogin($ip = '', $sessionID = '', $appVersion = '', $version = 1, $isMobile = 0) {
        $response = $this->get('userLogin', array('userName' => $this->userName,
            'passwordHash' => $this->password, 'portalID' => $this->portalID));
        return $this->response($response);
    }

    /**
     * @function userMessagingUpdate
     * store the user messaging preferences.
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $deviceID
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $status
     ** default: none
     *
     */
    public function userMessagingUpdate($userID, $portalID, $deviceID, $status) {
        return $this->response($this->get('userMessagingUpdate', array(
            'userID' => $userID, 'portalID' => $portalID, 'deviceID' => $deviceID, 'status' => $status
        )));
    }

    /**
     * @function userPasswordUpdate
     * update the password for an existing user
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $userName
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $email
     ** validation should be done on the service side 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $passwordHash
     ** this is the new password for the user. can be either PASSWORD or SHA-1 encrypted. hashing is to be done on the service side if version 1 is used. 											
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $portalKey
     ** the private authentication key for the portal. this key is provided by targetmusic. 											
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $version
     ** The version of the login mechanism to use. Version 1 assumes simple pre-hashed passwords and will be phased out. Version 2 uses a 'seasoned' password. 											
     ** default: 1
     *
     */
    public function userPasswordUpdate($portalID, $userName, $email, $passwordHash, $portalKey, $version = 1) {
        return $this->response($this->get('userPasswordUpdate', array(
            'portalID' => $portalID, 'userName' => $userName, 'email' => $email, 'passwordHash' => $passwordHash, 'portalKey' => $portalKey, 'version' => $version
        )));
    }

    /**
     * @function userPlaylistAlbumAdd
     * Appends all tracks of an album (playlist) to a userPlaylist
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $playListID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function userPlaylistAlbumAdd($userID, $playListID, $userPlaylistID, $portalID) {
        return $this->response($this->get('userPlaylistAlbumAdd', array(
            'userID' => $userID, 'playListID' => $playListID, 'userPlaylistID' => $userPlaylistID, 'portalID' => $portalID
        )));
    }

    /**
     * @function userPlaylistArtistAdd
     * Appends all available tracks of an artist to a userPlaylist
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $artistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function userPlaylistArtistAdd($userID, $artistID, $userPlaylistID, $portalID) {
        return $this->response($this->get('userPlaylistArtistAdd', array(
            'userID' => $userID, 'artistID' => $artistID, 'userPlaylistID' => $userPlaylistID, 'portalID' => $portalID
        )));
    }
    
    /**
     * @function userPlaylistCreate
     * create a new user playlist
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $name
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $public
     ** default: 1
     *
     ** @param type:PDO::PARAM_INT $groupID
     ** default: 1
     *
     */
    public function userPlaylistCreate($userID, $portalID, $name, $public = 1, $groupID = 1) {
        return $this->response($this->get('userPlaylistCreate', array(
            'userID' => $userID, 'portalID' => $portalID, 'name' => $name, 'public' => $public, 'groupID' => $groupID
        )));
    }

    /**
     * @function userPlaylistEdit
     * change a user playlist
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $name
     ** default: none
     *
     ** @param type:PDO::PARAM_BOOL $public
     ** default: 1
     *
     ** @param type:PDO::PARAM_BOOL $active
     *
     ** @param type:PDO::PARAM_INT $groupID
     ** default: 1
     *
     */
    public function userPlaylistEdit($userPlaylistID, $userID, $portalID, $name, $public = 1, $active = 1, $groupID = 1) {
        return $this->response($this->get('userPlaylistEdit', array(
            'userPlaylistID' => $userPlaylistID, 'userID' => $userID, 'portalID' => $portalID, 'name' => $name, 'public' => $public, 'active' => $active, 'groupID' => $groupID
        )));
    }

    /**
     * @function userPlayListGetSimilar
     * gets a list of the 10 most similar playlist based on the tracks in the playlist.
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     */
    public function userPlayListGetSimilar($userPlaylistID, $portalID, $userID) {
        return $this->response($this->get('userPlayListGetSimilar', array(
            'userPlaylistID' => $userPlaylistID, 'portalID' => $portalID, 'userID' => $userID
        )));
    }

    /**
     * @function userPlayListGetTrackSuggestions
     * gets a list of the 10 most similar tracks based on similar playlist content.
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     */
    public function userPlayListGetTrackSuggestions($userPlaylistID, $portalID, $userID) {
        return $this->response($this->get('userPlayListGetTrackSuggestions', array(
            'userPlaylistID' => $userPlaylistID, 'portalID' => $portalID, 'userID' => $userID
        )));
    }

    /**
     * @function userPlaylistGroupCreate
     * create a new playlist group
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $name
     ** default: none
     *
     */
    public function userPlaylistGroupCreate($userID, $portalID, $name) {
        return $this->response($this->get('userPlaylistGroupCreate', array(
            'userID' => $userID, 'portalID' => $portalID, 'name' => $name
        )));
    }

    /**
     * @function userPlaylistPlaylistAdd
     * Appends all the tracks from and existing userPlaylist to a userPlaylist
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $sourcePlayListID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function userPlaylistPlaylistAdd($userID, $sourcePlayListID, $userPlaylistID, $portalID) {
        return $this->response($this->get('userPlaylistPlaylistAdd', array(
            'userID' => $userID, 'sourcePlayListID' => $sourcePlayListID, 'userPlaylistID' => $userPlaylistID, 'portalID' => $portalID
        )));
    }

    /**
     * @function userPlaylistRemove
     * Removes a userPlaylist
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     */
    public function userPlaylistRemove($userID, $userPlaylistID) {
        return $this->response($this->get('userPlaylistRemove', array(
            'userID' => $userID, 'userPlaylistID' => $userPlaylistID
        )));
    }

    /**
     * @function userPlayListRightsCheck
     * returns the rights for a given user on the given playlist, allows you to create shared userPlaylist functionality.
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     */
    public function userPlayListRightsCheck($userPlaylistID, $userID, $portalID) {
        return $this->response($this->get('userPlayListRightsCheck', array(
            'userPlaylistID' => $userPlaylistID, 'userID' => $userID, 'portalID' => $portalID
        )));
    }

    /**
     * @function userPlaylistSubscribe
     * subscribe to a user playlist
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     */
    public function userPlaylistSubscribe($userID, $portalID, $userPlaylistID) {
        return $this->response($this->get('userPlaylistSubscribe', array(
            'userID' => $userID, 'portalID' => $portalID, 'userPlaylistID' => $userPlaylistID
        )));
    }

    /**
     * @function userPlaylistTrackAdd
     * Adds a track to a userPlaylist
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $trackID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $portalID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $position
     ** if set to 0 (the default) the track will be appended to the userList. 											
     ** default: 0
     *
     */
    public function userPlaylistTrackAdd($userID, $trackID, $userPlaylistID, $portalID, $position = 0) {
        return $this->response($this->get('userPlaylistTrackAdd', array(
            'userID' => $userID, 'trackID' => $trackID, 'userPlaylistID' => $userPlaylistID, 'portalID' => $portalID, 'position' => $position
        )));
    }

    /**
     * @function userPlaylistTrackEdit
     * changes the position of a track in a userPlaylist
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $trackID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $position
     ** default: none
     *
     */
    public function userPlaylistTrackEdit($userID, $trackID, $userPlaylistID, $position) {
        return $this->response($this->get('userPlaylistTrackEdit', array(
            'userID' => $userID, 'trackID' => $trackID, 'userPlaylistID' => $userPlaylistID, 'position' => $position
        )));
    }

    /**
     * @function userPlaylistTrackRemove
     * Removes a track from a userPlaylist
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $trackID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     */
    public function userPlaylistTrackRemove($userID, $trackID, $userPlaylistID) {
        return $this->response($this->get('userPlaylistTrackRemove', array(
            'userID' => $userID, 'trackID' => $trackID, 'userPlaylistID' => $userPlaylistID
        )));
    }

    /**
     * @function userPlaylistTruncate
     * Removes all tracks from a userPlaylist
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_INT $userPlaylistID
     ** default: none
     *
     */
    public function userPlaylistTruncate($userID, $userPlaylistID) {
        return $this->response($this->get('userPlaylistTruncate', array(
            'userID' => $userID, 'userPlaylistID' => $userPlaylistID
        )));
    }

    /**
     * @function userSessionCheck
     * checks if the user's session id is still valid
     *
     ** @param type:PDO::PARAM_INT $userID
     ** default: none
     *
     ** @param type:PDO::PARAM_STR $sessionID
     ** default: none
     *
     */
    public function userSessionCheck($userID, $sessionID) {
        return $this->response($this->get('userSessionCheck', array(
            'userID' => $userID, 'sessionID' => $sessionID
        )));
    }


    public function userUpdate($userID, $portalID, $userName, $email, $passwordHash, $orderID, $salt = false, $phoneNr = 0000000000, $version = 1) {
        return $this->response($this->get('userUpdate', array(
            'userID' => $userID, 'portalID' => $portalID, 'userName' => $userName, 'email' => $email, 'passwordHash' => $passwordHash, 'salt' => $salt, 'phoneNr' => $phoneNr, 'orderID' => $orderID, 'version' => $version
        )));
    }

    /**
     * @function Search
     * Perform a fulltext search on the catalog
     * 
     ** @param type:PDO::PARAM_STR $k
     ** The term to search for
     ** default: none
     * 
     ** @param type:PDO::PARAM_STR $sort
     ** Field to sort on
     ** posible sort options are: artist(artist name ASC), title(track title ASC), date(date added DESC), release_date(release date DESC)
     ** default: (sort by relevance)
     * 
     ** @param type:PDO::PARAM_STR $i
     ** The index to query, possible values are: tracks, albums, artists, all
     ** default: tracks
     * 
     ** @param type:PDO::PARAM_INT $n
     ** The number of results to return per page
     ** default: 30
     * 
     ** @param type:PDO::PARAM_INT $o
     ** The offset for the results
     ** default: 0
     * 
     ** @param type:PDO::PARAM_CONST $k
     ** There are the following matching modes available:
     *** all: matches all query words (default mode)
     *** any: matches any of the query words
     *** phrase: matches query as a phrase, requiring perfect match
     *** bool: matches query as a boolean expression
     ** default: all
     */
    public function Search($k, $sort, $i =  "tracks", $n =  30, $o =  0, $mode =  "all") {
        return $this->response($this->get('Search', array(
            'k' => $k, 'i' => $i, 'n' => $n, 'o' => $o, 'sort' => $sort, 'mode' => $mode
        )));
    }

    /**
     * 
     * @param type $trackID
     * @param type $protocol
     * @param type $handler: authReg or preView
     */
    public function streamingURL($trackID, $protocol = 'rtmp', $handler = 'authReg') {
        $server = $this->userGetStreamServer();
        if (empty($server) || !isset($server[0]->hostName))
            return NULL;
        $token = $this->getStreamToken($trackID);
        if (empty($token) || !isset($token[0]->myToken))
            return NULL;
        return $protocol . '://' . $server[0]->hostName . '/' . $handler . '.mp4?svToken=' . $token[0]->myToken . '&sess=' . $this->sessionID;
    }

}
