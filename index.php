<?php 
    /**
     * @author Michele Andreoli <michi.andreoli[at]gmail.com>
     * @name index.php
     * @version 0.1 updated 30-08-2014
     * @license http://opensource.org/licenses/gpl-license-php GNU Public License
     * @package CoinsChanger
     */

    require_once 'CoinsManager.class.php'; 
       
    $amount = 30;
    $coins = [50, 10, 5, 2, 1, 0.5];
    $limits = [1, 2, 1, 5, 3, 10];
    
    //Coin change problem with FINITE coins supply
    $changerMngr = new CoinsManager($coins, $limits);
    
    $exchange = $changerMngr->getChange($amount);
    $groups = $changerMngr->groupBy($exchange);  
    
    //Coin change problem with INFINITE coins supply
    $changerMngrInfinite = new CoinsManager($coins);
    
    $exchangeInfinite = $changerMngrInfinite->getChange($amount);
    $groupsInfinite = $changerMngrInfinite->groupBy($exchangeInfinite); 
?>
<html>
    <head>
        <title>Coins Changer Machine</title>
    </head>
    <body>
        <h2>Coins changer with <b>finite</b> coins supply</h2>
        <p>Change <b><?= $amount ?>&euro;</b> with:</p>
        <?php 
            if ($exchange < 0 || $groups == FALSE) {
                echo "<p><b>No solutions</b></p>";
            }
            else {
        ?>
            <ul>
            <?php 
                foreach ($groups as $key => $group) {
                    echo "<li><b>" . $key . "&euro;</b> => " . $group . "</li>";
                }
            ?>
            </ul>
            <?php } ?>
        <h2>Coins changer with <b>infinite</b> coins supply</h2>
        <p>Change <b><?= $amount ?>&euro;</b> with:</p>
        <?php 
            if ($exchangeInfinite < 0 || $groupsInfinite == FALSE) {
                echo "<p><b>No solutions</b></p>";
            }
            else {
        ?>
            <ul>
            <?php 
                foreach ($groupsInfinite as $key => $group) {
                    echo "<li><b>" . $key . "&euro;</b> => " . $group . "</li>";
                }
            ?>
            </ul>
            <?php } ?>
    </body>
</html>
