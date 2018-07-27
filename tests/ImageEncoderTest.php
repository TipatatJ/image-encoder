<?php

use JB\ImageEncoder;
use PHPUnit\Framework\TestCase;


final class ImageEncoderTest extends TestCase {

  public function testImageCanBeRetrievedFromUrl() {
    $test_image = 'images/1px-white.gif';
    $remote_image = 'https://www.sportspower.com.au/1px-white.gif';

    $retrieved_local_image = file_get_contents($test_image);
    $retrieved_remote_image = ImageEncoder::get_image($remote_image);

    $this->assertEquals( $retrieved_local_image, $retrieved_remote_image);
  }


  public function testReturnsUrlWhenCanNotBeEncoded() {
    $failed_test_image = 'https://www.sportspower.com.au/non-existant.gif';

    $attempted_data_uri = ImageEncoder::to_data_uri($failed_test_image);
    $this->assertEquals( $failed_test_image, $attempted_data_uri);
  }


  public function testCanReturnSuccessfulDataUri() {
    $test_image = 'https://www.sportspower.com.au/1px-white.gif';
    $data_uri = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';

    $attempted_data_uri = ImageEncoder::to_data_uri($test_image);

    $this->assertEquals( $data_uri, $attempted_data_uri );
  }
}
