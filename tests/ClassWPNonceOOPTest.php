<?php 
declare(strict_types=1);

require __DIR__ . "/../src/ClassWPNonceOOP.php";

use HelpMeIAmLost\WPNonceOOP\ClassWPNonceOOP;
use PHPUnit\Framework\TestCase;

/**
*  Corresponding Class to test ClassWPNonceOOP class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author Rowen Chumacera
*/
final class ClassWPNonceOOPTest extends TestCase
{
    /**
     * @var
     *
     */
    private $nonceInstance;

    /**
     * Set up test environment
     *
     */
    protected function setUp(): void
    {
        $this->nonceInstance = new ClassWPNonceOOP;
    }

    /**
     * Test #1
     * Check the instance of the ClassWPNonceOOP class
     *
     */
    public function testNonceInstance(): void
    {
        $this->assertInstanceOf(ClassWPNonceOOP::class, $this->nonceInstance);
    }

    /**
     * Test #2
     * Check if the wp_nonce_ays() returns the string value passed to $action
     *
     */
    public function testWPNonceAysOOP() {
        $nonceAys = $this->nonceInstance->wp_nonce_ays($action='log-out');
        $this->assertEquals($action, $nonceAys);
    }
    
    /**
     * Test #3
     * Check if the default values were set correctly in wp_nonce_field()
     *
     */
    public function testDefaultWPNonceFieldOOP() {
        $nonceField = $this->nonceInstance->wp_nonce_field();
        $this->assertEquals('<input type="hidden" id="_wpnonce" name="_wpnonce" value="b192fc4204" /><input type="hidden" name="_wp_http_referer" value="/index.php" />', $nonceField);
    }
    
    /**
     * Test #4
     * Check if the arguments were passed correctly
     * @action   'log-out'
     * @name     'my-nonce'
     * @referer  true
     * @echo     false
     *
     */
    public function testWPNonceFieldOOP1() {
        $nonceField = $this->nonceInstance->wp_nonce_field('log-out', 'my-nonce', true, false);
        $this->assertEquals('<input type="hidden" id="my-nonce" name="my-nonce" value="b192fc4204" /><input type="hidden" name="_wp_http_referer" value="/index.php" />', $nonceField);
    }
    
    /**
     * Test #5
     * Check if the arguments were passed correctly
     * @action   'log-out'
     * @name     'my-nonce'
     * @referer  false
     * @echo     true
     *
     */
    public function testWPNonceFieldOOP2() {
        $nonceField = $this->nonceInstance->wp_nonce_field('log-out', 'my-nonce', false, true);
        $this->assertEquals('<input type="hidden" id="my-nonce" name="my-nonce" value="b192fc4204" />', $nonceField);
    }
    
    /**
     * Test #6
     * Check if the arguments were passed correctly
     * @action   'log-out'
     * @name     'my-nonce'
     * @referer  false
     * @echo     false
     *
     */
    public function testWPNonceFieldOOP3() {
        $nonceField = $this->nonceInstance->wp_nonce_field('log-out', 'my-nonce', false, false);
        $this->assertEquals('<input type="hidden" id="my-nonce" name="my-nonce" value="b192fc4204" />', $nonceField);
    }
    
    /**
     * Test #7
     * Check if the arguments were passed correctly
     * @actionurl  'http://www.hmil.ph/index.php?'
     *
     */
    public function testWPNonceUrlOOP1() {
        $nonceUrl = $this->nonceInstance->wp_nonce_url('http://www.hmil.ph/index.php?');
        $this->assertEquals('http://www.hmil.ph/index.php?_wpnonce=b192fc4204', $nonceUrl);
    }
    
    /**
     * Test #8
     * Check if the arguments were passed correctly
     * @actionurl  'http://www.hmil.ph/index.php?'
     * @action     'log-out'
     * @name       'my-nonce'
     *
     */
    public function testWPNonceUrlOOP2() {
        $nonceUrl = $this->nonceInstance->wp_nonce_url('http://www.hmil.ph/index.php?', 'log-out', 'my-nonce');
        $this->assertEquals('http://www.hmil.ph/index.php?my-nonce=b192fc4204', $nonceUrl);
    }
    
    /**
     * Test #9
     * Check if no nonce can be detected
     *
     */
    public function testWPVerifyNonceOOP1() {
        $nonceVerify = $this->nonceInstance->wp_verify_nonce('');
        $this->assertEquals(false, $nonceVerify);
    }
    
    /**
     * Test #10
     * Check if nonce was 'generated' 0-12 hours ago
     * @nonce  'a192fc4204'
     *
     */
    public function testWPVerifyNonceOOP2() {
        $nonceVerify = $this->nonceInstance->wp_verify_nonce('a192fc4204');
        $this->assertEquals(1, $nonceVerify);
    }
    
    /**
     * Test #11
     * Check if nonce was 'generated' 12-24 hours ago
     * @nonce  'b192fc4204'
     *
     */
    public function testWPVerifyNonceOOP3() {
        $nonceVerify = $this->nonceInstance->wp_verify_nonce('b192fc4204');
        $this->assertEquals(2, $nonceVerify);
    }
    
    /**
     * Test #12
     * Check if the 'correct' nonce is generated
     *
     */
    public function testWPCreateNonceOOP() {
        $nonceCreate = $this->nonceInstance->wp_create_nonce('log-out');
        $this->assertEquals('b192fc4204', $nonceCreate);
    }
    
    /**
     * Test #13
     * Check if nonce was 'generated' 0-12 hours ago
     *
     */
    public function testCheckAdminRefererOOP1() {
        $checkAdminRefer = $this->nonceInstance->check_admin_referer('log-out', 'admin-0-12-nonce');
        $this->assertEquals(1, $checkAdminRefer);
    }
    
    /**
     * Test #14
     * Check if nonce was 'generated' 12-24 hours ago
     *
     */
    public function testCheckAdminRefererOOP2() {
        $checkAdminRefer = $this->nonceInstance->check_admin_referer('log-out', 'admin-12-24-nonce');
        $this->assertEquals(2, $checkAdminRefer);
    }
    
    /**
     * Test #15
     * Check if the invalid nonce is checked by passing no arguments
     *
     */
    public function testCheckAdminRefererOOP3() {
        $checkAdminRefer = $this->nonceInstance->check_admin_referer();
        $this->assertEquals(false, $checkAdminRefer);
    }
    
    /**
     * Test #16
     * Check if nonce was 'generated' 0-12 hours ago
     *
     */
    public function testCheckAjaxRefererOOP1() {
        $checkAjaxRefer = $this->nonceInstance->check_ajax_referer('log-out', 'ajax-0-12-nonce');
        $this->assertEquals(1, $checkAjaxRefer);
    }
    
    /**
     * Test #17
     * Check if nonce was 'generated' 12-24 hours ago
     *
     */
    public function testCheckAjaxRefererOOP2() {
        $checkAjaxRefer = $this->nonceInstance->check_ajax_referer('log-out', 'ajax-12-24-nonce');
        $this->assertEquals(2, $checkAjaxRefer);
    }
    
    /**
     * Test #18
     * Check if the invalid nonce is checked by passing no arguments
     *
     */
    public function testCheckAjaxRefererOOP3() {
        $checkAjaxRefer = $this->nonceInstance->check_ajax_referer();
        $this->assertEquals(false, $checkAjaxRefer);
    }
    
    /**
     * Test #19
     * Check if the referer field is correct without passing an argument (echo on screen)
     *
     */
    public function testWPRefererFieldOOP1() {
        $wpReferField = $this->nonceInstance->wp_referer_field();
        $this->assertEquals('<input type="hidden" name="_wp_http_referer" value="/index.php" />', $wpReferField);
    }

    /**
     * Test #20
     * Check if the referer field is correct while passing an argument (no echo on screen)
     *
     */
    public function testWPRefererFieldOOP2() {
        $wpReferField = $this->nonceInstance->wp_referer_field(false);
        $this->assertEquals('<input type="hidden" name="_wp_http_referer" value="/index.php" />', $wpReferField);
    }
}

/**
 * Dummy functions
 * 
 * @author Rowen Chumacera
 */
function esc_attr($text)
{
    return $text;
}
function esc_html($text)
{
    return $text;
}
function add_query_arg($name, $nonce, $actionurl)
{
    $url = $actionurl . $name . '=' . $nonce;
    return $url;
}
