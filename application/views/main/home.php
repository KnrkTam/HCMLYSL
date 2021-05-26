<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'head.php'; ?>

    <style>
        #function_guide li{
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Frontend Demo</h1>

    <h3>Language changer</h3>
    <div class="bnt btn-group">
        <!-- Language changer -->
        <?php foreach (config_item('frontend_lang_list') as $lang => $locale) {
            ?><a href="<?= change_lang($lang) ?>" class="btn btn-default"><?= $lang ?></a>
            <?php
        } ?>
    </div>
    <h5>URL: <b><?= current_url() ?></b></h5>
    <h5>Language demo: <b><?= __('Title') ?></b></h5>
    <hr>

    <h3>Function demo</h3>
    <a class="btn btn-primary" href="<?= front_url('home/send_email') ?>">Send Email Demo</a>

    <a class="btn btn-primary" href="<?= front_url('paypal/demos/express_checkout') ?>">PayPal Checkout Demo</a>

    <a class="btn btn-primary" href="<?= front_url('home/pagination_demo') ?>">Pagination Demo</a>

    <a class="btn btn-primary" href="<?= front_url('home/ci_database') ?>">CodeIgniter Database Demo</a>

    <a class="btn btn-primary" href="<?= front_url('home/captcha') ?>">CAPTCHA</a>

    <a class="btn btn-danger" href="<?= admin_url() ?>">Backend</a>

    <hr>
    <h3>Function Guide</h3>
    <ul id="function_guide">
        <li>Form List Type (Easy to manage normal form setting)
            <ul>
                <li>Sample - News2</li>
                <li>use News2_model .php -> from_list to set your form</li>
                <li>Bk_news2.php -> create / modify -> News2_model::form_list </li>
                <li>news2_form.php -> loop form list and use utility_helper.php -> form_list_type()</li>
                <li>review Bk_news2.php -> submit_form, see how to save data</li>
            </ul>
        </li>

        <li>Webadmin Index Page Ajax get record
            <ul>
                <li>Sample - News2</li>
                <li>Initialize ajax datatable in news2_index.php </li>
                <li>call Bk_news2.php -> ajax to get datatable json data </li>
            </ul>
        </li>

        <li>Email Tracking
            <ul>
                <li>Controller: Email_tracking.php (for update email open status), webadmin/Bk_email_tracking.php</li>
                <li>Model: Email_tracking_model.php</li>
                <li>View: email_tracking_index.php</li>
                <li>Usage: use updated function <span style="color: red;">ci_send_email($from, $from_name, $to, $to_name, $subject, $message = '', $bcc = array(), $template_field = array(), $template_path = '', $template_content = '', $attachments = array(), $table_name, $table_id, $email_tracking = null, $email_tracking_type = null, $email_tracking_code = null)</span> in utility_helper.php<br>email tracking code (a image src with php url) will add to email automatically
                </li>
            </ul>
        </li>

        <li>PDF / Images Base64 and AES Protect Data
            <ul>
                <li>Sample - News2</li>
                <li>functions: utility_helper.php -> base64_upload, base64_upload_decode</li>
            </ul>
        </li>




    </ul>
    <hr>

    <h3>Server Information

        (<a href="<?= front_url('home/phpinfo') ?>">phpinfo</a>)</h3>

    <!-- API Version -->
    <dl class="dl-horizontal">
        <dt>PHP Version</dt>
        <dd><?= PHP_VERSION ?></dd>
        <dt>CodeIgniter Verison</dt>
        <dd><?= CI_VERSION ?></dd>
        <dt>Environment</dt>
        <dd><?= ENVIRONMENT ?></dd>
        <dt>Enable Production</dt>
        <dd><?= PRODUCTION == 1 ? 'true' : 'false' ?></dd>
        <dt>Enable GD Extension</dt>
        <dd><?= extension_loaded('gd') ? 'true' : 'false' ?></dd>
        <dt>Enable CURL Function</dt>
        <dd><?= function_exists('curl_version') ? 'true' : 'false' ?></dd>
        <dt>Project Verison</dt>
        <dd><?= VERSION ?></dd>
        <dt>Send Email</dt>
        <dd><?= SEND_EMAIL == 1 ? 'true' : 'false' ?></dd>
        <dt>File Version</dt>
        <dd><?= FILE_VERSION ?></dd>
        <dt>Debug</dt>
        <dd><?= DEBUG == 1 ? 'true' : 'false' ?></dd>
        <dt>Document Root</dt>
        <dd><?= DOCUMENT_ROOT ?></dd>
        <dt>Enable Email BCC log</dt>
        <dd><?= ENABLE_EMAIL_BCC_LOG == 1 ? 'true' : 'false' ?></dd>
        <dt>Email Bcc Log Address</dt>
        <dd><?= EMAIL_BCC_LOG_ADDR ?></dd>
        <dt>Test Email</dt>
        <dd><?= TEST_EMAIL == 1 ? 'true' : 'false' ?></dd>
        <dt>Test Email Address</dt>
        <dd><?= TEST_EMAIL_ADDR ?></dd>
        <dt>Timezone</dt>
        <dd><?= date_default_timezone_get() ?></dd>
        <dt>Now</dt>
        <dd><?= date('Y-m-d H:i:s') ?></dd>
    </dl>

    <hr>
    <h3>Font-end Language</h3>
    <dl class="dl-horizontal">
        <dt>Enable Multi Lang</dt>
        <dd><?= config_item('frontend_multiple_language') ? 'true' : 'false' ?></dd>
        <dt>Default Lang</dt>
        <dd><?= config_item('frontend_default_language') ?></dd>
        <dt>Lang List</dt>
        <dd><?php vdump(config_item('frontend_lang_list')) ?></dd>
        <dt>CI Lang</dt>
        <dd><?= config_item('language') ?></dd>
        <dt>Current Lang</dt>
        <dd><?= get_lang() ?></dd>
    </dl>

    <hr>
    <h3>Back-end Language</h3>
    <dl class="dl-horizontal">
        <dt>Enable Multi Lang</dt>
        <dd><?= config_item('backend_multiple_language') ? 'true' : 'false' ?></dd>
        <dt>Default Lang</dt>
        <dd><?= config_item('backend_default_language') ?></dd>
        <dt>Lang List</dt>
        <dd><?php vdump(config_item('backend_lang_list')) ?></dd>
    </dl>

    <hr>
    <h3>SendGrid</h3>
    <dl class="dl-horizontal">
        <dt>SendGrid API KEY</dt>
        <dd><?= SENDGRID_API_KEY ?></dd>
        <dt>SendGrid Code</dt>
        <dd><?= SENDGRID_CODE ?></dd>
        <dt>SendGrid Debug</dt>
        <dd><?= SENDGRID_DEBUG == 1 ? 'true' : 'false' ?></dd>
    </dl>


    <hr>
    <h3>PayPal</h3>

    <dl class="dl-horizontal">
        <?php $this->load->config('paypal'); ?>
        <dt>Sandbox:</dt>
        <dd><?= config_item('Sandbox') ?></dd>
        <dt>APIVersion:</dt>
        <dd><?= config_item('APIVersion') ?></dd>
        <dt>APIUsername:</dt>
        <dd><?= config_item('APIUsername') ?></dd>
        <dt>APIPassword:</dt>
        <dd><?= config_item('APIPassword') ?></dd>
        <dt>APISignature:</dt>
        <dd><?= config_item('APISignature') ?></dd>
        <dt>PayFlowUsername:</dt>
        <dd><?= config_item('PayFlowUsername') ?></dd>
        <dt>PayFlowPassword:</dt>
        <dd><?= config_item('PayFlowPassword') ?></dd>
        <dt>PayFlowVendor:</dt>
        <dd><?= config_item('PayFlowVendor') ?></dd>
        <dt>PayFlowPartner:</dt>
        <dd><?= config_item('PayFlowPartner') ?></dd>
        <dt>ApplicationID:</dt>
        <dd><?= config_item('ApplicationID') ?></dd>
        <dt>DeviceID:</dt>
        <dd><?= config_item('DeviceID') ?></dd>
        <dt>DeviceIpAddress:</dt>
        <dd><?= config_item('DeviceIpAddress') ?></dd>
        <dt>DeveloperEmailAccount:</dt>
        <dd><?= config_item('DeveloperEmailAccount') ?></dd>
    </dl>


    <hr>
    <h3>Database</h3>

    <dl class="dl-horizontal">
        <dt>Database [default]</dt>
        <dd>
            <ul>
                <li>dsn: <?= $this->db->dsn ?></li>
                <li>hostname: <?= $this->db->hostname ?></li>
                <li>username: <?= $this->db->username ?></li>
                <li>password: <?= $this->db->password ?></li>
                <li>database: <?= $this->db->database ?></li>
                <li>dbdriver: <?= $this->db->dbdriver ?></li>
                <li>dbprefix: <?= $this->db->dbprefix ?></li>
                <li>pconnect: <?= $this->db->pconnect ? 'true' : 'false' ?></li>
                <li>db_debug: <?= $this->db->db_debug ? 'true' : 'false' ?></li>
                <li>cache_on: <?= $this->db->cache_on ? 'true' : 'false' ?></li>
                <li>cachedir: <?= $this->db->cachedir ?></li>
                <li>char_set: <?= $this->db->char_set ?></li>
                <li>dbcollat: <?= $this->db->dbcollat ?></li>
                <li>swap_pre: <?= $this->db->swap_pre ?></li>
                <li>encrypt: <?= $this->db->encrypt ? 'true' : 'false' ?></li>
                <li>compress: <?= $this->db->compress ? 'true' : 'false' ?></li>
                <li>stricton: <?= $this->db->stricton ? 'true' : 'false' ?></li>
                <li>failover: <?php var_dump($this->db->failover) ?></li>
                <li>save_queries: <?= $this->db->save_queries ? 'true' : 'false' ?></li>
            </ul>
        </dd>
    </dl>

    <hr>
    <h3>CodeIgniter Configuration</h3>

    <dl class="dl-horizontal">
        <?php vdump($this->config->config) ?>
    </dl>


    <?php include_once 'footer.php' ?>

</div>

<?php include_once 'script.php' ?>
<script>
    $(function () {
        $('dd').each(function () {
            if ($(this).text().toString() === 'true') {
                var label = $('<label class="label label-success">').text('TRUE');
                $(this).html(label);
            }
            if ($(this).text().toString() === 'false') {
                var label2 = $('<label class="label label-danger">').text('FALSE');
                $(this).html(label2);
            }
        })
    });
</script>

</body>
</html>