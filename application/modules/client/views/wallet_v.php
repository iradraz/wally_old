<?php
$session_data = $this->session->userdata();
$locale = 'he-IL'; //browser or user locale
//$fmt = new NumberFormatter("@currency=$currency", NumberFormatter::CURRENCY);
//$symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
header("Content-Type: text/html; charset=UTF-8;");
?>
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-4" style="min-width: 250px;">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Wally Wallet</h5>
                    <p class="card-text">Review statement of the wallet</p>
                    <a href="<?php echo base_url('client/deposit'); ?>" class="btn btn-primary">Add Funds</a>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-8">
            <h5 class="text-center text-primary">Current Account Statement</h5>
            <table class="table table-success">
                <thead class="table-stiped thead-light">
                    <tr>
                        <th scope="col">USD</th>
                        <th scope="col">EUR</th>
                        <th scope="col">GBP</th>
                        <th scope="col">ILS</th>
                        <th scope="col">CAD</th>
                        <th scope="col">JPY</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo '<tr>'; ?>
                    <?php
                    $fmt = new NumberFormatter("@currency=USD", NumberFormatter::CURRENCY);
                    $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                    echo '<td>' . $symbol . ' ' . $user_data[0]['user_usd'] . '</td>';
                    ?>
                    <?php
                    $fmt = new NumberFormatter("@currency=EUR", NumberFormatter::CURRENCY);
                    $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                    echo '<td>' . $symbol . ' ' . $user_data[0]['user_eur'] . '</td>';
                    ?>
                    <?php
                    $fmt = new NumberFormatter("@currency=GBP", NumberFormatter::CURRENCY);
                    $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                    echo '<td>' . $symbol . ' ' . $user_data[0]['user_gbp'] . '</td>';
                    ?>
                    <?php
                    $fmt = new NumberFormatter("@currency=ILS", NumberFormatter::CURRENCY);
                    $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                    echo '<td>' . $symbol . ' ' . $user_data[0]['user_ils'] . '</td>';
                    ?>
                    <?php
                    $fmt = new NumberFormatter("@currency=CAD", NumberFormatter::CURRENCY);
                    $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                    echo '<td>' . $symbol . ' ' . $user_data[0]['user_cad'] . '</td>';
                    ?>
                    <?php
                    $fmt = new NumberFormatter("@currency=JPY", NumberFormatter::CURRENCY);
                    $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                    echo '<td>' . $symbol . ' ' . $user_data[0]['user_jpy'] . '</td>';
                    ?>

                    <?php echo '</tr>'; ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-10 col-centered" >
            <h5 class="text-primary text-center">Transaction Log</h5>
            <table class="table table-striped table-secondary table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width: 1.33%"></th>
                        <th scope="col" style="width: 8.33%">Transaction ID#</th>
                        <th scope="col" style="width: 8.33%">Action</th>
                        <th scope="col" style="width: 8.33%">Currency</th>
                        <th scope="col" style="width: 15.33%">Amount</th>
                        <th scope="col">Transaction Date</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $key => $value) { ?>
                        <?php echo '<tr>'; ?>
                        <?php echo '<th scope="row">' . ($key + 1) . '</th>'; ?>
                        <?php echo '<td scope="row">' . $transactions[$key]['transaction_id'] . '</td>'; ?>
                        <?php echo '<td scope="row">' . /* 'exchange/deposit/withdraw' . */ '</td>'; ?>
                        <?php echo '<td>' . $transactions[$key]['currency'] . '</td>'; ?>
                        <?php
                        $currency = $transactions[$key]['currency'];
                        $fmt = new NumberFormatter("@currency=$currency", NumberFormatter::CURRENCY);
                        $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                        ?>
                        <?php echo '<td>' . $symbol . ' ' . $transactions[$key]['amount'] . '</td>';
                        ?>
                        <?php echo '<td>' . $transactions[$key]['transaction_date'] . '</td>'; ?>
                        <?php
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>