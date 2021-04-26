<html>
    <head>
        <!-- <title>Send Mail</title> -->
    </head>
    <body>
        <style>
            th{
                border:1px solid black;
                background:#ddd;
            }
            td{
                text-align:center;
            }
            tbody td{
                border:1px solid black;
            }
        </style>
        Dear Mam/Sir;
        <p style="text-indent:80px;margin-top:10px;">
            This student <?php echo $student_name;?> submitted a requirements that is listed below.<br>
            Click this link to see your submitted files <a href="<?php echo $gdrive_link; ?>" target="_blank"><?php echo $gdrive_link; ?></a>.
        </p>

        <h3>Requirements List</h3>
        <table width="50%" cellspacing="0">
            <thead>
                <tr>
                    <!-- <th style="border:1px solid black;background:#ddd;">Name</th> -->
                    <th style="border:1px solid black;background:#ddd;">Requirements Name</th>
                    <th style="border:1px solid black;background:#ddd;">Status</th>
                    <th style="border:1px solid black;background:#ddd;">Date</th>
                </tr>
            <thead>
            <tbody style="text-align:center">
                <?php foreach($requirements as $list){?>
                <tr>
                    <td><?php echo $list['name'];?></td>
                    <td><?php echo $list['status'];?></td>
                    <td><?php echo $datetime;?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>