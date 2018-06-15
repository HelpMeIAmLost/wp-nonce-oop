<?php
declare(strict_types=1);

/**
 * Class implementation of wp_nonce_ays()
 *
 * Use this section to define what this class is doing, the PHPDocumentator will use this
 * to automatically generate an API documentation using this information.
 *
 * @author  Rowen Chumacera
 * @package HelpMeIAmLost\wp-nonce-oop
 */
namespace HelpMeIAmLost\Nonce;

//require_once __DIR__ . "/../vendor/wordpress/wp-includes/formatting.php";
//require_once __DIR__ . "/../vendor/wordpress/wp-includes/l10n.php";
//require_once __DIR__ . "/../vendor/wordpress/wp-includes/option.php";
//require_once __DIR__ . "/../vendor/wordpress/wp-includes/pomo/translations.php";
//require_once __DIR__ . "/../vendor/wordpress/wp-includes/plugin.php";
//require_once __DIR__ . "/../vendor/wordpress/wp-includes/load.php";
//require_once __DIR__ . "/../vendor/wordpress/wp-includes/cache.php";
//require( dirname( __FILE__ ) . '/../vendor/wordpress/wp-blog-header.php' );
//require_once __DIR__ . "/../vendor/wordpress/wp-blog-header.php";
//use Translations;

final class ClassNonceAys
{
    protected $html;
    protected $redirect_to;

    /**
     * Class constructor.
     *
     * @since 1.0.0
     *
     */
    public function __construct()
    {
    }
    
    /**
     * Display "Are You Sure" message to confirm the action being taken.
     *
     * If the action has the nonce explain message, then it will be displayed
     * along with the "Are you sure?" message.
     *
     * @since 2.0.4
     *
     * @param string $action The nonce action.
     */
    public function wpNonceAys(string $action)
    {
        if ('log-out' == $action) {
            $html = sprintf(
                /* translators: %s: site name */
                esc_attr__('You are attempting to log out of %s'),
                get_bloginfo('name')
            );
            $html .= '</p><p>';
            $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : '';
            esc_attr($redirect_to);
            $html .= sprintf(
                /* translators: %s: logout URL */
                esc_attr__('Do you really want to <a href="%s">log out</a>?'),
                wp_logout_url($redirect_to)
            );
        } else {
            $html = esc_attr__('The link you followed has expired.');
            if (wp_get_referer()) {
                $html .= '</p><p>';
                $html .= sprintf(
                    '<a href="%s">%s</a>',
                    esc_url(remove_query_arg('updated', wp_get_referer())),
                    esc_attr__('Please try again.')
                );
            }
        }
        wp_die(esc_html($html), esc_attr__('Something went wrong.'), 403);
    }
}
