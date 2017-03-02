<div class="params">
  <?php foreach ($tour_params as $param): ?>
  <div class="param">
    <div class="head">
      <?php echo $param['name']; ?>
    </div>
    <div class="value">
        <?php echo $param['value']; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
