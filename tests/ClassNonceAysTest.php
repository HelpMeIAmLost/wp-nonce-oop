<?php 
declare(strict_types=1);

require __DIR__ . "/../src/ClassNonceAys.php";
require __DIR__ . "/../vendor/wordpress/wp-blog-header.php";
//require_once __DIR__ . "/../vendor/wordpress/index.php";
//require( dirname( __FILE__ ) . '/../vendor/wordpress/index.php' );
//require( dirname( __FILE__ ) . '/../vendor/wordpress/wp-blog-header.php' );

use HelpMeIAmLost\Nonce\ClassNonceAys;
use PHPUnit\Framework\TestCase;

/**
*  Corresponding Class to test ClassNonceAys class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author Rowen Chumacera
*/
final class ClassNonceAysTest extends TestCase
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
        $this->testNonceInstance = new ClassNonceAys;
    }

    /**
     * Check the instance of the ClassNonceAys class
     *
     */
    public function testItem1(): void
    {
        $this->assertInstanceOf(ClassNonceAys::class, $this->testNonceInstance);
    }

    /**
     * Check the instance of the ClassNonceAys class
     *
     */
    public function testItem2()
    {
        $NonceInstance = $this->testNonceInstance;
        
        sprintf( $NonceInstance->wpNonceAys('log-out'));
        //unset($NonceInstance);
    }
}