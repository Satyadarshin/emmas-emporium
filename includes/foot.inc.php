<?php
/*
*****************************
* www.emmasemporium.org 3.0.0
*****************************
*
* Original author: Satyadarshin
* Document created: February 2017
*
* Abstract: 
*/
?>
<footer>
    <div class="row">
        <div class="large-12 columns">
            <div class="row">
                <div class="large-12 columns social_btns">
                    <p id="eBay"><?php echo $this->ebay; ?></p>
                    <p><?php echo $this->facebook; echo $this->instagram; echo $this->twitter; echo $this->etsy; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 medium-12 large-6 columns">
            <p>&copy; <?php echo COPYRIGHT . ' ' . date('Y'); ?></p>
        </div>
        <div class="small-12 medium-12 large-6 columns">
            <p><?php echo DESIGNER; ?><br/><?php echo PHOTOGRAPHER; ?></p>
        </div>
    </div>
</footer>