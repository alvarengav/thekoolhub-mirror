
  public function <?= TableToModel(set_value('lj'.$index)) ?>( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT <?= set_value('lj'.$index.'-id') ?> as id, <?= set_value('lj'.$index.'-text') ?> as el FROM <?= set_value('lj'.$index) ?> $where order by el"), $all);
  }
