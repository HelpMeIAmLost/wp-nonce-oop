<?php
declare(strict_types=1);

/**
 * Class implementation of the following Wordpress Nonce functionalities
 *     wp_nonce_ays()
 *     wp_nonce_field()
 *     wp_nonce_url()
 *     wp_verify_nonce()
 *     wp_create_nonce()
 *     check_admin_referer()
 *     check_ajax_referer()
 *     wp_referer_field()
 *
 * The following functionalities were modified for testing purposes
 *     wp_nonce_ays()
 *     wp_verify_nonce()
 *     wp_create_nonce()
 *     check_admin_referer()
 *     check_ajax_referer()
 *     wp_referer_field()
 *
 * @author  Rowen Chumacera
 * @package HelpMeIAmLost\WPNonceOOP
 */
namespace HelpMeIAmLost\WPNonceOOP;

final class ClassWPNonceOOP
{
    // phpcs:disable
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
    public function wp_nonce_ays(string $action): string
    {
        // Dummy version
        return $action;
        
        // // original content begins here
        // if ( 'log-out' == $action ) {
            // $html = sprintf(
                // /* translators: %s: site name */
                // __( 'You are attempting to log out of %s' ),
                // get_bloginfo( 'name' )
            // );
            // $html .= '</p><p>';
            // $redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
            // $html .= sprintf(
                // /* translators: %s: logout URL */
                // __( 'Do you really want to <a href="%s">log out</a>?' ),
                // wp_logout_url( $redirect_to )
            // );
        // } else {
            // $html = __( 'The link you followed has expired.' );
            // if ( wp_get_referer() ) {
                // $html .= '</p><p>';
                // $html .= sprintf( '<a href="%s">%s</a>',
                    // esc_url( remove_query_arg( 'updated', wp_get_referer() ) ),
                    // __( 'Please try again.' )
                // );
            // }
        // }

        // wp_die( $html, __( 'Something went wrong.' ), 403 );
        // // original content ends here
    }
    /**
     * Retrieve or display nonce hidden field for forms.
     *
     * The nonce field is used to validate that the contents of the form came from
     * the location on the current site and not somewhere else. The nonce does not
     * offer absolute protection, but should protect against most cases. It is very
     * important to use nonce field in forms.
     *
     * The $action and $name are optional, but if you want to have better security,
     * it is strongly suggested to set those two parameters. It is easier to just
     * call the function without any parameters, because validation of the nonce
     * doesn't require any parameters, but since crackers know what the default is
     * it won't be difficult for them to find a way around your nonce and cause
     * damage.
     *
     * The input name will be whatever $name value you gave. The input value will be
     * the nonce creation value.
     *
     * @since 2.0.4
     *
     * @param int|string $action  Optional. Action name. Default -1.
     * @param string     $name    Optional. Nonce name. Default '_wpnonce'.
     * @param bool       $referer Optional. Whether to set the referer field for validation.
     *                            Default true.
     * @param bool       $echo    Optional. Whether to display or return hidden form field.
     *                            Default true.
     * @return string Nonce field HTML markup.
     */
    public function wp_nonce_field(
        string $action = null,
        string $name = '_wpnonce',
        bool $referer = true,
        bool $echo = true
    ): string {
        
        // original content starts here
        $name = esc_attr( $name );
        $nonce_field = '<input type="hidden" id="' . $name . '" name="' . $name . '" value="' . $this->wp_create_nonce( $action ) . '" />';

        if ( $referer )
            $nonce_field .= $this->wp_referer_field( false );

        if ( $echo )
            echo $nonce_field;

        return $nonce_field;
        // original content ends here
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
    public function wp_nonce_url(
        string $actionurl,
        string $action = null,
        string $name = '_wpnonce'
    ): string {
        
        // original content begins here, modified for testing
        $actionurl = str_replace( '&amp;', '&', $actionurl );
        return esc_html( add_query_arg( $name, $this->wp_create_nonce( $action ), $actionurl ) );
        // original content ends here
    }
    /**
     * Verify that correct nonce was used with time limit.
     *
     * The user is given an amount of time to use the token, so therefore, since the
     * UID and $action remain the same, the independent variable is the time.
     *
     * @since 2.0.3
     *
     * @param string     $nonce  Nonce that was used in the form to verify
     * @param string|int $action Should give context to what is taking place and be the same when nonce
     *                   was created.
     * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
     *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
     */
    public function wp_verify_nonce(string $nonce, string $action = null)
    {
        // Dummy version
        if ( empty( $nonce ) ) {
            return false;
        }

        // Nonce generated 0-12 hours ago
        $expected = 'a192fc4204';
        if ( hash_equals( $expected, $nonce ) ) {
            return 1;
        }

        // Nonce generated 12-24 hours ago
        $expected = 'b192fc4204';
        if ( hash_equals( $expected, $nonce ) ) {
            return 2;
        }
        
        return false;
        
        // // original content begins here
        // $nonce = (string) $nonce;
        // $user = wp_get_current_user();
        // $uid = (int) $user->ID;
        // if ( ! $uid ) {
            // /**
             // * Filters whether the user who generated the nonce is logged out.
             // *
             // * @since 3.5.0
             // *
             // * @param int    $uid    ID of the nonce-owning user.
             // * @param string $action The nonce action.
             // */
            // $uid = apply_filters( 'nonce_user_logged_out', $uid, $action );
        // }

        // if ( empty( $nonce ) ) {
            // return false;
        // }

        // $token = wp_get_session_token();
        // $i = wp_nonce_tick();

        // // Nonce generated 0-12 hours ago
        // $expected = substr( wp_hash( $i . '|' . $action . '|' . $uid . '|' . $token, 'nonce'), -12, 10 );
        // if ( hash_equals( $expected, $nonce ) ) {
            // return 1;
        // }

        // // Nonce generated 12-24 hours ago
        // $expected = substr( wp_hash( ( $i - 1 ) . '|' . $action . '|' . $uid . '|' . $token, 'nonce' ), -12, 10 );
        // if ( hash_equals( $expected, $nonce ) ) {
            // return 2;
        // }

        // /**
         // * Fires when nonce verification fails.
         // *
         // * @since 4.4.0
         // *
         // * @param string     $nonce  The invalid nonce.
         // * @param string|int $action The nonce action.
         // * @param WP_User    $user   The current user object.
         // * @param string     $token  The user's session token.
         // */
        // do_action( 'wp_verify_nonce_failed', $nonce, $action, $user, $token );

        // // Invalid nonce
        // return false;
        // // original content ends here
    }
    /**
     * Creates a cryptographic token tied to a specific action, user, user session,
     * and window of time.
     *
     * @since 2.0.3
     * @since 4.0.0 Session tokens were integrated with nonce creation
     *
     * @param string|int $action Scalar value to add context to the nonce.
     * @return string The token.
     */
    public function wp_create_nonce(string $action = null): string
    {
        // Dummy version
        $token = 'b192fc4204';
        return $token;

        // // original content begins here
        // $user = wp_get_current_user();
        // $uid = (int) $user->ID;
        // if ( ! $uid ) {
            // /** This filter is documented in wp-includes/pluggable.php */
            // $uid = apply_filters( 'nonce_user_logged_out', $uid, $action );
        // }

        // $token = wp_get_session_token();
        // $i = wp_nonce_tick();

        // return substr( wp_hash( $i . '|' . $action . '|' . $uid . '|' . $token, 'nonce' ), -12, 10 );
        // // original content ends here
    }
    /**
     * Makes sure that a user was referred from another admin page.
     *
     * To avoid security exploits.
     *
     * @since 1.2.0
     *
     * @param int|string $action    Action nonce.
     * @param string     $query_arg Optional. Key to check for nonce in `$_REQUEST` (since 2.5).
     *                              Default '_wpnonce'.
     * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
     *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
     */
    public function check_admin_referer(string $action = null, string $query_arg = '_wpnonce')
    {
        // Dummy version
        $nonce = '';
        if('admin-0-12-nonce' == $query_arg)
        {
            $nonce = 'a192fc4204';
        }
        if('admin-12-24-nonce' == $query_arg)
        {
            $nonce = 'b192fc4204';
        }
        
        $result = $this->wp_verify_nonce($nonce, $action);
        return $result;
        
        // // original content begins here
        // if ( null == $action )  // updated
            // _doing_it_wrong( __FUNCTION__, __( 'You should specify a nonce action to be verified by using the first parameter.' ), '3.2.0' );

        // $adminurl = strtolower(admin_url());
        // $referer = strtolower(wp_get_referer());
        // $result = isset($_REQUEST[$query_arg]) ? wp_verify_nonce($_REQUEST[$query_arg], $action) : false;

        // /**
         // * Fires once the admin request has been validated or not.
         // *
         // * @since 1.5.1
         // *
         // * @param string    $action The nonce action.
         // * @param false|int $result False if the nonce is invalid, 1 if the nonce is valid and generated between
         // *                          0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
         // */
        // do_action( 'check_admin_referer', $action, $result );

        // if ( ! $result && ! ( null == $action && strpos( $referer, $adminurl ) === 0 ) ) {  // updated
            // wp_nonce_ays( $action );
            // die();
        // }

        // return $result;
        // // original content ends here
    }
    /**
     * Verifies the Ajax request to prevent processing requests external of the blog.
     *
     * @since 2.0.3
     *
     * @param int|string   $action    Action nonce.
     * @param false|string $query_arg Optional. Key to check for the nonce in `$_REQUEST` (since 2.5).
     *                                If false, `$_REQUEST` values will be evaluated for '_ajax_nonce',
     *                                and '_wpnonce' (in that order). Default false.
     * @param bool         $die       Optional. Whether to die early when the nonce cannot be verified.
     *                                Default true.
     * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
     *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
     */
    public function check_ajax_referer(
        string $action = null,
        string $query_arg = null,
        bool $die = true
    ) {
        
        // Dummy version
        $nonce = '';
        if('ajax-0-12-nonce' == $query_arg)
        {
            $nonce = 'a192fc4204';
        }
        if('ajax-12-24-nonce' == $query_arg)
        {
            $nonce = 'b192fc4204';
        }
        
        $result = $this->wp_verify_nonce($nonce, $action);
        return $result;

        // // original content begins here
        // if ( null == $action ) {  // updated
            // _doing_it_wrong( __FUNCTION__, __( 'You should specify a nonce action to be verified by using the first parameter.' ), '4.7' );
        // }

        // $nonce = '';

        // if ( $query_arg && isset( $_REQUEST[ $query_arg ] ) )
            // $nonce = $_REQUEST[ $query_arg ];
        // elseif ( isset( $_REQUEST['_ajax_nonce'] ) )
            // $nonce = $_REQUEST['_ajax_nonce'];
        // elseif ( isset( $_REQUEST['_wpnonce'] ) )
            // $nonce = $_REQUEST['_wpnonce'];

        // $result = wp_verify_nonce( $nonce, $action );

        // /**
         // * Fires once the Ajax request has been validated or not.
         // *
         // * @since 2.1.0
         // *
         // * @param string    $action The Ajax nonce action.
         // * @param false|int $result False if the nonce is invalid, 1 if the nonce is valid and generated between
         // *                          0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
         // */
        // do_action( 'check_ajax_referer', $action, $result );

        // if ( $die && false === $result ) {
            // if ( wp_doing_ajax() ) {
                // wp_die( -1, 403 );
            // } else {
                // die( '-1' );
            // }
        // }

        // return $result;
        // // original content ends here
    }
    /**
     * Retrieve or display referer hidden field for forms.
     *
     * The referer link is the current Request URI from the server super global. The
     * input name is '_wp_http_referer', in case you wanted to check manually.
     *
     * @since 2.0.4
     *
     * @param bool $echo Optional. Whether to echo or return the referer field. Default true.
     * @return string Referer field HTML markup.
     */
    public function wp_referer_field(bool $echo = true): string
    {
        // Dummy version
        $referer_field = '<input type="hidden" name="_wp_http_referer" value="/index.php" />';

        if ( $echo )
            echo $referer_field;
        return $referer_field;

        // original content begins here, modified for testing purposes
        //$referer_field = '<input type="hidden" name="_wp_http_referer" value="'. esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ) ) . '" />';

        // if ( $echo )
            // echo $referer_field;
        // return $referer_field;
        // original content ends here
    }
    // phpcs:enable
}
