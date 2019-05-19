<div class="top-bar stacked-for-large">
    <nav class="column row">
        <div class="top-bar-title">
            <span data-responsive-toggle="responsive-menu" data-hide-for="large">
            <button class="menu-icon dark" type="button" data-toggle></button>
            </span>
        </div>
        <div id="responsive-menu">
            <div class="top-bar-left">
                <ul class="vertical large-horizontal menu" data-responsive-menu="drilldown large-dropdown">
                <?php
                $this->navigation();
                ?>                
                </ul>
            </div>
            <div class="top-bar-right">
                <ul class="menu">
                    <?php 
                    // Placeholder for search box 
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</div>