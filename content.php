<?php

$sections = carbon_get_the_post_meta('crb_sections');
foreach ($sections as $section) {
    switch ($section['_type']) {
        case 'text':
            ?>
            <div class="section-text">
                <?= wpautop($section['text']) ?>
            </div>
            <?php
            break;
        
        case 'codepen':
            $title = $section['title'];
            $html = $section['html'];
            $css = $section['css'];
            $js = $section['js'];
            ?>
            <div class="card-group codeview">
                <div class="card codeview__preview-card">
                    <div class="card-body">
                        <iframe id="<?= $title ?>" class="codeview__preview-frame"></iframe>
                    </div>
                </div>
                <div class="card codeview__code">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills" id="<?= $title ?>Tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" role="tab" id="<?= $title ?>-tab-html" href="#<?= $title ?>-html">HTML</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" id="<?= $title ?>-tab-css"  href="#<?= $title ?>-css" >CSS</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" id="<?= $title ?>-tab-js"   href="#<?= $title ?>-js"  >JS</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="<?= $title ?>TabContent">
                            <div class="tab-pane fade active show" role="tabpanel" id="<?= $title ?>-html">
                                <code><pre><?= $html ?></pre></code>
                            </div>
                            <div class="tab-pane fade" role="tabpanel" id="<?= $title ?>-css">
                                <code><pre><?= $css ?></pre></code>
                            </div>
                            <div class="tab-pane fade" role="tabpanel" id="<?= $title ?>-js">
                                <code><pre><?= $js ?></pre></code>
                            </div>                   
                        </div>
                    </div>
                </div>
            </div>

            <script>
                let iframe = document.getElementById('<?= $section['title'] ?>').contentWindow.document;
                iframe.open();
                iframe.write(`<style><?= $css ?></style>`);
                iframe.write(`<body><?= $html ?></body>`);
                iframe.write(`<script><?= $js ?><\/script>`);
                iframe.close();
            </script>
            <?php
    }
}
