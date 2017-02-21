<?php
  global $app;
  $params = $app->get_tours_metakeys();
?>
<table class="form-table">
    <tbody>
    <?php foreach ($params as $pk => $pv): $value = get_post_meta( $post->ID, $pk, true ); ?>
      <tr>
        <th><label for="<?=$pk?>"><?=$pv['label']?></label></th>
        <td>
          <?php echo $pv['value_before']; ?><input class="" id="<?=$pk?>" type="text" name="<?=$pk?>" value="<?php echo $value; ?>"><?php echo $pv['value_after']; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
