<?php
class AppFactory
{
  const APP_PREFIX = 'appmk_';
  private $instance = null;
  public $boats_metakeys = array();

  public function __construct()
  {
    $this->instance = $this->init();

    return $this;
  }

  protected function init()
  {
    $this->boats_metakeys = array(
      APP_PREFIX.'gyartasi_ev' => array(
        'label' => __('Gyártási év', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => false,
        'param' => true,
      ),
      APP_PREFIX.'hossza' => array(
        'label' => __('Hossz', TD),
        'value_before' => false,
        'value_after' => ' m',
        'in_list' => true,
        'list_label' => __('Hossz', TD),
        'param' => true,
      ),
      APP_PREFIX.'hossza' => array(
        'label' => __('Szélesség', TD),
        'value_before' => false,
        'value_after' => ' m',
        'in_list' => false,
        'param' => true,
      ),
      APP_PREFIX.'merules' => array(
        'label' => __('Merülés', TD),
        'value_before' => false,
        'value_after' => ' m',
        'in_list' => false,
        'param' => true,
      ),
      APP_PREFIX.'max_utasok' => array(
        'label' => __('Utas kapacitás', TD),
        'value_before' => false,
        'value_after' => ' fő',
        'in_list' => true,
        'list_label' => __('Utas', TD),
        'param' => true,
      ),
      APP_PREFIX.'hon_kikoto' => array(
        'label' => __('Hon kikötő', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => false,
        'param' => true,
      ),
      APP_PREFIX.'kabin' => array(
        'label' => __('Kabin', TD),
        'value_before' => false,
        'value_after' => ' db',
        'in_list' => true,
        'list_label' => __('Kabin', TD),
        'param' => true,
      ),
      APP_PREFIX.'agyak' => array(
        'label' => __('Ágyak', TD),
        'value_before' => false,
        'value_after' => ' db',
        'in_list' => true,
        'list_label' => __('Ágyak', TD),
        'param' => true,
      ),
      APP_PREFIX.'wc' => array(
        'label' => __('WC', TD),
        'value_before' => false,
        'value_after' => ' db',
        'in_list' => true,
        'list_label' => __('WC', TD),
        'param' => true,
      ),
      APP_PREFIX.'ar' => array(
        'label' => __('Bérlés', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => true,
        'list_label' => __('Ár', TD),
        'param' => true,
      ),
    );
  }
}
?>
