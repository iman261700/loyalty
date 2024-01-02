<?php

session_start();
require_once 'classes/db.class.php';
require_once 'classes/sendgrid.class.php';

require_once 'config.inc.php';

db::connect();

$uri = explode('/', explode('?', $_SERVER['REQUEST_URI'])[0]);

if (isset($_POST['exportUsers']) && $_SESSION['user']['role'] == 'admin') {
    $fileName = 'customers_'.date('d-m-Y_H-i').'.csv';

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename='.$fileName);

    echo "ID,Created,Name,Shipping Address,Contact Number,Email,Pet\n";

    $req3 = db::query('SELECT * FROM users'); // ADD TOKEN LATER
    while ($user = db::fetch_assoc($req3)) {
        $req4 = db::query("SELECT * FROM user_shipping WHERE user_id='".$user['id']."' ORDER BY id DESC LIMIT 1"); // ADD TOKEN LATER
        $user['address'] = db::fetch_assoc($req4);

        if ($user['pet'] == '0') {
            $user['pet'] = '-';
        }

        echo $user['id'].','
                                        .$user['date_created'].','
                                        .$user['first_name'].' '.$user['last_name'].','
                                        .str_replace(',', '.', $user['address']['address_line_1']).' / '.str_replace(',', '.', $user['address']['address_line_2']).
                                        '  '.str_replace(',', '.', $user['address']['postcode']).
                                        '  '.str_replace(',', '.', $user['address']['city']).','
                                        .$user['phone'].','
                                        .$user['email'].','
                                        .$user['pet']."\n";
    }

    die();
}

if (isset($_POST['exportReport']) && $_SESSION['user']['role'] == 'admin') {
    $fileName = 'report_'.date('d-m-Y_H-i').'.csv';

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename='.$fileName);

    if (!empty($_POST['type'])) {
        $filter .= " AND type = '".db::escape($_POST['type'])."' ";
    }

    if (!empty($_POST['created_from'])) {
        $filter .= " AND date_created >= '".db::escape($_POST['created_from'])."' ";
    }

    if (!empty($_POST['created_to'])) {
        $filter .= " AND date_created <= '".db::escape($_POST['created_to'])."' ";
    }

    $req3 = db::query("SELECT * FROM user_points WHERE id > 0 $filter ORDER BY id DESC"); // ADD TOKEN LATER
    while ($transaction = db::fetch_assoc($req3)) {
        $req = db::query("SELECT * FROM codes WHERE code='".db::escape($transaction['code'])."' LIMIT 1");
        $transaction['code'] = db::fetch_assoc($req);

        $req = db::query("SELECT * FROM users WHERE id='".db::escape($transaction['user_id'])."' LIMIT 1");
        $transaction['customer'] = db::fetch_assoc($req);

        $hide = 0;

        if (!empty($_POST['search'])) {
            $hide = 1;

            if (stripos($transaction['customer']['first_name'], $_POST['search']) !== false) {
                $hide = 0;
            }

            if (stripos($transaction['customer']['last_name'], $_POST['search']) !== false) {
                $hide = 0;
            }

            if (stripos($transaction['customer']['email'], $_POST['search']) !== false) {
                $hide = 0;
            }

            if (stripos($transaction['code']['code'], $_POST['search']) !== false) {
                $hide = 0;
            }

            if (stripos($transaction['code']['distrbuter_code'], $_POST['search']) !== false) {
                $hide = 0;
            }
        }

        if ($hide == 0) {
            $report[] = $transaction;
        }
    }

    echo "Transaction ID, Date Created, Customer, Value, Order ID, QR Code, QR Distributer\n";
    foreach ($report as $transaction) {
        if ($transaction['type'] == 'REDEMPTION') {
            $transaction['value'] = '-'.$transaction['value'];
        }

        echo $transaction['id'].','
                    .$transaction['date_created'].','
                    .$transaction['customer']['first_name'].' '.$transaction['customer']['last_name'].' ('.$transaction['customer']['id'],')'.','
                    .$transaction['value'].','
                    .$transaction['order_id'].','
                    .$transaction['code']['code'].','
                    .$transaction['code']['distributor_code']."\n";
    }

    die();
}

if ($uri[1] == 'logout') {
    session_destroy();
    sleep(1);
    unset($_SESSION);
    header('location: /login');
    die();
}

function getSettings($name)
{
    $req = db::query("SELECT * FROM meta WHERE name='".db::escape($name)."' LIMIT 1");

    return db::fetch_assoc($req)['value'];
}

function getBalance()
{
    $req = db::query("SELECT * FROM user_points WHERE user_id='".$_SESSION['user']['id']."' ");
    while ($row = db::fetch_assoc($req)) {
        if ($row['type'] == 'COLLECTION') {
            $balance = $balance + $row['value'];
            $claimed = $claimed + $row['value'];
        } else {
            $balance = $balance - $row['value'];
            $redeemed = $redeemed + $row['value'];
        }
    }

    return [
      'balance' => $balance,
      'claimed' => $claimed,
      'redeemed' => $redeemed,
    ];
}
function getDeliveryAddress()
{
    $req = db::query("SELECT * FROM user_shipping WHERE user_id='".$_SESSION['user']['id']."' ORDER BY id DESC LIMIT 1");

    return db::fetch_assoc($req);
}

$titles = [
  '/' => 'Member Login ',

  '/login' => 'Member Login',
  '/signup' => 'Member Registration',

  '/terms-and-conditions' => 'Terms & Conditions',
  '/privacy-policy' => 'Privacy Policy',

  '/password' => 'Password Recovery',
  '/login' => 'Member Login',
  '/password_success' => 'Password Recovery',
  '/password_error' => 'Password Recovery',
  '/signup_success' => 'Password Recovery',
  '/update_password' => 'Password Recovery',
  '/activate_error' => 'Password Recovery',
  '/activate_success' => 'Password Recovery',

  '/user/cart' => 'Checkout',
  '/user/history' => 'History',
  '/user/order_placed' => 'Order Placed',
  '/user/update_password' => 'Update Password',
  '/user/start' => 'Products',
  '/user' => 'Products',
];

if (isset($_SESSION['user']) && $_SERVER['REQUEST_URI'] == '/') {
    $titles['/'] = 'Products';
}

$pw_hash = 'ritma2020';

//
// print_r($_POST);
// print_r($_SESSION);

if (isset($_SESSION['user'])) {
    $balance = getBalance();
}

if (isset($_POST['delete_product'])) {
    unset($_SESSION['cart']);
    foreach ($_POST as $name => $value) {
        if (stripos($name, 'cart_') !== false) {
            $item_id = explode('_', $name)[1];
            if ($item_id != $_POST['delete_product']) {
                $_SESSION['cart'][$item_id] = $value;
            }
        }
    }
}

if (isset($_POST['doCartUpdate'])) {
    unset($_SESSION['cart']);
    foreach ($_POST as $name => $value) {
        if (stripos($name, 'cart_') !== false) {
            $item_id = explode('_', $name)[1];
            $_SESSION['cart'][$item_id] = $value;
        }
    }
}

if (isset($_POST['doSaveNewPassword'])) {
    $req = db::query("SELECT * FROM users WHERE id = '".$_SESSION['user']['id']."' AND (password='".db::escape(md5($_POST['old_password'].$pw_hash))."' || password='".db::escape(md5($_POST['old_password']))."' || password='".db::escape(md5($_POST['old_password'].$_SESSION['user']['salt']))."')  LIMIT 1");
    if (db::num_rows($req) == 1) {
        if ($_POST['password'] == $_POST['password2'] && strlen($_POST['password']) > 5) {
            db::query("UPDATE users SET password = '".db::escape(md5($_POST['password'].$_SESSION['user']['salt']))."' WHERE id='".$_SESSION['user']['id']."' LIMIT 1");
            $err = 'Password updated!';
            unset($uri[2]);
        } else {
            $err = 'New Password doesnt match.';
        }
    } else {
        $err = 'Old password incorrect.';
    }
}

if (isset($_POST['doUpdateDeliveryAddress'])) {
    db::query("INSERT INTO user_shipping (user_id, first_name, last_name, address_line_1, address_line_2, postcode, city,phone) VALUES
      ('".db::escape($_SESSION['user']['id'])."',
      '".db::escape($_POST['first_name'])."',
      '".db::escape($_POST['last_name'])."',
      '".db::escape($_POST['address_line_1'])."',
      '".db::escape($_POST['address_line_2'])."',
      '".db::escape($_POST['postcode'])."',
      '".db::escape($_POST['city'])."',
      '".db::escape($_POST['phone'])."')");
}

if (isset($_GET['add'])) {
    ++$_SESSION['cart'][$_GET['add']];
    header('location: /user/cart');
    die();
}

if ($uri[2] == 'cart') {
    $delivery_address = getDeliveryAddress();

    if (empty($delivery_address['postcode'])) {
        $uri[2] = 'delivery_address';
        $err = 'To continue with the purchase, you need to update your delivery address.';
    }
}

if (isset($_POST['doPlaceOrder'])) {
    unset($_SESSION['cart']);
    foreach ($_POST as $name => $value) {
        if (stripos($name, 'cart_') !== false) {
            $item_id = explode('_', $name)[1];
            $_SESSION['cart'][$item_id] = $value;
        }
    }

    // Enough Points?
    foreach ($_SESSION['cart'] as $item_id => $qty) {
        $req = db::query("SELECT * FROM products WHERE id='".db::escape($item_id)."' AND status = 1");
        $item = db::fetch_assoc($req);
        $required_points = ($required_points) + ($item['required_points'] * $qty);
    }

    $balance = getBalance();

    if ($required_points <= $balance['balance']) {
        db::query("INSERT INTO user_order (user_id, delivery_address, products, points)
    VALUES ('".$_SESSION['user']['id']."','".$delivery_address['id']."','".db::escape(json_encode($_SESSION['cart']))."','".$required_points."')");

        $order_id = db::lastID();

        db::query("INSERT INTO user_points (order_id,user_id, type, value) VALUES ('".$order_id."','".$_SESSION['user']['id']."','REDEMPTION','".$required_points."')");
        $uri[1] = 'user';
        $uri[2] = 'order_placed';

        foreach ($_SESSION['cart'] as $item_id => $qty) {
            $req = db::query("SELECT * FROM products WHERE id='".db::escape($item_id)."' AND status = 1");
            $item = db::fetch_assoc($req);

            $summary .= $qty.'x '.$item['product_name'].'<br/>';
        }

        $email_content = getSettings('email_order_confirmation');
        $email_content = str_replace('%%CONTENT%%', $email_content, file_get_contents('template/email/default.tpl.php'));
        $email_content = str_replace('%%FOOTER%%', getSettings('email_footer'), $email_content);

        $email_content = str_replace('%%first_name%%', $_SESSION['user']['first_name'], $email_content);
        $email_content = str_replace('%%last_name%%', $_SESSION['user']['last_name'], $email_content);
        $email_content = str_replace('%%order_id%%', $order_id, $email_content);

        $email_content = str_replace('%%order_summary%%', $summary, $email_content);

        // Send Email
        sendgrid::send($_SESSION['user']['email'], 'Order Confirmation [#'.$order_id.']', $email_content, getSettings('EMAIL_FROM'));

        foreach (explode(',', getSettings('ORDER_NOTIFICATION_EMAIL')) as $notification_email) {
            $email_content = getSettings('email_admin_order_confirmation');

            $email_content = str_replace('%%CONTENT%%', $email_content, file_get_contents('template/email/default.tpl.php'));
            $email_content = str_replace('%%FOOTER%%', getSettings('email_footer'), $email_content);

            $email_content = str_replace('%%first_name%%', $_SESSION['user']['first_name'], $email_content);
            $email_content = str_replace('%%order_id%%', $order_id, $email_content);

            $email_content = str_replace('%%last_name%%', $_SESSION['user']['last_name'], $email_content);
            $email_content = str_replace('%%order_summary%%', $summary, $email_content);

            // Send Email
            sendgrid::send($notification_email, 'Order Received [#'.$order_id.']', $email_content, getSettings('EMAIL_FROM'));
        }

    } else {
        $err = 'Sorry, dont have enough points.';
    }
}

if (isset($_POST['doClaim'])) {
    if (empty($_POST['code']) || empty($_POST['pin'])) {
        $err = 'Please fill in both Code and Serial Number to redeem.';
    } else {
        $req = db::query("SELECT * FROM codes WHERE code='".db::escape($_POST['code'])."' AND pin = '".db::escape($_POST['pin'])."' AND date_used = 0 LIMIT 1");
        if (db::num_rows($req) == 1) {
            $code = db::fetch_assoc($req);

            // Block Code
            db::query("UPDATE codes SET date_used = '".time()."' WHERE id='".$code['id']."' LIMIT 1");
            // Update User Points
            db::query("INSERT INTO user_points(user_id, type, code, value)
          VALUES ('".$_SESSION['user']['id']."','COLLECTION','".db::escape($_POST['code'])."','".$code['value']."')");

            $err = 'You have received '.$code['value'].' Points!';

            $balance = getBalance();
        } else {
            $err = 'Invalid code/serial number or this code/serial number has been redeem.';
        }
    }
}

if (isset($_POST['doRegister'])) {
    $err = '';

    // Verify reCAPTCHA V2
    // Need to change secret key
    $recaptcha_secret = '6LeFIzcpAAAAAKMAvl57LzVwWAVQIijR6bmmrHQ6';
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Proceed with reCAPTCHA verification
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response,
    ];

    $options = [
        'http' => [
            'header' => 'Content-type: application/x-www-form-urlencoded\r\n',
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $result_json = json_decode($result, true);

    if (!$result_json['success']) 
    {
        $err = 'reCAPTCHA verification failed. Please prove that you are not a robot.';
    } 
    else 
    {

        // Email Registerd?
        $req = db::query("SELECT * FROM users WHERE email='".db::escape($_POST['email'])."' LIMIT 1");
        if (db::num_rows($req) == 1) {
            $err = 'Email Address already exists in our Database. If you have forgotten your password, please use the recovery link on the login page.';
        }

        $salt = md5(json_encode($_POST));

        // No Errors -> Proceed
        if (empty($err)) {
                db::query("INSERT INTO users (fb_id,email,password, salt,first_name, last_name, phone, role,pet) VALUES
            ('".db::escape($_GET['fb'])."',
            '".db::escape($_POST['email'])."',
            '".db::escape(md5($_POST['password'].$pw_hash))."',
            '".db::escape($salt)."',
            '".db::escape($_POST['first_name'])."',
            '".db::escape($_POST['last_name'])."',
            '".db::escape($_POST['phone'])."','client','".db::escape($_POST['pet'])."')");

            $user_id = db::lastID();

            db::query("INSERT INTO user_shipping (user_id, first_name, last_name, address_line_1,  postcode, city,phone) VALUES
            ('".db::escape($user_id)."',
            '".db::escape($_POST['first_name'])."',
            '".db::escape($_POST['last_name'])."',
            '".db::escape($_POST['address'])."',
            '".db::escape($_POST['zip'])."',
            '".db::escape($_POST['city'])."',
            '".db::escape($_POST['phone'])."')");

            // Activation
            $hash = md5($_POST['email'].time().'activate');

            db::query("INSERT INTO user_activate (user_id, hash) VALUES ('".$user_id."','".$hash."')");

            $link = 'https://'.$_SERVER['HTTP_HOST'].'/activate/'.$hash;

            $email_content = getSettings('email_registration');
            $email_content = str_replace('%%CONTENT%%', $email_content, file_get_contents('template/email/default.tpl.php'));
            $email_content = str_replace('%%FOOTER%%', getSettings('email_footer'), $email_content);
            $email_content = str_replace('%%first_name%%', $_POST['first_name'], $email_content);
            $email_content = str_replace('%%last_name%%', $_POST['last_name'], $email_content);
            $email_content = str_replace('%%link%%', $link, $email_content);

            // Send Email
            sendgrid::send($_POST['email'], 'Activate your Account', $email_content, getSettings('EMAIL_FROM'));

            $uri[1] = 'signup_success';
        }
    }
}


if (isset($_POST['doRecovery'])) {
    $err = '';

    // Email Registerd?
    $req = db::query("SELECT * FROM users WHERE email='".db::escape($_POST['email'])."' LIMIT 1");
    if (db::num_rows($req) == 0) {
        $err = 'We cannot find your email address in the database.';
    }

    // No Errors -> Proceed
    if (empty($err)) {
        $user = db::fetch_assoc($req);

        $hash = md5(time().$user_id);
        db::query("INSERT INTO user_activate (user_id, hash) VALUES ('".$user['id']."','".$hash."')");

        $link = 'https://'.$_SERVER['HTTP_HOST'].'/update_password/'.$hash;

        $email_content = getSettings('email_password_recovery');
        $email_content = str_replace('%%CONTENT%%', $email_content, file_get_contents('template/email/default.tpl.php'));
        $email_content = str_replace('%%FOOTER%%', getSettings('email_footer'), $email_content);

        $email_content = str_replace('%%first_name%%', $_POST['first_name'], $email_content);
        $email_content = str_replace('%%last_name%%', $_POST['last_name'], $email_content);
        $email_content = str_replace('%%link%%', $link, $email_content);

        // Send Email
        sendgrid::send($_POST['email'], 'Password Recovery', $email_content, 'no-reply@ritmapres.com');

        $uri[1] = 'password_success';
    }
}

if (isset($_POST['doLogin'])) {
    $req = db::query("SELECT * FROM users WHERE email='".db::escape($_POST['email'])."'  AND status  = 1 LIMIT 1");
    if (db::num_rows($req) == 1) {
        $user = db::fetch_assoc($req);

        //AND (password='".db::escape(md5($_POST['password'].$pw_hash))."' OR password='".db::escape(md5($_POST['password']))."')
        if ($user['password'] == md5($_POST['password']) ||
            $user['password'] == md5($_POST['password'].$pw_hash) ||
            $user['password'] == md5($_POST['password'].$user['salt'])) {
            if (isset($_POST['remember_me'])) {
                setcookie('email', $_POST['email'], time() + (86400 * 31));
            }

            $_SESSION['user'] = $user;
            $uri[1] = 'user';
            $uri[2] = 'start';
        } else {
            $err = 'Your account is not activated or we didnt found any account with your credentials.';
        }
    } else {
        $err = 'Your account is not activated or we didnt found any account with your credentials.';
    }
}

if ($uri[1] == 'update_password') {
    $req = db::query("SELECT * FROM user_activate WHERE hash='".db::escape($uri[2])."' AND date_expire = 0  LIMIT 1");
    unset($uri[2]);
    if (db::num_rows($req) == 1) {
        $user = db::fetch_assoc($req);

        if (isset($_POST['doUpdatePassword']) && $_POST['password'] == $_POST['password2'] && strlen($_POST['password']) > 5) {
            db::query("UPDATE users SET password = '".db::escape(md5($_POST['password'].$user['salt']))."' WHERE id='".$user['user_id']."' LIMIT 1");
            db::query("UPDATE user_activate SET date_expire = 1 WHERE id='".$user['id']."' LIMIT 1");
            $uri[1] = 'password_updated';
        }
    } else {
        $uri[1] = 'password_error';
    }

    $err = '';
}

if ($uri[1] == 'activate') {
    $req = db::query("SELECT * FROM user_activate WHERE hash='".db::escape($uri[2])."' LIMIT 1");
    unset($uri[2]);
    if (db::num_rows($req) == 1) {
        $user = db::fetch_assoc($req);

        db::query("UPDATE users SET status = 1 WHERE id='".$user['user_id']."' LIMIT 1");

        $uri[1] = 'activate_success';
    } else {
        $uri[1] = 'activate_error';
    }
    $err = '';
}

if ($uri[1] == 'backend' && $_SESSION['user']['role'] == 'admin') {
    require_once 'template/backend/header.tpl.php';
} else {
    require_once 'template/header.tpl.php';
}

if (isset($_SESSION['user']) && empty($uri[2])) {
    $uri[2] = 'start';
    $uri[1] = 'user';
}

if ($uri[1] == 'user') {
    if (!isset($_SESSION['user'])) {
        $uri[1] = 'login';
    }
}
if ($uri[1] == '') {
    $uri[1] = 'login';
}

if ($_SERVER['REQUEST_URI'] == '/terms-and-conditions') {
    $uri[1] = 'terms-and-conditions';
    $uri[2] = '';
}

if ($_SERVER['REQUEST_URI'] == '/privacy-policy') {
    $uri[1] = 'privacy-policy';
    $uri[2] = '';
}
if (empty($uri[2])) {
    require_once 'template/'.$uri[1].'.tpl.php';
} else {
    require_once 'template/'.$uri[1].'/'.$uri[2].'.tpl.php';
}

if ($uri[1] == 'backend' && $_SESSION['user']['role'] == 'admin') {
    require_once 'template/backend/footer.tpl.php';
} else {
    require_once 'template/footer.tpl.php';
}
