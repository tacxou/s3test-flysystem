<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
ini_set("error_reporting", -1);

use Aws\S3\S3Client;
use League\Flysystem\Adapter\Local;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

$root = dirname(__DIR__, 2);

/** @noinspection PhpIncludeInspection */
include $root . '/vendor/autoload.php';

$client = new S3Client([
    'credentials' => [
        'key'    => 'xxxxxx',
        'secret' => 'xxxxxxx',
    ],
    'region' => 'fr-par',
    'version' => 'latest',
    'endpoint' => 'https://s3.fr-par.scw.cloud',
]);

$adapter = new AwsS3Adapter($client, 'tarte');
$adapter2 = new Local($root . '/dir');
$filesystem = new Filesystem($adapter);

//$cat = $filesystem->listContents("eeee");
$res = $filesystem->('rt');
///** @var \League\Flysystem\File $file */
//$file = $filesystem->get($cat['path']);
//$file = $filesystem->put(
//    '/eeee/tartine.json',
//    file_get_contents($root . '/composer.json'),
//    [
//        'Metadata' => [
//            'unjour' => "en france"
//        ]
//    ]
//);

die(var_dump($res));

//die(var_dump($filesystem->listContents("/")));

//die(
//    var_dump(
//        $file->getMetadata()
//    )
//);
