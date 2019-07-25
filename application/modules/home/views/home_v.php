<div class="wrapper">
    <div >
        <h3 class="text-center text-info mt-4">Safe and Simple Shopping</h3>
        <div class="text-center mt-4">
            <?php $this->load->view('templates/slideshow_v'); ?>
        </div>
        <h3 class="text-center text-info mt-4">Instant Money Transfers</h3>
    </div>
    <ul class="main-menu__list text-center">
        <a href="<?php echo base_url('/user/login'); ?>" class="btn btn-primary btn-md">LOGIN</a>
        <a href="<?php echo base_url('user/register'); ?>" class="btn btn-primary btn-md">REGISTER NEW ACCOUNT</a>
    </ul>
</div>
