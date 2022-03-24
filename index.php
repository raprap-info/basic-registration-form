In this tutorial, I will explain how to make a WordPress custom registration page without using any plugin.

Steps to do,
=================
1. Create a Wordpress Page.
2. Create a Template in Theme's Folder.
3. Assign template to Page.
4. Do registration form to template file.
5. Apply form data validations.
6. Create wordpress user.

STEPS TO VALIDATE FORM FIELDS
==========================================     
1. Check no space within username:
  strpos($username, ' ')
      
2. Check username must have value:
  empty($username)

3. Check username existence:
  username_exists( $username )

4. Check email validation
  is_email( $email )

5. Check email existence
  email_exists( $email )

6. Password matched or not 

Snippet of PHP Code:
=======================
get_header();
global $wpdb;

if ($_POST) {

    $username = $wpdb-]escape($_POST['txtUsername']);
    $email = $wpdb-]escape($_POST['txtEmail']);
    $password = $wpdb-]escape($_POST['txtPassword']);
    $ConfPassword = $wpdb-]escape($_POST['txtConfirmPassword']);

    $error = array();
    if (strpos($username, ' ') !== FALSE) {
        $error['username_space'] = "Username has Space";
    }

    if (empty($username)) {
        $error['username_empty'] = "Needed Username must";
    }

    if (username_exists($username)) {
        $error['username_exists'] = "Username already exists";
    }

    if (!is_email($email)) {
        $error['email_valid'] = "Email has no valid value";
    }

    if (email_exists($email)) {
        $error['email_existence'] = "Email already exists";
    }

    if (strcmp($password, $ConfPassword) !== 0) {
        $error['password'] = "Password didn't match";
    }

    if (count($error) == 0) {

        wp_create_user($username, $password, $email);
        echo "User Created Successfully";
        exit();
    }else{
        
        print_r($error);
        
    }
}
