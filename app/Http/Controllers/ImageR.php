<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\Rekognition\RekognitionClient;
class ImageR extends Controller
{
    public function comparacion()
    {
      $options = [
       'region' => 'us-west-2',
        'version' => 'latest',
        'credentials' => [
          'key' => 'AKIAINBMC4KS5YVYWSPQ',
          'secret' => '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',
        ]
      ];

      $rekognition = new RekognitionClient($options);

      // Get local image
     $photo = '/Users/jessjaime/Trabajo/img/app/Http/Controllers/d1.jpg';
     $photo1 = '/Users/jessjaime/Trabajo/img/app/Http/Controllers/d2.jpg';
     $fp_image = fopen($photo, 'r');
     $fp_image1 = fopen($photo1, 'r');
     $image = fread($fp_image, filesize($photo));
     $image1 = fread($fp_image1, filesize($photo1));

     fclose($fp_image);
     fclose($fp_image1);


      $compareFaceResults= $rekognition->compareFaces([
        'SimilarityThreshold' => 80,
        'SourceImage' => [
            'Bytes' => $image
        ],
        'TargetImage' => [
            'Bytes' => $image1
        ],
      ]);

      $FaceMatchesResult = $compareFaceResults['FaceMatches'];
      dd($FaceMatchesResult);
      return view('welcome');
    }
}
