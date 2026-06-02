<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url('site/index'); ?>"><?php echo lang('HOME'); ?></a></li>
            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
            <a href="<?php echo current_url().'?lang='.$lang; ?>" class="btn btn-primary btn-xs <?php echo $lang_css; ?>"><?php echo $lang_text; ?></a>
         </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 text-center">
        <h1><?php echo $page_title; ?></h1>
    </div>

    <div class="col-lg-12">
        <ul  class="col-md-5 col-md-offset-4">
            <li><a href="<?php echo site_url('site/cop_search'); ?>" ><?php echo lang('COP_MAIN1'); ?></a></li>
            <li><a href="<?php echo site_url('site/cop_approved'); ?>" ><?php echo lang('COP_MAIN2'); ?></a></li>
        </ul>
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