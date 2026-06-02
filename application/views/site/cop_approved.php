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

        <h1 style="font-size: 24px;font-weight: bold;"><?php echo $page_title; ?></h1>

        <!--<p class="lead">The General Directorate of Ports approves the General Establishment for Maritime Training and Qualifying as the recognized institute</p>-->

<?php if($curr_lang == 'arabic'): ?>

        <p>
            المعاهد المعترف بها من قبل المديرية العامة للموانئ: </br>
</br>- المؤسسة العامة للتدريب والتأهيل البحري
            <a href="http://www.gemtq.edu.sy/verify" target="_blank">www.gemtq.edu.sy/verify</a>

</br>- مؤسسة منصور للالكترونيات
            <a href="http://training.mee-sy.com" target="_blank">http://training.mee-sy.com</a>
        </br>- مركز فينيقيا للتدريب البحري
            <a href="http://phoenicia-mtc.com" target="_blank">http://phoenicia-mtc.com</a>
            
            </br>- معهد أرادوس مارين للتدريب و التأهيل
            <a href="http://www.aradousmarine.com/" target="_blank">http://www.aradousmarine.com/</a>
            
        </p>
<?php else: ?>


        <p>
            The Recognized Institutes are:
            </br>
            </br>- The General Establishment for Maritime Training and Qualifying  
            <a href="http://www.gemtq.edu.sy/verify" target="_blank">www.gemtq.edu.sy/verify</a>

            </br>- Mansour Electronics  Establishment 
            <a href="http://training.mee-sy.com" target="_blank">http://training.mee-sy.com</a>
            
            </br>- phoenicia Maritime Training Center
            <a href="http://phoenicia-mtc.com" target="_blank">http://phoenicia-mtc.com</a>
            
            </br>- Aradous Marine Institute For Training And Qualifying
            <a href="http://www.aradousmarine.com/" target="_blank">http://www.aradousmarine.com/</a>            
            
        </p>

<?php endif; ?>

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