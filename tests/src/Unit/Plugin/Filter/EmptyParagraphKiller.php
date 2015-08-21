<?php

/**
 * @file
 * Contains \Drupal\emptyparagraphkiller\Unit\Plugin\Filter\EmptyParagraphKiller.
 */

namespace Drupal\emptyparagraphkiller\Unit\Plugin\Filter;

use Drupal\Tests\UnitTestCase;

class EmptyParagraphKiller extends UnitTestCase {

  /**
    * @dataProvider providerTestFilter
    */
  public function testFilter($value, $expected) {
    $filter = new \Drupal\emptyparagraphkiller\Plugin\Filter\EmptyParagraphKiller([], 'emptyparagraphkiller', [
      'provider' => 'emptyparagraphkiller',
    ]);
    $this->assertEquals($expected, $filter->process($value, 'en')->getProcessedText());
  }

  public function providerTestFilter() {
    return [
      ['Hello World', 'Hello World'],
      ['<p></p>', ''],
      ['<p>   </p>', ''],
      ['<p>   </p><p></p>', ''],
      ['<p>&nbsp;</p>', ''],
      ["<h1>test</h1>\n<p>&nbsp;</p>", "<h1>test</h1>\n"],
      ['<p>foo</p><p>bar</p>', '<p>foo</p><p>bar</p>'],
      ["<p>\n</p>", ''],
      ["<p>\n&nbsp;</p>", ''],
    ];
  }

}
