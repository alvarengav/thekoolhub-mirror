<script type='text/javascript' src='<?= layout() ?>vendor/Box2dWeb-2.1.a.3.min.js'></script>
<script type='text/javascript' src='<?= layout() ?>vendor/createjs.min.js'></script>
<div class="animation-intro requiere-white-header">
    <div class="center">
        <? $this->load->view('components/animation/logo') ?>
    </div>

    <!-- <div id="ls">
  <svg xmlns="http://www.w3.org/2000/svg" width="502.299" height="117.262" viewBox="0 0 502.299 117.262">
  <g transform="translate(0.381 0.04)">
    <path id="v" d="M213.7,342.852h19.779l-41.74,110.424h-19L131.619,342.852h20.245L182.7,428.824Z" transform="translate(-132 -339)"/>
  </g>
</svg>
</div> -->
    <div class="bottomrigth">
        <div>
            <?= $this->Data->lang('agència <br> de comunicació <br> del mon del vi') ?> <br>
        </div>
    </div>
    
    <div class="down">
        <img src="<?= layout('img/angle-down.png') ?>" class="no-select">
    </div>

    <div class="container-waves">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#b10832" />
            </g>
        </svg>
    </div>
</div>
