<div class="form-group">
<label class="control-label" for=""><?php echo $model->property_name;?></label>
<?php
use app\models\UserProperty;
switch ($model->type) {
	case UserProperty::TYPE_STRING:
    case UserProperty::TYPE_PHONE:
?>			
		<input type="text" class="form-control" name="property[<?php echo $model->property_id?>]" value="<?php echo $value?>" />		
<?php
		break;
	case UserProperty::TYPE_SELECT :
?>
		<select name="property[<?php echo $model->property_id?>]" class="form-control">
			<?php
			if ($model->value != '') {
				$valueList = explode(',', $model->value);
				foreach ($valueList as $item) {
				?>
				<option <?php echo $item == $value ? 'selected' : ''; ?> value="<?php echo $item?>"><?php echo $item;?></option>
				<?php
				}
			} else {
			?>
			<option value=""><?php echo Yii::t('app', 'Please choose value');?></option>
			<?php
			}
			?>
		</select>
<?php
		break;
	case UserProperty::TYPE_SELECT_MULTIPLE:
?>
		<select name="property[<?php echo $model->property_id?>][]" multiple="multiple" class="form-control">
		<?php
		if ($model->value != '') {
			$valueList = explode(',', $model->value);
			foreach ($valueList as $item) {
			?>
			<option <?php
				if (is_array($value)) {
					echo in_array($item, $value) ? 'selected' : '';
				} 
			 ?> value="<?php echo $item?>"><?php echo $item;?></option>
			<?php
			}
		} else {
		?>
			<option value=""><?php echo Yii::t('app', 'Please choose value');?></option>
		<?php
		}
		?>
				</select>
<?php		
		break;
	case UserProperty::TYPE_CHECKBOX :
		if ($model->value != '') {
			$valueList = explode(',', $model->value);
			?>
			<div class="">
			<?php
			foreach ($valueList as $item) {
			?>
			<label>
			    <input <?php
				if (is_array($value)) {
					echo in_array($item, $value) ? 'checked' : '';
				} 
			 ?> type="checkbox" name="property[<?php echo $model->property_id?>][]" value="<?php echo $item;?>">
			    <?php echo $item;?>
			</label>
			<?php
			}
			?>
			</div>
			<?php
		}
		?>
<?php
		break;
    case UserProperty::TYPE_RADIO :
		if ($model->value != '') {
			$valueList = explode(',', $model->value);
			?>
			<div class="">
			<?php
			foreach ($valueList as $item) {
			?>
			<label>
			    <input <?php
				if (is_array($value)) {
					echo in_array($item, $value) ? 'checked' : '';
				} 
			 ?> type="radio" name="property[<?php echo $model->property_id?>][]" value="<?php echo $item;?>">
			    <?php echo $item;?>
			</label>
			<?php
			}
			?>
			</div>
			<?php
		}
        break;        
    case UserProperty::TYPE_EMAIL:
        ?>
        <input type="email" class="form-control" name="property[<?php echo $model->property_id?>]" value="<?php echo $value?>" />
        <?php
        break;
    case UserProperty::TYPE_URL:
        ?>
        <input type="url" class="form-control" name="property[<?php echo $model->property_id?>]" value="<?php echo $value?>" />
        <?php
        break;
    case UserProperty::TYPE_PASSWORD:
        ?>
        <input type="password" class="form-control" name="property[<?php echo $model->property_id?>]" value="<?php echo $value?>" />
        <?php
        break;
}
?>
</div>