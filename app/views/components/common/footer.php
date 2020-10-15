<footer class="footer" id="footer">
    <div class="container">
        <div class="d-flex">

            <div class="text">

                <b><?= $this->Data->lang('CONTACTE') ?></b> <br>
                <?= $config->address1 ?> <br>
                <?= $config->address2 ?> <br>
                <br>
                <a href="tel:<?= $config->phone ?>"><?= $config->phone ?></a> <br>
                <a href="mailto:<?= $config->mail ?>"><?= $config->mail ?></a> <br>

                
                <div class="social">
                    <? if($config->facebook): ?><a target="_blank" href="https://facebook.com/<?= $config->facebook ?>"><i class="fa fa-facebook"></i></a><? endif ?>
                    <? if($config->instagram): ?><a target="_blank" href="https://www.instagram.com/<?= $config->instagram ?>"><i class="fa fa-instagram"></i></a><? endif ?>
                    <? if($config->twitter): ?><a target="_blank" href="https://twitter.com/<?= $config->twitter ?>"><i class="fa fa-twitter"></i></a><? endif ?>
                    <? if($config->linkedin): ?><a target="_blank" href="https://linkedin.com/<?= $config->linkedin ?>"><i class="fa fa-linkedin"></i></a><? endif ?>
                </div>

            </div>

            <? $info_pages = $this->Data->GetInfoPages();
               $terms = false;  ?>
            <? if($info_pages): ?>
            <div class="text2">
                <b><?= $this->Data->lang('INFORMATION') ?></b> <br>
                <? foreach($info_pages as $i) :
                    if (
                        strpos( strtolower($i->title), 'terms') !== false
                        || strpos( strtolower($i->title), 'términos') !== false
                        || strpos( strtolower($i->title), 'termes') !== false
                        ) 
                        $terms = $i;
                        ?>
                    <a href="<?= $i->link ?>"><?= $i->title ?></a> <br>
                    <? endforeach; 
                    ?>
                    <? if(count($languages)>1): ?>
                        <div class="dlang">

                            <br>
                            <span style="float:left; margin-top: 7px; margin-right: 8px;"><svg fill="#b5043a" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30px" height="30px"><path d="M 5 3 C 3.9069372 3 3 3.9069372 3 5 L 3 16 C 3 17.093063 3.9069372 18 5 18 L 7 18 L 12 18 L 12 22 L 8 22 L 8 19 L 7 18 L 6 19 L 6 22 L 8 24 L 12 24 L 12 25 C 12 26.105 12.895 27 14 27 L 25 27 C 26.105 27 27 26.105 27 25 L 27 14 C 27 12.895 26.105 12 25 12 L 18 12 L 18 5 C 18 3.9069372 17.093063 3 16 3 L 5 3 z M 5 5 L 16 5 L 16 12 L 14 12 C 12.895 12 12 12.895 12 14 L 12 16 L 5 16 L 5 5 z M 12 14 L 12 13 C 11.755293 13 11.521351 12.969766 11.291016 12.933594 C 11.314874 12.916254 11.341774 12.902596 11.365234 12.884766 C 12.436415 12.070668 13 10.75101 13 9 L 14 9 L 14 8 L 11 8 L 11 6.5 L 10 6.5 L 10 8 L 7 8 L 7 9 L 12 9 C 12 10.54899 11.563585 11.478941 10.759766 12.089844 C 10.53998 12.25688 10.278088 12.396887 9.9902344 12.517578 C 9.667359 12.357894 9.3640918 12.177141 9.109375 11.962891 C 8.3922951 11.359732 8 10.591752 8 10 L 7 10 C 7 10.997248 7.5736736 11.978924 8.4648438 12.728516 C 8.5238513 12.778149 8.5962189 12.817683 8.6582031 12.865234 C 8.1567671 12.945359 7.6170728 13 7 13 L 7 14 C 8.1153185 14 9.1081165 13.884672 9.9570312 13.605469 C 10.57585 13.850013 11.261979 14 12 14 z M 18.402344 15.976562 L 20.59375 15.976562 L 22.962891 23.023438 L 21.009766 23.023438 L 20.570312 21.474609 L 18.269531 21.474609 L 17.816406 23.023438 L 16.039062 23.023438 L 18.402344 15.976562 z M 19.382812 17.564453 L 18.611328 20.185547 L 20.232422 20.185547 L 19.476562 17.564453 L 19.382812 17.564453 z"/></svg></span>
                            <span>
                                
                                <? foreach($languages as $key => $value) : if($key!=$lang): ?>
                                    <a href="<?= base_url($key) ?>"><?= $value ?></a> <br>
                                    <? endif; ?>
                                </span>
                                <? endforeach; ?>
                            </div>
                    <? endif; ?>

                
            </div>
            <? endif; ?>
            
            <div class="form">
                <form class="ajaxForm" id="form-sub" action="<?= base_url('ajax_subscribe') ?>">
                    <b class="t"><?= $this->Data->lang('SIGN UP FOR OUR NEWSLETTER') ?></b>
                    <input name="lang" type="hidden" value="<?= $language ?>" class="form-control">
                    <div class="form-group"><input placeholder="<?= $this->Data->lang('Name and Surname') ?>" name="name" type="text" class="form-control"></div>
                    <div class="form-group"><input placeholder="<?= $this->Data->lang('Bussines') ?>" name="bussines" type="text" class="form-control"></div>
                    <div class="form-group"><input placeholder="<?= $this->Data->lang('Email') ?>" name="mail" type="text" class="form-control"></div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="customCheck" id="5debea3fa0df5_customCheck3">
                        
                        <label class="custom-control-label" for="5debea3fa0df5_customCheck3"><?= $this->Data->lang('I accept') ?> <a href="<?= $terms ? $terms->link : '' ?>"><?= $this->Data->lang('terms and conditions') ?></a></label>
                    </div>
                    <button class="btn btn-block btn-primary"><?= $this->Data->lang('SEND') ?></button>
                </form>
                
                <script>
                    ajaxFormCallback['success-subscribe'] = function() {
                        $('#form-sub').css({
                            'opacity': '0.8',
                            'pointer-events': 'none',
                        });
                        $('#form-sub button').css({
                            'pointer-events': 'none',
                            'background': 'gray',
                            'border-color': 'gray',
                        }).html('<?= $this->Data->lang('Thanks for subscribe') ?> <i class="fa fa-heart"></i>');
                    };
                </script>
            </div>

        </div>
    </div>
</footer>
<? /*<div class="footer-bottom copyidentty">
  <div class="container">
      <div class="d-flex justify-content-between align-items-center">

          <div class="footer-rights">Vilateral © Copyright <?= date('Y') ?>. Todos los derechos reservados.</div>
          
          <div class="footer-developer">
              Work done by
              <a class="footer-developer-logo" href="http://weareidentty.com/" target="_blank">
              <img src="<?= layout('img/identty.png') ?>" alt="Identty">
            </a>
        </div>
    </div>
  </div>
</div>
*/ ?>