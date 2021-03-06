<?php
class AppFactory
{
  const APP_PREFIX = 'appmk_';
  private $instance = null;
  public $boats_metakeys = array();
  public $tours_metakeys = array();

  public function __construct()
  {
    $this->instance = $this->init();

    return $this;
  }

  public function get_boats_metakeys()
  {
    return $this->boats_metakeys;
  }

  public function get_tours_metakeys()
  {
    return $this->tours_metakeys;
  }

  protected function init()
  {
    $this->tours_metakeys = array(
      self::APP_PREFIX.'korosztaly' => array(
        'label' => __('Korosztály', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => false,
        'param' => true,
        'list_label' => __('Kiknek ajánljuk', TD),
        'global' => true
      ),
      self::APP_PREFIX.'ar_belfold' => array(
        'label' => __('Ár (Balatonon)', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => false,
        'param' => true,
        'list_label' => __('Részvételi díj', TD),
        'global' => false
      ),
      self::APP_PREFIX.'ar_kulfold' => array(
        'label' => __('Ár (Külföld)', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => false,
        'param' => true,
        'list_label' => __('Részvételi díj', TD),
        'global' => false
      ),
      self::APP_PREFIX.'reszvevok_belfold' => array(
        'label' => __('Résztvevők száma (Belföld)', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => false,
        'param' => true,
        'list_label' => __('Utasok száma (min-max)', TD),
        'global' => false
      ),
      self::APP_PREFIX.'reszvevok_kulfold' => array(
        'label' => __('Résztvevők száma (Külföld)', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => false,
        'param' => true,
        'list_label' => __('Utasok száma (min-max)', TD),
        'global' => false
      ),

      self::APP_PREFIX.'minido_belfold' => array(
        'label' => __('Minimális időtartam (Belföld)', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => false,
        'param' => true,
        'list_label' => __('Minimális időtartam', TD),
        'global' => false
      ),
      self::APP_PREFIX.'minido_kulfold' => array(
        'label' => __('Minimális időtartam (Külföld)', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => false,
        'param' => true,
        'list_label' => __('Minimális időtartam', TD),
        'global' => false
      ),
    );

    $this->boats_metakeys = array(
      self::APP_PREFIX.'hossza' => array(
        'label' => __('Hossz', TD),
        'value_before' => false,
        'value_after' => ' m',
        'in_list' => true,
        'list_label' => __('Hossz', TD),
        'param' => true,
      ),
      self::APP_PREFIX.'szelesseg' => array(
        'label' => __('Szélesség', TD),
        'value_before' => false,
        'value_after' => ' m',
        'in_list' => false,
        'param' => true,
      ),
      self::APP_PREFIX.'merules' => array(
        'label' => __('Merülés', TD),
        'value_before' => false,
        'value_after' => ' m',
        'in_list' => false,
        'param' => true,
      ),
      self::APP_PREFIX.'vitorlazat' => array(
        'label' => __('Vitorlázat', TD),
        'value_before' => false,
        'value_after' => ' nm',
        'in_list' => false,
        'param' => true,
      ),
      self::APP_PREFIX.'max_utasok' => array(
        'label' => __('Utas kapacitás', TD),
        'value_before' => false,
        'value_after' => ' fő',
        'in_list' => true,
        'list_label' => __('Utas', TD),
        'param' => true,
      ),
      self::APP_PREFIX.'hon_kikoto' => array(
        'label' => __('Hon kikötő', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => false,
        'param' => true,
      ),
      self::APP_PREFIX.'kabin' => array(
        'label' => __('Kabin', TD),
        'value_before' => false,
        'value_after' => ' db',
        'in_list' => true,
        'list_label' => __('Kabin', TD),
        'param' => true,
      ),
      self::APP_PREFIX.'agyak' => array(
        'label' => __('Ágyak', TD),
        'value_before' => false,
        'value_after' => ' db',
        'in_list' => true,
        'list_label' => __('Ágyak', TD),
        'param' => true,
      ),
      self::APP_PREFIX.'wc' => array(
        'label' => __('WC / Zuhany', TD),
        'value_before' => false,
        'value_after' => ' db',
        'in_list' => false,
        'list_label' => __('WC', TD),
        'param' => true,
      ),
      self::APP_PREFIX.'ar' => array(
        'label' => __('Bérlés', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => true,
        'list_label' => __('Ár', TD),
        'param' => true,
      ),
      self::APP_PREFIX.'galleria_sc' => array(
        'label' => __('Galéria shortcode', TD),
        'value_before' => false,
        'value_after' => false,
        'in_list' => true,
        'list_label' => __('Galéria shortcode', TD),
        'param' => false,
      ),
    );
  }
}
?>
