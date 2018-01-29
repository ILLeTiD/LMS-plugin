<?php
$formType = $slide->forms_type;
?>
<h1><?= $formType ?></h1>
<pre>
    <?php d($slide->forms_answers); ?>
</pre>