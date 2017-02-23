<?php
  global $app;
  $params = $app->get_boats_metakeys();
?>
<table class="form-table">
    <tbody>
    <?php foreach ($params as $pk => $pv): if(!$pv['param']) continue;  $value = get_post_meta( $post->ID, $pk, true ); ?>
      <tr>
        <th><label for="<?=$pk?>"><?=$pv['label']?></label></th>
        <td>
          <?php echo $pv['value_before']; ?><input class="" id="<?=$pk?>" type="text" name="<?=$pk?>" value="<?php echo $value; ?>"><?php echo $pv['value_after']; ?>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php
       $value = (get_post_meta( $post->ID, $app::APP_PREFIX.'galleria_sc', true ));
    ?>
    <tr>
      <th><label for="<?=$app::APP_PREFIX.'galleria_sc'?>"><?=__('Galéria shorcode')?></label></th>
      <td>
        <textarea class="widefat" id="<?=$app::APP_PREFIX.'galleria_sc'?>" name="<?=$app::APP_PREFIX.'galleria_sc'?>" ><?php echo $value; ?></textarea>
      </td>
    </tr>
  </tbody>
</table>
