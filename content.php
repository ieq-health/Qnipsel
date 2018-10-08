<?php

$sections = carbon_get_the_post_meta('crb_sections');
foreach ($sections as $section) {
    switch ($section['_type']) {
        case 'text':
            ?>
            <div class="section-text p-4">
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
            <div class="card codeview__code">
                <div class="card-header p-0">
                    <ul class="nav nav-pills card-header-pills justify-content-center" id="<?= $title ?>Tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" role="tab" id="<?= $title ?>-tab-preview" href="#<?= $title ?>-preview">Vorschau</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" id="<?= $title ?>-tab-html" href="#<?= $title ?>-html">HTML</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" id="<?= $title ?>-tab-css"  href="#<?= $title ?>-css" >CSS</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" id="<?= $title ?>-tab-js"   href="#<?= $title ?>-js"  >JS</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="<?= $title ?>TabContent">
                        <div class="tab-pane fade active show" role="tabpanel" id="<?= $title ?>-preview">
                            <iframe id="<?= $title ?>" class="codeview__preview-frame"></iframe>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="<?= $title ?>-html">
                            <pre><code data-language="html"><?= $html ?></code></pre>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="<?= $title ?>-css">
                            <pre><code data-language="css"><?= $css ?></code></pre>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="<?= $title ?>-js">
                            <pre><code data-language="javascript"><?= $js ?></code></pre>
                        </div>                   
                    </div>
                </div>
                <div class="card-footer px-2 pb-2 pt-1">
                    <?php if (in_array('bootstrap', $section['css_libs'])): ?>
                    <span class="badge badge-pill badge-info">CSS: Bootstrap</span>
                    <?php endif; ?>
                    <?php if (in_array('bootstrap', $section['js_libs'])): ?>
                    <span class="badge badge-pill badge-warning">JS: Bootstrap</span>
                    <?php endif; ?>
                    <?php if (in_array('jquery', $section['js_libs'])): ?>
                    <span class="badge badge-pill badge-warning">JS: jQuery</span>
                    <?php endif; ?>
                </div>
            </div>

            <script>
                let iframe = document.getElementById('<?= $section['title'] ?>').contentWindow.document;
                iframe.open();
                <?php if (in_array('bootstrap', $section['css_libs'])): ?>
                iframe.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">');
                <?php endif; ?>
                iframe.write(`<style><?= $css ?></style>`);
                iframe.write(`<body><?= $html ?></body>`);
                <?php if (in_array('jquery', $section['js_libs'])): ?>
                    iframe.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"><\/script>');
                <?php endif; ?>
                <?php if (in_array('bootstrap', $section['js_libs'])): ?>
                    iframe.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"><\/script>');
                    iframe.write('<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"><\/script>');
                <?php endif; ?>
                iframe.write(`<script><?= $js ?><\/script>`);
                iframe.close();
            </script>
            <?php
    }
}
