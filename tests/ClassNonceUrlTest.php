<?php 
declare(strict_types=1);

require __DIR__ . "/../src/ClassNonceAys.php";
require __DIR__ . "/../vendor/wordpress/wp-blog-header.php";

use HelpMeIAmLost\Nonce\ClassNonceUrl;
use PHPUnit\Framework\TestCase;

/**
*  Corresponding Class to test ClassNonceUrl class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author Rowen Chumacera
*/
final class ClassNonceUrlTest extends TestCase
{
    /**
     * @var
     *
     */
    private $testNonceInstance;

    /**
     * Set up test environment
     *
     */
    protected function setUp(): void
    {
        $this->testNonceInstance = new ClassNonceUrl;
    }

    /**
     * Check the instance of the ClassNonceUrl class
     *
     */
    public function testItem1(): void
    {
        $this->assertInstanceOf(ClassNonceUrl::class, $this->testNonceInstance);
    }

    /**
     * Check the instance of the ClassNonceAys class
     *
     */
    public function testItem2()
    {
        $NonceInstance = $this->testNonceInstance;
        
        sprintf($NonceInstance->wpNonceUrl('http://www.blah.com/', 'Hello World', ''));
        unset($NonceInstance);
    }
}