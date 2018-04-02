<?php
$subject = array_get($settings, "email_templates.{$name}.subject");
$body = stripslashes(array_get($settings, "email_templates.{$name}.body"));
?>
<input type="text"

       name="settings[email_templates][<?= $name; ?>][subject]"
       class="lms-email-template__subject"
       placeholder="<?= __('Type email subject...', 'lms-plugin'); ?>"
       value="<?= $subject; ?>"
>

<?=
wp_editor(
    $body,
    'email_template_' . $name, [
        'media_buttons' => false,
        'textarea_name' => "settings[email_templates][{$name}][body]",
        'textarea_rows' => 5
    ]
);
?>

