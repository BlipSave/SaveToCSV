<?PHP
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
//error_reporting(E_ALL);
error_reporting(0);
import_request_variables("gP", "var_");

Include "Blipfoto/Traits/Helper.php";
Include "Blipfoto/Exceptions/BaseException.php";
Include "Blipfoto/Exceptions/OAuthException.php";
Include "Blipfoto/Exceptions/ApiResponseException.php";
Include "Blipfoto/Exceptions/InvalidResponseException.php";
Include "Blipfoto/Exceptions/NetworkException.php";
Include "Blipfoto/Api/Client.php";
Include "Blipfoto/Api/Response.php";
Include "Blipfoto/Api/OAuth.php";
Include "Blipfoto/Api/Request.php";
use Blipfoto\Api\Client;
Include "user_details.php";

$client = new Client($Client_ID, $Client_Secret);
$client->accessToken($Your_access_token);

$maxPerPageAPI = 200;
$importTotal = 0;
$maxNew = 3800;



$i = 0;

$userEntries = $client->get('user/profile', [
	'return_details' => 1,
]);
$totalImages = $userEntries->data('details.entry_total');
//	$totalImages = '10';
	
$maxPerPageAPI = min($maxPerPageAPI,$totalImages);
/*** Calculate number of pages needed to loop though in API ***/
$pagesNeeded = ceil($totalImages/$maxPerPageAPI);
/*** Set starting page ***/
$page = $var_page;

echo "CSV GENERATED - RIGHT CLICK AND SELECT VIEW SOURCE TO SEE THE CSV FILE CONTENTS";
echo "
<!--_________COPY BELOW THIS LINE_________________
";

echo "Username, date, title, description, tags, lat, lon
";
while($page < $pagesNeeded) {

	/*** Calculate how many images to call on current page ***/
	if ($page <= $pagesNeeded) {
		$pageSizeImageCount = $maxPerPageAPI;
	} else {
		$pageSizeImageCount = $totalImages-($pagesNeeded*$maxPerPageAPI);   
	}
   
	/*** Get entry list ***/
	$userResponse = $client->get('entries/journal', [
		'page_size' => $pageSizeImageCount,
		'page_index' => $page,
	]);
	//    var_dump($userResponse->data());
	$entries = $userResponse->data('entries');
	unset($urls);
	/*** Loop though all entries ***/
	foreach ($entries as $entry) {
			  
		if ($importTotal < $maxNew) {
				$entryResponse = $client->get('entry', [
					'entry_id' => $entry['entry_id_str'],
					'return_details' => '1',
				]);
				echo "\"".htmlspecialchars($entry['username'],ENT_QUOTES)."\",";
				echo "\"".htmlspecialchars($entry['date'],ENT_QUOTES)."\",";
				echo "\"".htmlspecialchars($entry['title'],ENT_QUOTES)."\",";
				echo "\"".htmlspecialchars($entryResponse->data('details.description'),ENT_QUOTES)."\",";
				echo "\"".htmlspecialchars($entryResponse->data('details.tags'),ENT_QUOTES)."\",";
				echo "\"".htmlspecialchars($entryResponse->data('location.lat'),ENT_QUOTES)."\",";
				echo "\"".htmlspecialchars($entryResponse->data('location.lon'),ENT_QUOTES)."\"
";
		}
	}
	$page++;
}
?>
