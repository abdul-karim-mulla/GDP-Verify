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
    <div class="col-md-12">
        <div class="col-md-12 text-center">
            <h1><?php echo $page_title; ?></h1>
        </div>

        <div class="well col-md-6 col-md-offset-3">
            <?php echo form_open_multipart("site/".$action."_search", array('class' => 'form-horizontal'));?>
            <div class="form-group">
                <?php if($action == 'endo'): ?>
                <label class="col-sm-5 control-label"><?php echo lang('SEARCH_BY_ENDO'); ?></label>
                <?php else: ?>
                <label class="col-sm-5 control-label"><?php echo lang('SEARCH_BY'); ?></label>
                <?php endif; ?>
                
                <div class="col-sm-7">
                    <input type="text" name="keyword" value="<?php echo set_value('keyword');?>" class="form-control" placeholder="Enter Full Name or Certificate No" />
                </div>
            </div>
<!--<div class="form-group">
<label class="col-sm-5 control-label">Captcha</label>
   <div class="col-sm-7">
<?php echo $widget;?>
<?php echo $script;?>
</div>
</div>-->
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-7">
                    <button type="submit" class="btn btn-default"><?php echo lang('VERIFY'); ?></button>
                </div>
            </div>
        </form>
        </div>

        <div class="col-md-6 col-md-offset-3">
            <?php if(isset($message)){ ?>
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only"><?php echo lang('ERROR'); ?>:</span>
                    <?php echo $message; ?>
                </div>
            <?php }else if(isset($certs) && count($certs) > 0){ ?>
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    <span class="sr-only"><?php echo lang('FOUND'); ?>:</span>
                    <?php echo lang('FOUND'); ?>
                </div>


                <table class="table table-bordered table-striped" dir="ltr" style="text-align: left!important;">
                    <thead>
                    <tr>
                        <th style="text-align: left">Certificate No</th>
                        <th style="text-align: left">Full Name</th>
                        <?php if($action != 'mc'): ?>
                        <th style="text-align: left">Capacity</th>
                        <?php endif; ?>
                        <th style="text-align: left">Created By</th>
                        <th style="text-align: left">Created On</th>
                        <th> </th>
                    </tr>
                    </thead>

                    <?php foreach($certs as $cert){
                        echo "<tr><td>".$cert->certificate_no."</td>";
                        echo "<td>".$cert->full_name."</td>";
                        if($action != 'mc'):
                            echo "<td>".$cert->capacity."</td>";
                        endif;
                        echo "<td>".(isset($cert->created_by) ? $cert->created_by : '')."</td>";
                        echo "<td>".(isset($cert->created_at) ? $cert->created_at : '')."</td>";
                        echo '<td><a href="'.site_url('site/view/'.$action.'/'.$cert->{$action.'_id'}).'">View</a></td>';
                        echo '</tr>';
                    } ?>
                </table>
            <?php }else if(isset($certs) && count($certs) <= 0){ ?>
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only"><?php echo lang('NOT_FOUND'); ?>:</span>
                    <?php echo lang('NOT_FOUND'); ?>
                </div>
            <?php } ?>
        </div>

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
