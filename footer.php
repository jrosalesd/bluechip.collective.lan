
    <div class="text-center">
        <p>
            <span class="glyphicon glyphicon-copyright-mark"></span>
            Julio R 2015-<?php echo date("Y");?> - <g class="version">Version: 2.7.2</g>
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
    
    <div id="call" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Check Caller's Time</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</html>
<?php

ob_end_flush();
