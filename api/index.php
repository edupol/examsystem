<?php
date_default_timezone_set('Asia/Bangkok');

require 'Slim/Slim.php';
define('REPOSITORY_PATH', dirname(__FILE__) . '/Database/Repository');
require_once (REPOSITORY_PATH . '/Rank.php');
require_once (REPOSITORY_PATH . '/Course.php');
require_once (REPOSITORY_PATH . '/Division.php');
require_once (REPOSITORY_PATH . '/Address.php');
require_once (REPOSITORY_PATH . '/Position.php');
require_once (REPOSITORY_PATH . '/ExamStore.php');
require_once (REPOSITORY_PATH . '/ExamAssignment.php');

header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('X-Content-Type-Options: nosniff');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

//PHP Native Session setting
if (!isset($_SESSION)) {
  session_cache_limiter(false);
  session_start();
}

/**
 * Initialize Cookie Security params
 */
$cookiesSettings = array(
    'cookies.secret_key' => 'edupol',
    'cookies.cipher' => MCRYPT_RIJNDAEL_256,
    'cookies.cipher_mode' => MCRYPT_MODE_CBC
);

$app = new Slim($cookiesSettings);
$app->contentType('application/json');

$rank   	= Rank::getInstance();
$division 	= Division::getInstance();
$address 	= Address::getInstance();
$position  	= Position::getInstance();
$examstore  = ExamStore::getInstance();
$course 	= Course::getInstance();
$examAssignment = ExamAssignment::getInstance();

$app->get('/ranks',array($rank, 'getRanks'));
$app->get('/positions',array($position, 'getPositions'));
$app->get('/division/belongto',array($division, 'getBelongto'));
$app->get('/divisions',array($division, 'getDivisions'));
$app->post('/division/mapping',array($division, 'saveMapping'));
$app->get('/squads',array($address, 'getSquad'));
$app->get('/sections',array($address, 'getSection'));
$app->get('/provinces',array($address, 'getProvinces'));
$app->get('/provinces/:id',array($address, 'getProvincesByDivisionID'));
$app->get('/districts/:id',array($address, 'getDistrictsByID'));
$app->get('/subdistricts/:id',array($address, 'getSubDistrictsByID'));

$app->get('/examstore/history',array( $examstore,'getListOfExams'));
$app->post('/examstore/authen',array( $examstore,'authen'));
$app->post('/examstore/login',array( $examstore,'login'));
$app->post('/examstore/regis',array( $examstore,'regis'));
$app->post('/examstore/username/check',array( $examstore,'checkUsernameAvailable'));
$app->post('/examstore/changepwd',array( $examstore,'changePassword'));
$app->post('/examstore/export',array( $examstore,'export'));
$app->get('/examstore/course',array( $examstore,'getExamCourse'));
$app->get('/examstore/user/id',array( $examstore,'getUserID'));
$app->get('/examstore/groups/:id',array( $examstore,'getExamGroupsByCourseID'));
$app->get('/examstore/exams/:id',array( $examstore,'getExamsByGroupID'));
$app->post('/examstore/random',array( $examstore,'randomExam'));
$app->post('/examstore/load/:id',array( $examstore,'getExamStoreByID'));
$app->post('/examstore/save/:id',array( $examstore,'saveAnswer'));


//Course API
$app->get('/course/place',array( $course, 'getPlaces'));
$app->get('/course/:id',array( $course, 'getCourseByPlaceID'));
$app->get('/course/number/:id',array( $course, 'getCourseNumberByID'));

//Exam assignment API
$app->post('/exam/assignment',array( $examAssignment, 'setAssignments'));

$app->run();

?>