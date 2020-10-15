<header class="header">
  <div class="container">
      <div class="menu">
      <a class="invisible-logo" href="<?= base_url($lang) ?>">
        <span>Vilateral</span>
        <? $this->load->view('components/common/logo') ?>
      </a>
      
      <div class="rmenu-btn">
        <div class="bars"></div>
      </div>

      <div class="social" data-rmenu-add="6">
        
        <? if($config->facebook): ?><a target="_blank" href="https://facebook.com/<?= $config->facebook ?>"><i class="fa fa-facebook"></i></a><? endif ?>
        <? if($config->instagram): ?><a target="_blank" href="https://www.instagram.com/<?= $config->instagram ?>"><i class="fa fa-instagram"></i></a><? endif ?>
        <? if($config->twitter): ?><a target="_blank" href="https://twitter.com/<?= $config->twitter ?>"><i class="fa fa-twitter"></i></a><? endif ?>
        <? if($config->linkedin): ?><a target="_blank" href="https://linkedin.com/<?= $config->linkedin ?>"><i class="fa fa-linkedin"></i></a><? endif ?>
      </div>

      <div class="select_lang">
      <select id="lang" name="lang" class="none select2">
        <? 
        foreach($config->header_langs as $value):  ?>
          <option value="<?= $value->lang ?>" <? if($value->lang==$lang) echo 'selected' ?>><?= $value->text ?></option>
        <? endforeach ?>
      </select>
    </div>
    </div>
  </div>
</header>
<div class="header-bg"></div>
<div style="display:none">
  <a href="<?= base_url($lang.'/') ?>" data-rmenu-add="0"><?= $this->Data->lang('Home') ?></a>

  <?
    if($this->data['lang']=='es') {
      $section = 'servicios';
    } else if($this->data['lang']=='ca') {
      $section = 'serveis';
    } else {
      $section = 'services';
    }
  ?>
  <a href="<?= base_url($lang.'/'.$section) ?>" data-rmenu-add="1"><?= $this->Data->lang('Serveis') ?></a>

  <?
    if($this->data['lang']=='es') {
      $section = 'proyectos';
    } else if($this->data['lang']=='ca') {
      $section = 'projectes';
    } else {
      $section = 'projects';
    }
  ?>
  <a href="<?= base_url($lang.'/'.$section) ?>" data-rmenu-add="2"><?= $this->Data->lang('Clients') ?></a>
  <? if($config->active_blog): ?>
    <a href="<?= base_url($lang.'/blog') ?>" data-rmenu-add="3"><?= $this->Data->lang('Blog') ?></a>
  <? endif ?>

  
  <?
    if($this->data['lang']=='es') {
      $section = 'equipo';
    } else if($this->data['lang']=='ca') {
      $section = 'equip';
    } else {
      $section = 'team';
    }
  ?>
  <a h
  <a href="<?= base_url($lang.'/'.$section) ?>" data-rmenu-add="4"><?= $this->Data->lang('Equip') ?></a>
</div>


<script>
	$(document).ready(function() {
    $('#lang').change(function() {
      var lang = $(this).val();
      location.href = '<?= base_url() ?>'+lang;
    });
	});
</script>