<style>
@media print {
  body * {
    visibility: hidden;
  }
  #print-area, #print-area * {
    visibility: visible;
  }

#another-search, #another-search *{
    visibility: hidden;
}

}
</style>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
            <a href="<?php echo current_url().'?lang='.$lang; ?>" class="btn btn-primary btn-xs <?php echo $lang_css; ?>"><?php echo $lang_text; ?></a>
         </ol>
    </div>
</div>

<div id="print-area" class="row">
    <div class="col-md-12">
        <div class="col-md-12 text-center">
            <h1><?php echo $page_title; ?></h1>
      
        </div>

        <div id="certificate" class="col-md-6 col-md-offset-3">
            <h1 style="font-size: 37px" class="hidden">Syrian Arab Republic<br/> Ministry of Transport - The General Directorate of Ports</h1>
            <h1 class="hidden"><?php echo $page_title; ?></h1>
            <table class="table table-bordered table-striped" dir="ltr">
                    <?php if($action != 'mc'): ?>
                        <?php if($model->status != 'N/A'): ?>
                            <tr> <td>Status</td> <td><?php echo $model->status; ?></td> </tr>
                        <?php else: ?>
                            <tr> <td>Status</td> <td></td> </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if($action == 'endo'): ?>
                        <tr> <td>Endorsement No.</td> <td><?php echo $model->endorsement_no; ?></td> </tr>
                    <?php endif; ?>
                    <tr> <td>Certificate No</td> <td><?php echo $model->certificate_no; ?></td> </tr>
                    <?php if($action == 'endo'): ?>
                        <tr> <td>Certificate Issuing Party</td> <td><?php echo $model->issuing_party; ?></td> </tr>
                    <?php endif; ?>
                    <?php if($action == 'cop'): ?>
                        <tr> <td>Certificate Type</td> <td><?php echo $model->certificate_type; ?></td> </tr>
                    <?php endif; ?>
                    <tr> <td>Full name</td> <td><?php echo $model->full_name; ?></td> </tr>
                    <tr> <td>Nationality</td> <td><?php echo $model->nationality; ?></td> </tr>
                    <tr> <td>Date of Birth</td> <td><?php echo $model->date_of_birth; ?></td> </tr>
                    <tr> <td>Gender</td> <td><?php echo $model->gender; ?></td> </tr>
                    <tr> <td>Date of issue</td> <td><?php echo $model->date_of_issue; ?></td> </tr>
                    <tr> <td>Expiry date</td> <td><?php echo $model->date_of_expiry; ?></td> </tr>
                    <?php if($action == 'coc'): ?>
                        <tr> <td>The date of issue the renewal</td> <td><?php echo $model->issue_renewal; ?></td> </tr>
                        <tr> <td>The expiry date of the renewal</td> <td><?php echo $model->expiry_renewal; ?></td> </tr>
                    <?php endif; ?>
                    <?php if($action == 'endo'): ?>
                        <tr> <td>Last revalidation date</td> <td><?php echo $model->last_revalidation; ?></td> </tr>
                    <?php endif; ?>
                    <?php if($action != 'mc'): ?>
                        <tr> <td>STCW Regulation No</td> <td><?php echo $model->regulation_no; ?></td> </tr>
                        <tr> <td>Capacity</td> <td><?php echo $model->capacity; ?></td> </tr>
                        <tr> <td>Function</td> <td><?php echo $model->cert_function; ?></td> </tr>
                        <tr> <td>Level of responsibility</td> <td><?php echo $model->level_of_resp; ?></td> </tr>
                    <?php endif; ?>
                    <tr> <td>Limitations</td> <td><?php echo $model->limitations; ?></td> </tr>
                    <?php if($action == 'mc' && 1==2): ?>
                        <tr> <td>City</td> <td><?php echo $model->city; ?></td> </tr>
                    <?php endif; ?>

                </table>
                <?php if($action != 'mc'): ?>
                       <table class="table table-bordered table-striped" dir="ltr"><tbody>
                        <?php if($action == 'endo'): ?>
                           <tr> <td colspan="2">The medical certificate relating to the issue or revalidation of the Endoresement</td> </tr>
                        <?php else: ?>
                           <tr> <td colspan="2">The medical certificate relating to the issue or revalidation of the Certificate</td> </tr>
                        <?php endif; ?>
                        <tr> <td>Medical Certificate No</td> <td><?php echo $model->mc_no; ?></td> </tr>
                        <tr> <td>Date of issue the medical certificate</td> <td><?php echo $model->mc_issue_date; ?></td> </tr>
                       </tbody></table>
                <?php endif; ?>
        </div>
        <div class="col-md-6  col-md-offset-3" style="margin-bottom: 20px">
        </div>
        
        <div id="another-search" class="col-md-6 col-md-offset-3 text-center">
            <form>
         <input class="btn btn-success" style="border-radius:0px;" type="button" value="Print" onclick="window.print()" />
      </form></br>
        <a href="<?php echo site_url('site/'.$action.'_search'); ?>" class="btn btn-primary"><?php echo lang('BACK_TO_SEARCH'); ?></a>
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
