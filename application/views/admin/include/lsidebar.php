<aside>
    <div id="sidebar"  class="nav-collapse ">

    <ul class="sidebar-menu" id="nav-accordion">

  <h5 class="centered"><?php echo $ion_auth->user()->row()->username; ?></h5>

  <li class="">
      <a class="active" href="<?php echo site_url('admin/index');  ?>">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
      </a>
  </li>
  <?php if($this->ion_auth->in_group('coc_add') || $this->ion_auth->is_admin()): ?>
  <li class="">
      <a href="<?php echo site_url('admin/coc/add');  ?>" >
          <i class="fa fa-tasks"></i>
          <span>Add COC</span>
      </a>
  </li>
  <?php endif; ?>

  <?php if($this->ion_auth->in_group(array('coc_edit', 'coc_delete')) || $this->ion_auth->is_admin()): ?>
  <li class="">
      <a href="<?php echo site_url('admin/coc');  ?>" >
          <i class="fa fa-tasks"></i>
          <span>Manage COC</span>
      </a>
  </li>
  <?php endif; ?>

  <?php if($this->ion_auth->in_group('cop_add') || $this->ion_auth->is_admin()): ?>
  <li class="">
      <a href="<?php echo site_url('admin/cop/add');  ?>" >
          <i class="fa fa-tasks"></i>
          <span>Add COP</span>
      </a>
  </li>
  <?php endif; ?>

  <?php if($this->ion_auth->in_group(array('cop_edit', 'cop_delete')) || $this->ion_auth->is_admin()): ?>
  <li class="">
      <a href="<?php echo site_url('admin/cop');  ?>" >
          <i class="fa fa-tasks"></i>
          <span>Manage COP</span>
      </a>
  </li>
  <?php endif; ?>

  <?php if($this->ion_auth->in_group('endo_add') || $this->ion_auth->is_admin()): ?>
  <li class="">
      <a href="<?php echo site_url('admin/endorsement/add');  ?>" >
          <i class="fa fa-tasks"></i>
          <span>Add Endorsement</span>
      </a>
  </li>
  <?php endif; ?>

  <?php if($this->ion_auth->in_group(array('endo_edit', 'endo_delete')) || $this->ion_auth->is_admin()): ?>
  <li class="">
      <a href="<?php echo site_url('admin/endorsement');  ?>" >
          <i class="fa fa-tasks"></i>
          <span>Manage Endorsements</span>
      </a>
  </li>
  <?php endif; ?>

  <?php if($this->ion_auth->in_group('mc_add') || $this->ion_auth->is_admin()): ?>
  <li class="">
      <a href="<?php echo site_url('admin/medical_certificate/add');  ?>" >
          <i class="fa fa-tasks"></i>
          <span>Add Medical Certificate</span>
      </a>
  </li>
  <?php endif; ?>

  <?php if($this->ion_auth->in_group(array('mc_edit', 'mc_delete')) || $this->ion_auth->is_admin()): ?>
  <li class="">
      <a href="<?php echo site_url('admin/medical_certificate');  ?>" >
          <i class="fa fa-tasks"></i>
          <span>Manage Medical Certificates</span>
      </a>
  </li>
  <?php endif; ?>


  <?php if($this->ion_auth->is_admin()): ?>
  <li class="">
      <a href="<?php echo site_url('admin/users');  ?>" >
          <i class="fa fa-tasks"></i>
          <span>Manage Users</span>
      </a>
  </li>
  <?php endif; ?>

  <?php if($this->ion_auth->is_admin()): ?>
  <li class="">
      <a href="<?php echo site_url('admin/notes');  ?>" >
          <i class="fa fa-tasks"></i>
          <span>Manage Notes</span>
      </a>
  </li>
  <?php endif; ?>

</ul>

</div>
</aside>

<section id="main-content">
<section class="wrapper">
<div class="row">
   <div class="<?php if($ion_auth->in_group('not-now')) { echo 'col-lg-9'; }else{ echo 'col-md-12';} ?> main-chart">
