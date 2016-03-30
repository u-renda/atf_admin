<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/header_nav'); ?>

<div class="inner-wrapper">
    <?php $this->load->view('templates/left_menu'); ?>
    <?php $this->load->view($frame_content); ?>
</div>
<?php $this->load->view('templates/footer'); ?>