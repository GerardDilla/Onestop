<html>
    <head>
        <!-- <title>Send Mail</title> -->
    </head>
    <body>
        <p>
        Hi <?php echo $student_info['First_Name'].' '.$student_info['Middle_Name'].' '.$student_info['Last_Name'];?>, you have paid a total of ₱ <?php echo number_format($total_amount,2,'.',',');?> Today <?php echo date("l, F d Y");?>. Godbless and Keep Safe.<br>
        </p>
    </body>
</html>