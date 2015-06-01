<?php

use yii\helpers\Html;
?>  
<div class="source_messages">
    <div id ="scroll" style='margin: 0 auto;' >
        <div class='col-md-6'>
            <?php
            foreach ($source_messages as $source_message) {
                if (!empty($source_message->message)) {
                    ?>
            <input type="text" title='<?php echo $source_message->message ?>'
                   name="current-language" id="<?php echo "sm_" . $source_message->id; ?>" 
                           value='<?php echo $source_message->message ?>' class="form-control" readonly>
                           <?php
                       }
                   }
                   ?>
        </div>
        <div class='col-md-6'>
            <?php foreach ($messages as $i => $message) { ?>
            <input type="text" title='<?php echo empty($message) ? '' : $message->translation ?>' 
                   name="message_language" id="<?php echo"m_" . $i; ?>" 
                       value= '<?php echo empty($message) ? '' : $message->translation ?>' class="form-control">
                <?php
            }
            ?>

        </div>
    </div>
</div>