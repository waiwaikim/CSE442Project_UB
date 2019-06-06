<?php declare(strict_types=1); include('../CSE442Project/src/Util.php'); ?>
<?php
  
  use PHPUnit\Framework\TestCase;

  final class UtilTest extends TestCase {
    public function testCanAcceptValidEmail() {
      $this->assertTrue(Util::is_valid_email('jmsiegel@buffalo.edu'));
      $this->assertTrue(Util::is_valid_email('gggggggg@buffalo.edu'));
    }
    public function testCanRejectInvalidEmail() {
      $this->assertFalse(Util::is_valid_email('jmsiegel@gmail.com'));
      $this->assertFalse(Util::is_valid_email('jmsiegel'));
      $this->assertFalse(Util::is_valid_email('@buffalo.edu'));
      $this->assertFalse(Util::is_valid_email('jms@buffalo.edu'));
    }
  }
?>