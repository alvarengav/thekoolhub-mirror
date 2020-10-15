<? 
$langActive = false; 
$langsArr = array();
$langsStr = array();
foreach ($fields as $field) : 
  if (substr($field->name, -5) == '_lang') 
  {
  	$rr = str_replace('_lang', '', $field->name);
  	$langsArr[$rr] = $rr;
  	$langsStr[] = "'{$rr}'";
  	$langActive = true;
  }
endforeach; 
?>class <?= ucfirst($function) ?>Model extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "<?= $table ?>";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.<?= $idtable ?> as id, t.*<? $g = 1; $f = 1; $i = 0; $in = 0; foreach ($fields as $field) : ?><? if(substr($field->name,0,7) == 'id_file') : ?>,
    lj<?= $i ?>.file as fm<?= $f?>file, lj<?= $i ?>.id_type as fm<?= $f?>type, lj<?= $i ?>.name as fm<?= $f?>name<? $i++; $f++;   
    elseif(substr($field->name,0,10) == 'id_gallery') : ?>, 
    (select count(*) as total from nz_gallery_file gf where gf.id_gallery  = t.<?= $field->name ?>) as fmg<?= $g ?><? 
    $g++; 
    elseif($field->type == 'text') : false; elseif(substr($field->name,0,3) == 'id_' && substr($field->name,0,10) != 'id_gallery') : ?>,
    lj<?= $i ?>.<?= set_value('lj'.$in.'-text') ?> as <?= substr($field->name,3) ?><? $in++; $i++; endif ?><? endforeach ?>
    
    FROM {$this->table} as t<? $i = 0; $in = 0; foreach ($fields as $field) : ?><? if(substr($field->name,0,3) == 'id_') : ?><? if( substr($field->name,0,10) != 'id_gallery') : ?>
    
    LEFT JOIN <?= (substr($field->name,0,7) == 'id_file') ? 'nz_file' : set_value('lj'.$in) ?> lj<?= $i ?> on t.<?= $field->name ?> = lj<?= $i ?>.<?= (substr($field->name,0,7) == 'id_file') ? 'id_file' : set_value('lj'.$in.'-id') ?>  <? $i++; if(substr($field->name,0,7) != 'id_file') $in++; endif; endif ?><? endforeach ?>
    
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t<? $i = 0; $in = 0; foreach ($fields as $field) : ?><? if(substr($field->name,0,3) == 'id_' && substr($field->name,0,10) != 'id_gallery') : ?>
    
    LEFT JOIN <?= (substr($field->name,0,7) == 'id_file') ? 'nz_file' : set_value('lj'.$in) ?> lj<?= $i ?> on t.<?= $field->name ?> = lj<?= $i ?>.<?= (substr($field->name,0,7) == 'id_file') ? 'id_file' : set_value('lj'.$in.'-id') ?> <? $i++; if(substr($field->name,0,7) != 'id_file') $in++; endif ?><? endforeach ?>

    WHERE $where";
    return $this->db->query($sql)->row()->total;
  }
  
  private function ListWhere($filter = false)
  {
    $sql = "1";
    if(!$filter) 
      return $sql;  
    $text = $this->input->post('filter-text') ? $this->input->post('filter-text') : false;          
    if(!$text)      
      $text = $this->input->post('sSearch') ? $this->input->post('sSearch') : false;
    <? $i = 0; $rTexts = array(); foreach ($fields as $field) : ?><? 
    if($field->type == 'boolean' || $field->type == 'bit' || ($field->type == 'tinyint' && $field->max_length == 1 && substr($field->name,0,3) != 'id_') ) :?>if($this->input->post('filter-<?= $field->name ?>'))
      $sql .= " AND t.<?= $field->name ?> = '1'";
    <? elseif($field->type == 'tinyint' || $field->type == 'smallint' || $field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' || $field->type == 'decimal' || $field->type == 'double') : if(substr($field->name,0,3) == 'id_' && substr($field->name,0,7) != 'id_file') : ?>if($this->input->post('filter-<?= $field->name ?>'))
      $sql .= " AND t.<?= $field->name ?> = '". $this->input->post('filter-<?= $field->name ?>') ."'";
    <? $i++; endif?><? elseif($field->type == 'boolean' || $field->type == 'bit') : ?>
if($this->input->post('filter-<?= $field->name ?>'))
      $sql .= " AND t.<?= $field->name ?> = '1'";
    <? elseif(($field->type == 'varchar' || $field->type == 'text') && substr($field->name, -5) != '_lang') : $rTexts[] = $field; ?><? endif ?><? endforeach ?><? if( count($rTexts)): ?>
if($text)
      <? $strTexts = ''; foreach($rTexts as $field) 
        $strTexts .= ( $strTexts ? " OR " : "") . " t.{$field->name} like '%{". "$" . "text}%' ";
      ?>$sql .= " AND (<?= $strTexts ?> OR t.<?= $idtable ?> = '{$text}') ";<? endif ?>   
    if($this->input->post('filter-id'))
      $sql .= " AND t.<?= $idtable ?> = '". $this->input->post('filter-id') ."'";  
    return $sql;
  }  
  
  public function JSON()
  {
    $total = $this->ListTotal();
    $total2 = $this->ListTotal(true);
    $json = $this->ListItems();
    $sEcho = $this->input->post('sEcho');
    return '{"sEcho":' . $sEcho . ',"iTotalRecords": '. $total .',"iTotalDisplayRecords": '. $total2 .',"aaData":' . json_encode($json) . '}';
  }
  
  public function DataSelects()
  {
    return array(<? $i = 0; foreach ($fields as $field) : ?><? if(substr($field->name,0,3) == 'id_'): if( substr($field->name,0,7) != 'id_file' && substr($field->name,0,10) != 'id_gallery') : ?>

      '<?= TableToModel(set_value('lj'.$i)) ?>' => $this->Data-><?= TableToModel(set_value('lj'.$i)) ?>('', $this->lang->line('Selecciona una opción')),<?  $i++; endif; endif ?><? endforeach ?>
      
    );
  }
  
  public function ValidationRules()
  {
    return array(<? 
$fieldName = false;
foreach ($fields as $field) : if($field->type == 'varchar' && !$fieldName) $fieldName = $field->name;
  if( !$field->primary_key ) : if(substr($field->name,0,7) == 'id_file' || $field->type == 'text' || substr($field->name,0,10) == 'id_gallery') : ?><? if(substr($field->name, -5) != '_lang'): ?>
			
      array(
       'field'   => '<?= $field->name ?>', 
       'label'   => $this->lang->line('<?= $field->label ?>'), 
       'rules'   => 'trim'
      ),<? endif ?><? elseif($field->type == 'boolean' || ($field->type == 'tinyint' && $field->max_length == 1) || $field->type == 'bit'): ?>

      array(
       'field'   => '<?= $field->name ?>', 
       'label'   => $this->lang->line('<?= $field->label ?>'), 
       'rules'   => 'trim'
      ),<? elseif( ($field->type == 'tinyint' || $field->type == 'smallint' || $field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' || $field->type == 'decimal' || $field->type == 'double') ): ?>

      array(
       'field'   => '<?= $field->name ?>', 
       'label'   => $this->lang->line('<?= $field->label ?>'), 
       'rules'   => 'trim|numeric'
      ),<? else :?><? if(substr($field->name, -5) != '_lang'): ?>

      array(
       'field'   => '<?= $field->name ?>', 
       'label'   => $this->lang->line('<?= $field->label ?>'), 
       'rules'   => 'trim'      
      ),<? endif ?><? endif ?>
<? endif ?><? endforeach ?>

    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT <?= $fieldName ? $fieldName : $idtable ?> as `name`
    FROM {$this->table}
    WHERE <?= $idtable ?> = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where <?= $idtable ?> = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['<?= $idtable ?>']);    
<? $f = 1; $i = 0; foreach ($fields as $field) : ?><? if( substr($field->name,0,10) == 'id_gallery' && ($field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
    if($row['<?= $field->name ?>'])
    {
      $oldID = $row['<?= $field->name ?>'];
      $row['<?= $field->name ?>'] = $this->MApp->CreateGallery();
      $this->MApp->DuplicateGallery($oldID,$row['<?= $field->name ?>']);
    }<? endif ?><? endforeach ?>    
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    return $idn;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
<? $f = 1; $i = 0; foreach ($fields as $field) : ?><? if($field->type == 'date') : ?>
      '<?= $field->name ?>' => human_to_mysql($this->input->post('<?= $field->name ?>')),
<? elseif($field->type == 'time') : ?>
      '<?= $field->name ?>' => $this->input->post('<?= $field->name ?>'),
<? elseif( (substr($field->name,0,7) == 'id_file' || substr($field->name,0,10) == 'id_gallery') && ($field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
      '<?= $field->name ?>' => $this->input->post('<?= $field->name ?>'),
<? $f++; $i++; elseif( substr($field->name,0,3) == 'id_' && ($field->type == 'tinyint' || $field->type == 'smallint' || $field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
      '<?= $field->name ?>' => $this->input->post('<?= $field->name ?>'),
<? $i++; elseif($field->type == 'text') : ?><?php if (substr($field->name, -5) != '_lang' && !isset($langsArr[$field->name])): ?>
      '<?= $field->name ?>' => $this->input->post('<?= $field->name ?>'),
<? endif ?><? elseif($field->type == 'boolean' || ($field->type == 'tinyint' && $field->max_length == 1) || $field->type == 'bit') : ?>
      '<?= $field->name ?>' => $this->input->post('<?= $field->name ?>') ? 1 : 0,
<? elseif($field->type == 'tinyint' || $field->type == 'smallint' || $field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint'  || $field->type == 'decimal' || $field->type == 'double' ) : ?>
      '<?= $field->name ?>' => $this->input->post('<?= $field->name ?>'),
<? elseif($field->type != 'timestamp') : ?><?php if (substr($field->name, -5) != '_lang' && !isset($langsArr[$field->name])): ?>
      '<?= $field->name ?>' => $this->input->post('<?= $field->name ?>'),
<? endif ?><? endif ?><? endforeach ?>
    );
    <?php if ($langActive): ?>   	
    $fields = array(<?= implode(', ', $langsStr) ?>);
    foreach($fields as $f)
    {
      $data[$f] = '';
      $json = array();
      foreach($this->langs as $key => $l)
      {
        $json[$l] = $this->input->post($f . '_' . $l);
        if(!$key)
          $data[$f] = $this->input->post($f . '_' . $l);
      }
      $data[$f . '_lang'] = json_encode($json);
    }    	

<?php endif ?>
<? $f = 1; $i = 0; foreach ($fields as $field) : ?><? if( substr($field->name,0,10) == 'id_gallery' && ($field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
    $gitems = explode(',', $this->input->post('<?= $field->name ?>-items'));
    if($data['<?= $field->name ?>'])
      $this->MApp->EmptyGallery($data['<?= $field->name ?>']);
    if(count($gitems))
    {
      if(!$this->input->post('<?= $field->name ?>'))
        $data['<?= $field->name ?>'] = $this->MApp->CreateGallery();
      $this->MApp->AddGalleryItems($data['<?= $field->name ?>'], $gitems);
    }    
<? endif ?><? endforeach ?>
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "<?= $idtable ?> = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE <?= $idtable ?> = '{$id}'";
    $this->db->query($sql);
<? $f = 1; $i = 0; foreach ($fields as $field) : ?><? if( substr($field->name,0,10) == 'id_gallery' && ($field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
    //$this->MApp->DeleteGallery($data['<?= $field->name ?>']);
<? endif ?><? endforeach ?>
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.<?= $idtable ?> as id, t.*<? $f = 1; $i = 0;$in = 0; foreach ($fields as $field) : ?><? if(substr($field->name,0,7) == 'id_file') : ?>,
      lj<?= $i ?>.file as fm<?= $f?>file, lj<?= $i ?>.id_type as fm<?= $f?>type, lj<?= $i ?>.name as fm<?= $f?>name<? $i++; $f++; elseif(substr($field->name,0,3) == 'id_' && substr($field->name,0,10) != 'id_gallery') : ?>,
      lj<?= $i ?>.<?= set_value('lj'.$in.'-text') ?> as <?= substr($field->name,3) ?><? $i++; if(substr($field->name,0,7) != 'id_file') $in++; endif ?><? endforeach ?>
      
      FROM {$this->table} as t<? $i = 0; $in = 0;foreach ($fields as $field) : ?><? if(substr($field->name,0,7) == 'id_file') : ?>
      
      LEFT JOIN nz_file lj<?= $i ?> on t.<?= $field->name ?> = lj<?= $i ?>.id_file<? $i++; elseif(substr($field->name,0,3) == 'id_' && substr($field->name,0,10) != 'id_gallery') : ?>
      
      LEFT JOIN <?= set_value('lj'.$in) ?> lj<?= $i ?> on t.<?= $field->name ?> = lj<?= $i ?>.<?= set_value('lj'.$in.'-id') ?> <? $i++; $in++; endif ?><? endforeach ?>
      
      WHERE t.<?= $idtable ?> = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
<? $f = 1; $i = 0; foreach ($fields as $field) : ?><? if($field->type == 'date') : ?>
    $ret['<?= $field->name ?>'] = $this->input->post() ? human_to_mysql($this->input->post('<?= $field->name ?>')) : date('Y-m-d');
<? elseif($field->type == 'time') : ?>
    $ret['<?= $field->name ?>'] = $this->input->post() ? $this->input->post('<?= $field->name ?>') : '00:00';
<? elseif( (substr($field->name,0,7) == 'id_file' || substr($field->name,0,10) == 'id_gallery') && ($field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
    $ret['<?= $field->name ?>'] = $this->input->post() ? $this->input->post('<?= $field->name ?>') : '';
<? $f++; $i++; elseif( substr($field->name,0,3) == 'id_' && ($field->type == 'tinyint' || $field->type == 'smallint' || $field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
    $ret['<?= $field->name ?>'] = $this->input->post() ? $this->input->post('<?= $field->name ?>') : '';
<? $i++; elseif($field->type == 'text') : ?><?php if (substr($field->name, -5) != '_lang'): ?>
    $ret['<?= $field->name ?>'] = $this->input->post() ? $this->input->post('<?= $field->name ?>') : '';
<? endif ?><? elseif($field->type == 'boolean' || ($field->type == 'tinyint' && $field->max_length == 1) || $field->type == 'bit') : ?>
    $ret['<?= $field->name ?>'] = $this->input->post('<?= $field->name ?>') ? 1 : 0;
<? elseif($field->type == 'tinyint' || $field->type == 'smallint' || $field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint'  || $field->type == 'decimal' || $field->type == 'double' ) : ?>
    $ret['<?= $field->name ?>'] = $this->input->post() ? $this->input->post('<?= $field->name ?>') : '';
<? elseif($field->type != 'timestamp') : ?><?php if (substr($field->name, -5) != '_lang'): ?>
    $ret['<?= $field->name ?>'] = $this->input->post() ? $this->input->post('<?= $field->name ?>') : '';
<? endif ?><? endif ?><? endforeach ?>
    return $ret;
  }

}