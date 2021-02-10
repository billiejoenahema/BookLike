<?php

namespace App\Models;

use Exception;
use App\Models\AwsV4;

/* Copyright 2018 Amazon.com, Inc. or its affiliates. All Rights Reserved. */
/* Licensed under the Apache License, Version 2.0. */

class SearchItems {

    public function getSearchItems($keyword) {

        $partner_tag = config('pa-api.partner_tag');
        $accessKey=config('pa-api.access_key');
        $secretKey=config('pa-api.secret_key');
        $serviceName="ProductAdvertisingAPI";
        $region="us-west-2";
        $payload="{"
            ." \"Keywords\": \"$keyword\","
            ." \"Resources\": ["
            ."  \"Images.Primary.Large\","
            ."  \"ItemInfo.ByLineInfo\","
            ."  \"ItemInfo.Title\""
            ." ],"
            ." \"SearchIndex\": \"Books\","
            ." \"PartnerTag\": \"$partner_tag\","
            ." \"PartnerType\": \"Associates\","
            ." \"Marketplace\": \"www.amazon.co.jp\""
            ."}";
            $host="webservices.amazon.co.jp";
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
            throw new \Exception ( "Exception Occured" );
        }
        $response = @stream_get_contents ( $fp );
        if ($response === false) {
            throw new \Exception ( "Exception Occured" );
        }
        // echo $response;

        // json形式からオブジェクトへ変換
        $results = json_decode($response);
        if (property_exists($results, 'Errors')) {
            return null;
        }
        $items = $results->SearchResult->Items;

        return $items;
    }

}
