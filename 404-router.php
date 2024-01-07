<?php
//010524
//404 router
//this is middleware for 404 response to check for and resolve known uri errors
include '../includes.php';
//header() fails if there are any echo statements in the code. Adding ob_start() at the top of the file fixes this error.
ob_start();

//get the slug list from text file as string
$routeText = file_get_contents('./postRoute.txt');
//convert slug list string into array
$postRouteArray = explode(',', $routeText);

$domain       = "https://www.fixfamilycourts.com/"; //domain where routing exists
$image_domain = "https://images.fixfamilycourts.com"; //location of image files
$failUrl      = `$domain . "404.html"`; //link to final 404 page


$uri  = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL); //get and sanitize request_uri from server
$host = filter_var($_SERVER['HTTP_HOST'], FILTER_SANITIZE_URL); //get and sanitize request_uri from server

//boolean does $uri start with '/wp-content/uploads'
$wpUploads = (substr($uri, 0, 19) == '/wp-content/uploads') ? TRUE : FALSE;

//boolean does $uri start with '/wp-content'
$wpContent = (substr($uri, 0, 11) == '/wp-content') ? TRUE : FALSE;

//reroute recognized blog slugs to blog directory
//postRoute.txt contains all slubs built from mongodb
$slugMatch = ltrim($uri, '/'); // removes "/" at beginning of string
$slugMatch = rtrim($slugMatch, '/'); //removes "/" at end of string if exists
foreach ($postRouteArray as $v) {
    if ($v == $slugMatch) {
        $postReRoute = "https://www.fixfamilycourts.com/divorce-child-custody-blog/" . $slugMatch . "/";
        $headers     = @get_headers($postReRoute);
        if ($headers && strpos($headers[0], '200')) {
            header("Location: " . $postReRoute, TRUE, 301);
            exit;
        }
    }
}

//if ($third_date === "/wp-content/uploads") {
if ($wpUploads == TRUE) {
    $uriRemoveWpUploads = substr($uri, 19);
    $image_url          = $image_domain . $uriRemoveWpUploads;
    $headers            = @get_headers($image_url);

    //if $image_url resolves then redirect
    if ($headers && strpos($headers[0], '200')) {
        header("Location: " . $image_url, TRUE, 301);
        exit;
    }
} elseif ($wpContent == TRUE) {
    $uriRemoveWpContent = substr($uri, 11);
    $image_url          = $image_domain . $uriRemoveWpContent;
    $headers            = @get_headers($image_url);

    //if $image_url resolves then redirect
    if ($headers && strpos($headers[0], '200')) {
        header("Location: " . $image_url, TRUE, 301);
        exit;
    }
} else {
    // If all previous processing fails, dump to 404.html page
    header("Location:" . $failUrl);
    echo "header didn't reroute";
}

//default html to display
//also contains troubleshooting feedback that needs to be commented out.
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- //comment out this reroute meta tag for troubleshooting. -->
    <meta http-equiv="Refresh" content="0; url='https://www.fixfamilycourts.com/404.html'" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>My Website</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
</head>

<body>
    <main>
        <div>
            <h1>404 Router Error</h1>
            <p>If you reached this page, something unforseen happened. Please go back to <a
                    href="https://www.fixfamilycourts.com">Fix Family Courts Home Page</a></p>
            <p>--- If you see anything below this line, please disregard. ---</p>
        </div>
    </main>
</body>
<style>
    body {
        margin: auto;
    }

    main {
        margin: auto;
        display: flex;
        justify-content: center;
    }
</style>

</html>
