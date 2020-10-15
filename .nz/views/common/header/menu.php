<aside id="left-panel">
  <nav>
    <div class="menu-logo"><? $this->load->view("common/header/logo") ?></div>
    <ul class="menu">
      <?
      $appMenu = $this->MApp->GetAppMenu();
      foreach($appMenu as $m):
      $appSubmenu = $this->MApp->GetAppSubmenu($m->id);
      $count = 0;
      foreach($appSubmenu as $s) if( $this->MApp->root || ( $s->aview && $s->view ) ) $count++;
      if($count):
      ?>
      <li>
        <a href="javascript:void(0)" class="<?= "item-{$m->controller}" ?>"><? if(strpos($m->ico, 'material-icons') === FALSE):?><i class="nav-ico <?= $m->ico ?>"></i><? else: ?><?= $m->ico ?><? endif ?> <span class="menu-item-parent"><?= $this->lang->line($m->name) ?></span><? if($count>1 && false):?><span class="badge"><?= $count ?></span><? endif ?></a>
        <ul>
          <? foreach($appSubmenu as $s): if( $this->MApp->root || ( $s->aview && $s->view ) ): ?>
          <li>
            <a href="<?= base_url() . $m->controller . "/" . $s->function ?>" class="app-loader <?= "item-{$m->controller}-{$s->function}" ?>"><span class="menu-item-parent"><?= $this->lang->line($s->name) ?></span></a>
          </li>
          <? endif; endforeach ?>
        </ul>
      </li>
      <? endif ?>
      <? endforeach ?>
    </ul>
    <div class="minifyme-contanier">
      <span class="minifyme"><i class="fa fa-arrow-circle-left hit"></i></span>
    </div>
  </nav>
</aside>