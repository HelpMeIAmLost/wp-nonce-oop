# HelpMeIAmLost\WPNonceOOP
=========================
This is a Composer package of an object-oriented implementation of the following WordPress nonce functionalities:
* wp_create_nonce()
* wp_nonce_url()
* wp_nonce_field()
* check_admin_referer()
* check_ajax_referer()
* wp_verify_nonce()
* wp_nonce_ays()
* wp_referer_field()

## Features
--------
* Unit testing with PHPUnit
* Comprehensive guides

## Usage
========================
### Using the OOP implementation
Add the following line to your `functions.php` file:
```
require __DIR__ . '/vendor/autoload.php';
:
use HelpMeIAmLost\WPNonceOOP\ClassWPNonceOOP;
:
$nonceInstance = new ClassWPNonceOOP;
```

### Creating a nonce
By default, the `wp_create_nonce()` function can be called as is.
```
$nonceCreate = $nonceInstance->wp_create_nonce();
```

To use your own action, you can specify it in the function call.
```
$nonceCreate = $nonceInstance->wp_create_nonce('process-comment');
```


### Adding a nonce to a URL
To add a nonce to a URL, call wp_nonce_url() specifying the bare URL and a string representing the action. For example:
```
$nonceUrl = $this->nonceInstance->wp_nonce_url( $bare_url, 'trash-post_'.$post->ID, 'my_nonce' );
```

### Adding a nonce to a form
To add a nonce to a form, call wp_nonce_field() specifying a string representing the action. By default wp_nonce_field() generates two hidden fields, one whose value is the nonce and one whose value is the current URL (the referrer), and it echoes the result. For example, this call:
```
$nonceField = $this->nonceInstance->wp_nonce_field('process-comment', 'my-nonce')
```
might echo something like:
```
<input type="hidden" id="my-nonce" name="my-nonce" value="b192fc4204" />
<input type="hidden" name="_wp_http_referer" value="/index.php" />
```

### Verifying a nonce passed from an admin screen
To verify a nonce that was passed in a URL or a form in an admin screen, call check_admin_referer() specifying the string representing the action. For example:
```
$checkAdminRefer = $this->nonceInstance->check_admin_referer('process-comment')
```

If a different field name was used to create the nonce, you can specify it in the function call. For example:
```
$checkAdminRefer = $this->nonceInstance->check_admin_referer('process-comment', 'my-nonce')
```

### Verifying a nonce passed in an AJAX request
To verify a nonce that was passed in an AJAX request, call check_ajax_referer() specifying the string representing the action. For example:
```
$checkAjaxRefer = $this->nonceInstance->check_ajax_referer('process-comment');
```

If a different field name was used to create the nonce, you can specify it in the function call. For example:
```
$checkAjaxRefer = $this->nonceInstance->check_ajax_referer('process-comment', 'my-nonce');
```

### Verifying a nonce passed in some other context
To verify a nonce passed in some other context, call wp_verify_nonce() specifying the nonce and the string representing the action. For example:
```
$nonceVerify = $this->nonceInstance->wp_verify_nonce($_REQUEST['my-nonce'], 'process-comment'.$comment_id);
```

