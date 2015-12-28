# youtube-tools

Youtube Tools help you to create an iframe with a youtube player.

## Usage

 * require_once 'youtube-tools/video.php';
 * $oVideo = new Youtube_Video();
 * $oVideo->SetIdFromUrl('https://www.youtube.com/watch?v=xxxxxxxxxxx');
 * echo $oVideo->Display();

## Available Method

 * SetId (Set the Id of the video)
 * SetIdFromUrl (Set the Id of the video directly from an youtube url)
 * Subtitle (Force displaying of the subtitle)
 * Autoplay (Autoplay the video)
 * Width (Set the width of the iframe)
 * Height (Set the height of the iframe)
 * Theme (Change theme of the player "dark" or "light")
 * GetThumbnail (return the url of a thumbnail)
 * GetId (return current video Id)
