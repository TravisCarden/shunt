<?php

/**
 * @file
 * Contains \Drupal\shuntexample\Tests\ShuntexampleTest.
 */

namespace Drupal\shuntexample\Tests;

use Drupal\shunt\Entity\Shunt;
use Drupal\simpletest\WebTestBase;

/**
 * Tests Shunt Example module.
 */
class ShuntexampleTest extends WebTestBase {

  /**
   * The Shunt Example page path.
   */
  const PAGE_PATH = 'shuntexample';

  /**
   * The Shunt Example shunt ID.
   */
  const SHUNT_ID = 'shunt_example';

  /**
   * {@inheritdoc}
   */
  public static $modules = array('shunt', 'shuntexample');

  /**
   * A user object with permission to administer shunts.
   *
   * @var \Drupal\user\Entity\User
   */
  protected $privilegedUser;

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => 'Shunt Example',
      'description' => 'Tests the Shunt Example module.',
      'group' => 'Shunt',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
    user_role_change_permissions(DRUPAL_ANONYMOUS_RID, array('access content' => TRUE));
  }

  /**
   * Tests the Shunt Example page.
   */
  public function testShuntExamplePage() {
    $this->drupalGet($this::PAGE_PATH);
    $this->assertTitle('Hello world! | Drupal', 'Displayed default page title.');
    $this->assertText('Enable the "shunt_example" shunt to make this page fail gracefully.', 'Displayed default page content.');

    Shunt::load($this::SHUNT_ID)->enableShunt();
    $this->drupalGet($this::PAGE_PATH);
    $this->assertTitle('Fail whale! | Drupal', 'Changed page title based on shunt status.');
    $this->assertText('Disable the "shunt_example" shunt to restore this page.', 'Changed page content based on shunt status.');
  }

}
