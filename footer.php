    
    <div class="text-center">
        <p>
            <span class="glyphicon glyphicon-copyright-mark"></span>
            Julio R 2015-<?php echo date("Y");?> - <g class="version">Version: 2.4.1</g>
        </p>
    </div>
    </body>
    <head>
        <title class="text-capitalize">
            <?php 
            if (empty($subpage)) {
                echo ucwords($page_name." | Resource Website");
            }else {
               echo ucwords($subpage."|".$page_name."|Resource Website");
            }
            ?>
        </title>
    </head>
    
</html>
<?php
ob_end_flush();