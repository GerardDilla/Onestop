<!DOCTYPE html>
<html lang="en">
<body>
    <p>Hello <?php echo $student_info['Last_Name'].', '.$student_info['First_Name']; ?> !
        <br>
        Here are your sign up details for the Admissions Portal.
        <br>
        <br>
        <b>REFERENCE NUMBER</b>: <?php echo $student_info['Reference_Number']; ?>
        <br>
        <br>
        Click this link for the Admissions Portal:
        <br>
        <a href="http://stdominiccollege.edu.ph/Onestop/main/setupUserPass/<?php echo $code; ?>">CLICK ME!</a>
        <br>
        <br>
        Should you have any questions feel free to call us anytime.
        <br>
        (+63 998) 551 8001 / (+63 998)591 2799
        <br>
        <br>
        We are happy to be of service with you and be part of your future success.
        <br>
        <br>
        Thank you.
    </p>
</body>

</html>