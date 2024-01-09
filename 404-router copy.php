<?php
//010524
//404 router
//this is middleware for 404 response to check for and resolve known uri errors
include '../includes.php';
//header() fails if there are any echo statements in the code. Adding ob_start() at the top of the file fixes this error. 
ob_start();

//get the slug list from text file as string
$postRouteText = file_get_contents('./postRoute.txt');
//convert slug list string into array
$postRouteArray = explode(',', $postRouteText);

$pageRouteText = file_get_contents('./pageLinks.txt');

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
} elseif ($slugMatch == "products/beginners-guide-to-family-law-a-simplified-path-to-parental-rights") {
    $newLink = "https://www.fixfamilycourts.com/child-custody-books/bgfl-beginners-guide-to-family-law/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "products/motions-package-1") {
    $newLink = "https://www.fixfamilycourts.com/products#motions";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "products/membership") {
    $newLink = "https://www.fixfamilycourts.com/membership/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "contact") {
    $newLink = "https://www.fixfamilycourts.com/about-us-pages/contact/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "products/not-in-the-childs-best-interest") {
    $newLink = "https://www.fixfamilycourts.com/child-custody-books/nicbi-not-in-the-childs-best-interest/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "products/protecting-parent-child-bonds") {
    $newLink = "https://www.fixfamilycourts.com/child-custody-books/ppcb-protecting-parent-child-bonds/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "home") {
    $newLink = "https://www.fixfamilycourts.com";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "rights-made-simple") {
    $newLink = "https://www.fixfamilycourts.com/pro-se-resources/rights-made-simple/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "subscribe") {
    $newLink = "https://www.fixfamilycourts.com/about-us-pages/subscribe/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/daily-tool-sapcr-amendment-adding-protection-for-your-rights-into-your-pleadings/parents-need-real-time-with-their-child-telegraph-2") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/daily-tool-sapcr-amendment-adding-protection-for-your-rights-into-your-pleadings/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/daily-tool-sapcr-amendment-adding-protection-for-your-rights-into-your-pleadings/sapcr-rights-protection-amendment-20150310") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/daily-tool-sapcr-amendment-adding-protection-for-your-rights-into-your-pleadings/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/daily-tool-sapcr-amendment-adding-protection-for-your-rights-into-your-pleadings/sapcr-rights-protection-language-pdf-20150310-v-1-2") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/daily-tool-sapcr-amendment-adding-protection-for-your-rights-into-your-pleadings/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/daily-tool-can-the-majority-vote-to-have-your-constitutional-rights-ignored/mb-in-smokies-ffc-alumna-text") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/daily-tool-can-the-majority-vote-to-have-your-constitutional-rights-ignored/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/dadication-video/www.fixfamilycourts.com/membership") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/dadication-video/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/how-to-demand-protection-of-your-legal-rights-in-separation/products") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/how-to-demand-protection-of-your-legal-rights-in-separation/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/how-to-demand-protection-of-your-legal-rights-in-separation/membership") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/how-to-demand-protection-of-your-legal-rights-in-separation/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "texas-parents-taking-fight-to-state-capitol-through-the-telephone-are-making-an-impact/rep-james-white") {
    $newLink = "https://www.fixfamilycourts.com/texas-parents-taking-fight-to-state-capitol-through-the-telephone-are-making-an-impact/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/daily-tool-testifying-before-a-legislative-committee/picture-fathers-and-ron-and-sherry-w-gilbert-pena-2015-april-15-capitol") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/daily-tool-testifying-before-a-legislative-committee/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "update-on-the-texas-equal-parenting-bill-hb2363/harold-dutton-2-0") {
    $newLink = "https://www.fixfamilycourts.com/update-on-the-texas-equal-parenting-bill-hb2363/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "update-on-the-texas-equal-parenting-bill-hb2363/gilbert-pena-2-0") {
    $newLink = "https://www.fixfamilycourts.com/update-on-the-texas-equal-parenting-bill-hb2363/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/daily-tool-support-webinars-for-parents-that-make-a-difference/sherry-2015-march-are-you-getting-results") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/daily-tool-support-webinars-for-parents-that-make-a-difference/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/daily-tool-what-if-my-judge-does-not-believe-in-equal-shared-parenting/fidler-kids-w-fixfamilycourts") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/daily-tool-what-if-my-judge-does-not-believe-in-equal-shared-parenting/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/daily-tool-how-does-the-family-court-process-hurt-families-webinar/sherry-and-megan-jpg1-lab-smile-w-text-2014") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/daily-tool-how-does-the-family-court-process-hurt-families-webinar/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/daily-tool-storing-and-sharing-your-evidence/basecamp") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/daily-tool-storing-and-sharing-your-evidence/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/daily-tool-resources-for-co-parenting-and-strengthening-families/tayla-andre-w-radio-logo") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/daily-tool-resources-for-co-parenting-and-strengthening-families/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

} elseif ($slugMatch == "divorce-child-custody-blog/daily-tool-testifying-before-a-legislative-committee/cbs-rustin-wright-texas-fathers-rights-legislative-fight-2015-april-15") {
    $newLink = "https://www.fixfamilycourts.com/divorce-child-custody-blog/daily-tool-testifying-before-a-legislative-committee/";
    header("Location: " . $newLink, TRUE, 301);
    exit;

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