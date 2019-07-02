<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//      if(!(isset($this->load->session('userdata')))) exit("Please Sign in");
require __DIR__ . '/vendor/autoload.php';

define('APPLICATION_NAME', 'Google Calendar API PHP Quickstart');
define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/calendar-php-quickstart.json
define('SCOPES', implode(' ', array(
  Google_Service_Calendar::CALENDAR)
));


class CalendarAuth extends MX_Controller
{
    
function __construct() {
parent::__construct();
}
function index(){
    
    if(!(isset($_GET['code']))){
        $this->load->module("Main_template");
        $data['view_file'] = 'calendar_view';
        $this->main_template->index($data);
    }else{
        $client = $this->makeClient();
        $accessToken = $client->authenticate($_GET['code']);
        $this->session->set_userdata('access_token', $accessToken);
//        echo "Access token : " . $this->session->userdata('access_token');
//        die();
        $client = $this->getClient($accessToken, $client);
        $this->auth($client);
    }
}

function makeClient(){
    $client = new Google_Client();
    $client->setApplicationName(APPLICATION_NAME);
    $client->setScopes(SCOPES);
    $client->setAuthConfigFile(CLIENT_SECRET_PATH);
    $client->setAccessType('offline');  
    return $client;
}

function authorize(){
  $credentialsPath = $this->expandHomeDirectory(CREDENTIALS_PATH);
  if (file_exists($credentialsPath)) {  
    $client = $this->makeClient();  
    $accessToken = file_get_contents($credentialsPath);
    if($accessToken != $this->session->userdata('access_token')){
        $client = new Google_Client();
        $client->setScopes(SCOPES);
        $client->setAuthConfigFile(CLIENT_SECRET_PATH);
        // Request authorization from the user.
        $authUrl = $client->createAuthUrl();
        header('Location:'.$authUrl);
        die();
    }else{
        $client = $this->getClient($accessToken, $client);
        return $client;
    }
    

  } else {
    
    $client = new Google_Client();
    $client->setScopes(SCOPES);
    $client->setAuthConfigFile(CLIENT_SECRET_PATH);
    // Request authorization from the user.
    $authUrl = $client->createAuthUrl();
    header('Location:'.$authUrl);
    die();
  }
}

function getClient($accessToken, $client) {
    
    $client = $this->makeClient();
    
    $credentialsPath = $this->expandHomeDirectory(CREDENTIALS_PATH);
    // Store the credentials to disk.
    if(!file_exists(dirname($credentialsPath))) {
      mkdir(dirname($credentialsPath), 0700, true);
    }
    file_put_contents($credentialsPath, $accessToken);
    printf("Credentials saved to %s\n", $credentialsPath);
    $client->setAccessToken($accessToken);
    
  // Refresh the token if it's expired.
  if ($client->isAccessTokenExpired()) {
    $client->refreshToken($client->getRefreshToken());
    file_put_contents($credentialsPath, $client->getAccessToken());
  }
  return $client;
}

/**
 * Expands the home directory alias '~' to the full path.
 * @param string $path the path to expand.
 * @return string the expanded path.
 */
function expandHomeDirectory($path) {
  $homeDirectory = getenv('HOME');
  if(empty($homeDirectory)) {
    $homeDirectory = getenv("HOMEDRIVE") . getenv("HOMEPATH");
  }
  return str_replace('~', realpath($homeDirectory), $path);
}

function auth($client = ''){
    // Get the API client and construct the service object.
    
        
        $client = $this->authorize();
    
        
        
        $service = new Google_Service_Calendar($client);


        $calendarId = 'primary';
            $optParams = array(
              'maxResults' => 10,
              'orderBy' => 'startTime',
              'singleEvents' => TRUE,
              'timeMin' => date('c'),
            );
            $results = $service->events->listEvents($calendarId, $optParams);

            if (count($results->getItems()) == 0) {

            die('No upcoming Evens');
              } else {
//                $this->load->module("Main_template");
//                $data['view_file'] = 'events_view';
//                $data['events'] = $results->getItems();
//                $this->main_template->index($data);  
//

                print "Upcoming events:\n";
                foreach ($results->getItems() as $event) {
                  $start = $event->start->dateTime;
                  if (empty($start)) {
                    $start = $event->start->date;
                  }
                  printf("%s (%s)\n", $event->getSummary(), $start);
                }
            }
    
    
    
    
}



}
