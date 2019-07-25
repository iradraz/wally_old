<?php $post_data = $this->input->post(); ?>
<div class="container">
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="1"
             aria-valuemin="0" aria-valuemax="100" style="width:1%">
            <span class="sr-only">10% Complete</span>
        </div>
    </div>
    <h3 class="text-center text-primary">Add funds into your account</h3>
    <form action="<?php echo base_url('/client/deposit/2'); ?>" method="post">
        <div class="form-group text-info col-md-8" style="display: inline-block;">
            <div style="float: left;">
                <label for="exch_from_currency">EXCHANGE FROM:</label>
                <select name="exch_from_currency">
                    <?php
                    if (isset($post_data['exch_from_currency'])) {
                        $currency = $post_data['exch_from_currency'];
                    } else {
                        $currency = 'USD';
                    }
                    ?>
                    <option value="<?php echo $currency ?>" selected hidden><?php echo $currency ?></option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="ILS">ILS</option>
                    <option value="CAD">CAD</option>
                    <option value="JPY">JPY</option>
                </select>
                <span class="text-danger"><?php echo form_error('exch_from_currency'); ?></span>
            </div>
            <div style="float: right;margin-left: 50px;">
                <label for="exch_to_currency">EXCHANGE TO(BUY):</label>
                <select name="exch_to_currency">
                    <?php
                    if (isset($post_data['exch_to_currency'])) {
                        $currency = $post_data['exch_to_currency'];
                    } else {
                        $currency = 'EUR';
                    }
                    ?>
                    <option value="<?php echo $currency ?>" selected hidden><?php echo $currency ?></option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="ILS">ILS</option>
                    <option value="CAD">CAD</option>
                    <option value="JPY">JPY</option>
                </select>
                <span class="text-danger"><?php echo form_error('exch_to_currency'); ?></span>
            </div>

            <span style="clear: clear"></span>
            <div class="form-group text-info col-md-12" style="margin-top: 100px">
                <label for="amount">Amount:</label>
                <input type="number" step="0.01" class="form-control" id="amount" min="20" value="<?php echo set_value('amount'); ?>" placeholder="Enter amount of currency to sell" name="amount">
                <span class="text-danger"><?php echo form_error('amount'); ?></span>
            </div>
        </div>

        <ul>
            <div>
                <button type="submit" class="btn btn-info" >Proceed</button>
            </div>
        </ul>
    </form>

</div>