<?php

/**
 * Class Youtube_Video
 */
class Youtube_Video
{
  CONST YOUTUBE_PARAM_SUBTITLE = 'cc_load_policy';

  CONST YOUTUBE_PARAM_AUTOPLAY = 'autoplay';

  CONST YOUTUBE_PARAM_START    = 'start';

  CONST YOUTUBE_PARAM_THEME    = 'theme';

  CONST THEME_DARK             = 'dark';

  CONST THEME_LIGHT            = 'light';

  /**
   * @var array
   */
  private $_aParams = array();

  /**
   * @param bool $bSubTitle
   * @return $this
   */
  public function SubTitle($bSubTitle)
  {
    $this->_aParams[self::YOUTUBE_PARAM_SUBTITLE] = ($bSubTitle) ? 1 : 0;
    return $this;
  }

  /**
   * @param bool $bAutoplay
   * @return $this
   */
  public function Autoplay($bAutoplay)
  {
    $this->_aParams[self::YOUTUBE_PARAM_AUTOPLAY] = ($bAutoplay) ? 1 : 0;
    return $this;
  }

  /** @var string */
  protected $_sId;

  /**
   * @param string $sId
   * @return $this
   */
  public function SetId($sId)
  {
    $this->_sId = $sId;
    return $this;
  }

  /**
   * @param $iSeconds
   *
   * @return $this
   */

  public function Start($iSeconds)
  {
    if (is_int($iSeconds))
      $this->_aParams[self::YOUTUBE_PARAM_START] = $iSeconds;
    return $this;
  }

  /**
   * @return string
   */
  public function GetId()
  {
    return $this->_sId;
  }

  /**
  * @var int
  */
  private $_iWidth;

  /**
  * @param int $iWidth
  * @return  $this
  */
  public function Width($iWidth)
  {
    $this->_iWidth = $iWidth;
    return $this;
  }

  /**
   * @var int
   */
  private $_iHeight;

  /**
   * @param int $iHeight
   * @return  $this
   */
  public function Height($iHeight)
  {
    $this->_iHeight = $iHeight;
    return $this;
  }

  /**
   * @param $sTheme
   *
   * @return $this
   */

  public function Theme($sTheme)
  {
    if (in_array($sTheme, array(self::THEME_DARK, self::THEME_LIGHT)))
      $this->_aParams[self::YOUTUBE_PARAM_THEME] = $sTheme;

    return $this;
  }

  /**
   * @param string $sYoutubeUrl
   * @return $this
   */
  public function SetIdFromUrl($sYoutubeUrl)
  {
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $sYoutubeUrl, $aMatches)) {
      $this->_sId = $aMatches[1];
      return $this;
    }
    else
      return null;
  }

  /**
   * @param string $sSize
   * @return string
   */
  public function GetThumbnail($sSize = 'full')
  {
    if (!$this->_sId)
      return '';

    $sPath = 'http://img.youtube.com/vi/';

    switch ($sSize) {
      case 'full':
        $sPath .= $this->_sId . '/0.jpg';
        break;
      case 'small':
        $sPath .= $this->_sId . '/1.jpg';
        break;
      case 'hq':
        $sPath .= $this->_sId . '/hqdefault.jpg';
        break;
      case 'sd':
        $sPath .= $this->_sId . '/sddefault.jpg';
        break;
      case 'mq':
        $sPath .= $this->_sId . '/mqdefault.jpg';
        break;
      case 'max':
        $sPath .= $this->_sId . '/maxresdefault.jpg';
        break;
      default:
        $sPath .= $this->_sId . '/default.jpg';
    }

    return $sPath;
  }

  /**
   * @return string
   * @throws Exception
   */
  public function Display()
  {

    if (!$this->_sId)
      throw new Exception('Video Id not defined');

    $sUrl = '//www.youtube.com/embed/' . $this->_sId;

    if (sizeof($this->_aParams) > 0)
      $sUrl .= '?' . http_build_query($this->_aParams);

    $sIframe = '<iframe frameborder="0" ';
    if ($this->_iWidth)
      $sIframe .= 'width="' . $this->_iWidth . '" ';
    if ($this->_iHeight)
      $sIframe .= 'height="' . $this->_iHeight . '" ';

    $sIframe .= 'src="' . $sUrl . '"></iframe>';

    var_dump($sIframe);

    return $sIframe;
  }
}
