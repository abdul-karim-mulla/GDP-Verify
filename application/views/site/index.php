<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb col-lg-12">
            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
            <a href="<?php echo site_url('site/index/?lang='.$lang); ?>" class="btn btn-primary btn-xs <?php echo $lang_css; ?>"><?php echo $lang_text; ?></a>
        </ol>

    </div>
</div>

<div class="row">
    <div class="col-lg-12 text-center">

        <p>
            <a href="<?php echo site_url('site/coc_search'); ?>" class="btn btn-primary mxm_btn"><?php echo lang('COC_TITLE'); ?></a>
        </p>

        <p>
            <a href="<?php echo site_url('site/cop_main'); ?>" class="btn btn-primary mxm_btn"><?php echo lang('COP_TITLE'); ?></a>
        </p>

        <p>
            <a href="<?php echo site_url('site/endo_search'); ?>" class="btn btn-primary mxm_btn"><?php echo lang('ENDO_TITLE'); ?></a>
        </p>

        <p>
            <a href="<?php echo site_url('site/mc_search'); ?>" class="btn btn-primary mxm_btn"><?php echo lang('MC_TITLE'); ?></a>
        </p>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        <?php if($curr_lang == 'arabic'): ?>
            <p style="padding:15px"><?php echo $note->content; ?></p>
        <?php else: ?>
            <p style="padding:15px"><?php echo $note->content_en; ?></p>
        <?php endif; ?>

    </div>
</div>
