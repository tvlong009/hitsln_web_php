<?php

use yii\helpers\Html;
?>  
<div class="source_messages">
    <div id ="scroll" style='margin: 0 auto;' >
        <div class='col-md-6'>

            <?php
            usort($source_messages, function($a, $b){
                return strcmp($a->message, $b->message);
            });
            foreach ($source_messages as $source_message) {
                if ($source_message->category == 'app' && !empty($source_message->message)) {
                    ?>
                    <input type="text" name="current-language" id="<?php echo "sm_" . $source_message->id; ?>" 
                           value='<?php echo $source_message->message ?>' class="form-control" readonly>
                           <?php
                       }
                   }
                   ?>
        </div>
        <div class='col-md-6'>
            <?php
            foreach ($source_messages as $source_message) {
                $message = new \app\models\Message;
                $message = \app\models\Message::findOne(['id' => $source_message->id, 'language' => $lang]);
                if (!empty($message)) {
                    if ($source_message->category == 'app' && !empty($source_message->message)) {
                        ?>
                        <input type="text"  name="message_language" id="<?php echo"m_" . $message->id; ?>" 
                               value= '<?php echo $message->translation ?>' class="form-control">
                    <?php
                    }
                }
            }
            ?>

        </div>
    </div>
</div>