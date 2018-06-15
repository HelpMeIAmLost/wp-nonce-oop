<?php
declare(strict_types=1);

/**
 * Class implementation of wp_nonce_url()
 *
 * Use this section to define what this class is doing, the PHPDocumentator will use this
 * to automatically generate an API documentation using this information.
 *
 * @author  Rowen Chumacera
 * @package HelpMeIAmLost\wp-nonce-oop
 */
namespace HelpMeIAmLost\Nonce;

final class ClassNonceUrl
{
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
     * Retrieve URL with nonce added to URL query.
     *
     * @since 2.0.4
     *
     * @param string     $actionurl URL to add nonce action.
     * @param int|string $action    Optional. Nonce action name. Default -1.
     * @param string     $name      Optional. Nonce name. Default '_wpnonce'.
     * @return string Escaped URL with nonce action added.
     */
    public function wpNonceUrl(
        string $actionurl,
        int|string $action = -1,
        string $name = '_wpnonce'
    ): string {
        
        $actionurl = str_replace('&amp;', '&', $actionurl);
        return esc_html(add_query_arg($name, wp_create_nonce($action), $actionurl));
    }
}
