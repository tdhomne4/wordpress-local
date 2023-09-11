<?php
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/post.php' );
/* Copyright 2018 Amazon.com, Inc. or its affiliates. All Rights Reserved. */
/* Licensed under the Apache License, Version 2.0. */

// Put your Secret Key in place of **********
$cat_array = array('Intel','Amd','Case','Cooler','Desktop Printer','Display Monitor','External Hard Drive','External Speaker','Gaming Chair','Gaming Headset','GPU','HDD','Keyboard','Motherboard Intel','Motherboard Amd','Mouse','ODD','OS','PSU','RAM','Sound Card','SSD','VR Headset');
foreach ($cat_array as $cookie_val) {
    for ($i= 1; $i <=10 ; $i++) { 
        $serviceName="ProductAdvertisingAPI";
        $region="us-east-1";
        $accessKey = get_option( 'amazon_key' );
        $secretKey = get_option( 'secret_key' );
        $parnterTag = get_option( 'partner_tag' );
        // $cookie_val = ucwords($_COOKIE['cron_value']);
        $search_index = 'Electronics';
        $cat_val = $cookie_val;
        if($cookie_val == 'HDD'){
            $pc_cookie_val = 'internal hard drive';
        }else if($cookie_val == 'OS'){
            $pc_cookie_val = 'windows 11 installation disc';
        }else if($cookie_val == 'ODD'){
            $pc_cookie_val = 'desktop internal CD DVD Bluray burner';
        }else if($cookie_val == 'GPU'){
            $pc_cookie_val = 'gaming graphics card';
        }else if($cookie_val == 'Desktop Printer'){
            $pc_cookie_val = 'desktop printer';
        }else if($cookie_val == 'External Speaker'){
            $pc_cookie_val = 'desktop computer speaker studio monitor';
        }else if($cookie_val == 'VR Headset'){
            $pc_cookie_val = 'vr virtual reality headseat';
        }else if($cookie_val == 'PSU'){
            $pc_cookie_val = 'power supply';
        }else if($cookie_val == 'RAM'){
            $pc_cookie_val = 'desktop RAM';
        }else if($cookie_val == 'SSD'){
            $pc_cookie_val = 'ssd internal hard drive';
        }else if($cookie_val == 'Gaming Chair'){
            $pc_cookie_val = 'gaming chair';
        }else if($cookie_val == 'Display Monitor'){
            $pc_cookie_val = 'PC monitor';
            $search_index = 'Computers';
        }else if($cookie_val == 'Cooler'){
            $pc_cookie_val = 'cpu cooler for intel';
        }else if($cookie_val == 'Case'){
            $pc_cookie_val = 'pc case';
        }else if($cookie_val == 'Mouse'){
            $pc_cookie_val = 'PC mouse';
        }else if($cookie_val == 'Keyboard'){
            $pc_cookie_val = 'keyboard and mouse combo';
        }else if($cookie_val == 'Sound Card'){
            $pc_cookie_val = 'sound card for pc';
        }else if($cookie_val == 'External Hard Drive'){
            $pc_cookie_val = 'external hard drive';
        }else if($cookie_val == 'Intel'){
            $pc_cookie_val = 'Intel CPU';
            $cat_val = $cookie_val.' Cpu';
        }else if($cookie_val == 'Amd'){
            $pc_cookie_val = 'amd ryzen processor';
            $cat_val = $cookie_val.' Cpu';
        }else if(strpos( strtolower($cookie_val), 'motherboard' ) !== false){
            $exp_val = explode(" ",$cookie_val);
            $exp_cookie_val = strtolower($exp_val[1]);
            if($exp_cookie_val == 'intel'){
                $pc_cookie_val = 'motherboard for intel';
            }else if($exp_cookie_val == 'amd'){
                $pc_cookie_val = 'AM4 motherboard for amd';
            }
            $cat_val = 'Motherboard';
        }else{
            $pc_cookie_val = $cookie_val.' for Pc';
        }
        $payload="{"
            ." \"Keywords\": \"".$pc_cookie_val."\","
            ." \"Resources\": ["
            ."  \"BrowseNodeInfo.BrowseNodes\","
            ."  \"BrowseNodeInfo.BrowseNodes.Ancestor\","
            ."  \"BrowseNodeInfo.BrowseNodes.SalesRank\","
            ."  \"BrowseNodeInfo.WebsiteSalesRank\","
            ."  \"CustomerReviews.Count\","
            ."  \"CustomerReviews.StarRating\","
            ."  \"Images.Primary.Small\","
            ."  \"Images.Primary.Medium\","
            ."  \"Images.Primary.Large\","
            ."  \"Images.Variants.Small\","
            ."  \"Images.Variants.Medium\","
            ."  \"Images.Variants.Large\","
            ."  \"ItemInfo.ByLineInfo\","
            ."  \"ItemInfo.ContentInfo\","
            ."  \"ItemInfo.ContentRating\","
            ."  \"ItemInfo.Classifications\","
            ."  \"ItemInfo.ExternalIds\","
            ."  \"ItemInfo.Features\","
            ."  \"ItemInfo.ManufactureInfo\","
            ."  \"ItemInfo.ProductInfo\","
            ."  \"ItemInfo.TechnicalInfo\","
            ."  \"ItemInfo.Title\","
            ."  \"ItemInfo.TradeInInfo\","
            ."  \"Offers.Listings.Availability.MaxOrderQuantity\","
            ."  \"Offers.Listings.Availability.Message\","
            ."  \"Offers.Listings.Availability.MinOrderQuantity\","
            ."  \"Offers.Listings.Availability.Type\","
            ."  \"Offers.Listings.Condition\","
            ."  \"Offers.Listings.Condition.ConditionNote\","
            ."  \"Offers.Listings.Condition.SubCondition\","
            ."  \"Offers.Listings.DeliveryInfo.IsAmazonFulfilled\","
            ."  \"Offers.Listings.DeliveryInfo.IsFreeShippingEligible\","
            ."  \"Offers.Listings.DeliveryInfo.IsPrimeEligible\","
            ."  \"Offers.Listings.DeliveryInfo.ShippingCharges\","
            ."  \"Offers.Listings.IsBuyBoxWinner\","
            ."  \"Offers.Listings.LoyaltyPoints.Points\","
            ."  \"Offers.Listings.MerchantInfo\","
            ."  \"Offers.Listings.Price\","
            ."  \"Offers.Listings.ProgramEligibility.IsPrimeExclusive\","
            ."  \"Offers.Listings.ProgramEligibility.IsPrimePantry\","
            ."  \"Offers.Listings.Promotions\","
            ."  \"Offers.Listings.SavingBasis\","
            ."  \"Offers.Summaries.HighestPrice\","
            ."  \"Offers.Summaries.LowestPrice\","
            ."  \"Offers.Summaries.OfferCount\","
            ."  \"ParentASIN\","
            ."  \"RentalOffers.Listings.Availability.MaxOrderQuantity\","
            ."  \"RentalOffers.Listings.Availability.Message\","
            ."  \"RentalOffers.Listings.Availability.MinOrderQuantity\","
            ."  \"RentalOffers.Listings.Availability.Type\","
            ."  \"RentalOffers.Listings.BasePrice\","
            ."  \"RentalOffers.Listings.Condition\","
            ."  \"RentalOffers.Listings.Condition.ConditionNote\","
            ."  \"RentalOffers.Listings.Condition.SubCondition\","
            ."  \"RentalOffers.Listings.DeliveryInfo.IsAmazonFulfilled\","
            ."  \"RentalOffers.Listings.DeliveryInfo.IsFreeShippingEligible\","
            ."  \"RentalOffers.Listings.DeliveryInfo.IsPrimeEligible\","
            ."  \"RentalOffers.Listings.DeliveryInfo.ShippingCharges\","
            ."  \"RentalOffers.Listings.MerchantInfo\","
            ."  \"SearchRefinements\""
            ." ],"
            ." \"ItemPage\": ".$i.","
            ." \"ItemCount\": 100,"
            ." \"Availability\": \"Available\","
            ." \"PartnerTag\": \"".$parnterTag."\","
            ." \"PartnerType\": \"Associates\","
            ." \"Marketplace\": \"www.amazon.com\""
            ."}";
        $host="webservices.amazon.com";
        $uriPath="/paapi5/searchitems";
        $awsv4 = new AwsV4 ($accessKey, $secretKey);
        $awsv4->setRegionName($region);
        $awsv4->setServiceName($serviceName);
        $awsv4->setPath ($uriPath);
        $awsv4->setPayload ($payload);
        $awsv4->setRequestMethod ("POST");
        $awsv4->addHeader ('content-encoding', 'amz-1.0');
        $awsv4->addHeader ('content-type', 'application/json; charset=utf-8');
        $awsv4->addHeader ('host', $host);
        $awsv4->addHeader ('x-amz-target', 'com.amazon.paapi5.v1.ProductAdvertisingAPIv1.SearchItems');
        $headers = $awsv4->getHeaders ();
        $headerString = "";
        foreach ( $headers as $key => $value ) {
            $headerString .= $key . ': ' . $value . "\r\n";
        }
        $params = array (
                'http' => array (
                    'header' => $headerString,
                    'method' => 'POST',
                    'content' => $payload
                )
            );
        $stream = stream_context_create ( $params );

        $fp = @fopen ( 'https://'.$host.$uriPath, 'rb', false, $stream );

        if (! $fp) {
            throw new Exception ( "Exception Occured" );
        }
        $response = @stream_get_contents ( $fp );
        if ($response === false) {
            throw new Exception ( "Exception Occured" );
        }
        $res = json_decode($response);
        $cat_name = $cat_val; // category name we want to assign the post to 
        $taxonomy = 'pc_product_category'; // category by default for posts for other custom post types like woo-commerce it is product_cat
        $append = true ;// true means it will add the cateogry beside already set categories. false will overwrite
        $cat  = get_term_by('name', $cat_name , $taxonomy);
        if($cat == false){
            //cateogry not exist create it 
            $cat = wp_insert_term($cat_name, $taxonomy);
        }

        $items = $res->SearchResult->Items;
        foreach($items as $item){
            $asin = $item->ASIN;
            $image = $item->Images->Primary->Small->URL;
            $brand = $item->ItemInfo->ByLineInfo->Brand->DisplayValue;
            $manufacturer = $item->ItemInfo->ByLineInfo->Manufacturer->DisplayValue;
            $title = $item->ItemInfo->Title->DisplayValue;
            $price = $item->Offers->Listings[0]->Price->Amount;
            $feature = $item->ItemInfo->Features->DisplayValues;
            if(($cookie_val == 'Amd') && (strpos( strtolower($title), 'intel' ) !== false) || ($cookie_val == 'Intel') && (strpos( strtolower($title), 'amd' ) !== false) || ($exp_cookie_val == 'intel') && (strpos( strtolower($title), 'amd' ) !== false) || ($exp_cookie_val == 'amd') && (strpos( strtolower($title), 'intel' ) !== false) || ($cookie_val == 'VR Headset') && (strpos( strtolower($title), 'vr' ) === false) || ($cookie_val == 'VR Headset') && (strpos( strtolower($title), 'virtual reality' ) === false)){
            }else{
                global $wpdb;
                $query = $wpdb->prepare('SELECT ID FROM ' . $wpdb->posts . ' WHERE post_title = %s AND post_type = \'pc_product\'', trim($title));
                $wpdb->query( $query );
                if (post_exists($title)) {
                    if ( $wpdb->num_rows )  {
                        $post_id = $wpdb->get_var( $query );
                        if(!empty($price)){
                            wp_set_object_terms( $post_id, $cat_val, 'pc_product_category', true );
                            update_post_meta($post_id, 'rating', 0);
                            update_post_meta($post_id, 'brand', $brand);
                            update_post_meta($post_id, 'price', $price);
                            update_post_meta($post_id, 'prod_title', $title);
                            update_post_meta($post_id, 'asin', $asin);
                            update_post_meta($post_id, 'feature', $feature);
                            if($cat_val == 'Motherboard'){
                                update_post_meta($post_id,$exp_cookie_val,$exp_cookie_val);
                            }
                        }else{
                            wp_delete_post($post_id, true);
                        }
                    }
                } else {
                    if(!empty($price)){
                         $new_post = array(
                            'post_title'    => trim($title),
                            'post_content'  => '',
                            'post_status'   => 'publish',           // Choose: publish, preview, future, draft, etc.
                            'post_type' => 'pc_product',  //'post',page' or use a custom post type if you want to
                        );
                        $pid = wp_insert_post($new_post);
                        update_post_meta($pid, 'rating', 0);
                        update_post_meta($pid, 'brand', $brand);
                        update_post_meta($pid, 'price', $price);
                        update_post_meta($pid, 'prod_title', $title);
                        update_post_meta($pid, 'asin', $asin);
                        update_post_meta($pid, 'feature', $feature);
                        wp_set_object_terms( $pid, $cat_val, 'pc_product_category', true );
                        $img = media_sideload_image( $image, $pid);//download image to wpsite from url
                        $img = explode("'",$img)[1];// extract http.... from <img src'http...'>
                        $attId = attachment_url_to_postid($img);//get id of downloaded image
                        set_post_thumbnail( $pid, $attId );//set the given image as featured image for the post
                        if($cat_val == 'Motherboard'){
                            update_post_meta($pid, $exp_cookie_val,$exp_cookie_val);
                        }
                    }
                }
            }
        }
    }
}

class AwsV4 {

    private $accessKey = null;
    private $secretKey = null;
    private $path = null;
    private $regionName = null;
    private $serviceName = null;
    private $httpMethodName = null;
    private $queryParametes = array ();
    private $awsHeaders = array ();
    private $payload = "";

    private $HMACAlgorithm = "AWS4-HMAC-SHA256";
    private $aws4Request = "aws4_request";
    private $strSignedHeader = null;
    private $xAmzDate = null;
    private $currentDate = null;

    public function __construct($accessKey, $secretKey) {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
        $this->xAmzDate = $this->getTimeStamp ();
        $this->currentDate = $this->getDate ();
    }

    function setPath($path) {
        $this->path = $path;
    }

    function setServiceName($serviceName) {
        $this->serviceName = $serviceName;
    }

    function setRegionName($regionName) {
        $this->regionName = $regionName;
    }

    function setPayload($payload) {
        $this->payload = $payload;
    }

    function setRequestMethod($method) {
        $this->httpMethodName = $method;
    }

    function addHeader($headerName, $headerValue) {
        $this->awsHeaders [$headerName] = $headerValue;
    }

    private function prepareCanonicalRequest() {
        $canonicalURL = "";
        $canonicalURL .= $this->httpMethodName . "\n";
        $canonicalURL .= $this->path . "\n" . "\n";
        $signedHeaders = '';
        foreach ( $this->awsHeaders as $key => $value ) {
            $signedHeaders .= $key . ";";
            $canonicalURL .= $key . ":" . $value . "\n";
        }
        $canonicalURL .= "\n";
        $this->strSignedHeader = substr ( $signedHeaders, 0, - 1 );
        $canonicalURL .= $this->strSignedHeader . "\n";
        $canonicalURL .= $this->generateHex ( $this->payload );
        return $canonicalURL;
    }

    private function prepareStringToSign($canonicalURL) {
        $stringToSign = '';
        $stringToSign .= $this->HMACAlgorithm . "\n";
        $stringToSign .= $this->xAmzDate . "\n";
        $stringToSign .= $this->currentDate . "/" . $this->regionName . "/" . $this->serviceName . "/" . $this->aws4Request . "\n";
        $stringToSign .= $this->generateHex ( $canonicalURL );
        return $stringToSign;
    }

    private function calculateSignature($stringToSign) {
        $signatureKey = $this->getSignatureKey ( $this->secretKey, $this->currentDate, $this->regionName, $this->serviceName );
        $signature = hash_hmac ( "sha256", $stringToSign, $signatureKey, true );
        $strHexSignature = strtolower ( bin2hex ( $signature ) );
        return $strHexSignature;
    }

    public function getHeaders() {
        $this->awsHeaders ['x-amz-date'] = $this->xAmzDate;
        ksort ( $this->awsHeaders );

        // Step 1: CREATE A CANONICAL REQUEST
        $canonicalURL = $this->prepareCanonicalRequest ();

        // Step 2: CREATE THE STRING TO SIGN
        $stringToSign = $this->prepareStringToSign ( $canonicalURL );

        // Step 3: CALCULATE THE SIGNATURE
        $signature = $this->calculateSignature ( $stringToSign );

        // Step 4: CALCULATE AUTHORIZATION HEADER
        if ($signature) {
            $this->awsHeaders ['Authorization'] = $this->buildAuthorizationString ( $signature );
            return $this->awsHeaders;
        }
    }

    private function buildAuthorizationString($strSignature) {
        return $this->HMACAlgorithm . " " . "Credential=" . $this->accessKey . "/" . $this->getDate () . "/" . $this->regionName . "/" . $this->serviceName . "/" . $this->aws4Request . "," . "SignedHeaders=" . $this->strSignedHeader . "," . "Signature=" . $strSignature;
    }

    private function generateHex($data) {
        return strtolower ( bin2hex ( hash ( "sha256", $data, true ) ) );
    }

    private function getSignatureKey($key, $date, $regionName, $serviceName) {
        $kSecret = "AWS4" . $key;
        $kDate = hash_hmac ( "sha256", $date, $kSecret, true );
        $kRegion = hash_hmac ( "sha256", $regionName, $kDate, true );
        $kService = hash_hmac ( "sha256", $serviceName, $kRegion, true );
        $kSigning = hash_hmac ( "sha256", $this->aws4Request, $kService, true );

        return $kSigning;
    }

    private function getTimeStamp() {
        return gmdate ( "Ymd\THis\Z" );
    }

    private function getDate() {
        return gmdate ( "Ymd" );
    }
}
?>