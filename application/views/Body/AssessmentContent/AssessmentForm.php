<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">


<link rel="stylesheet" href="<?php echo base_url('assets/vendors/iconly/bold.css'); ?>">

<link rel="stylesheet" href="<?php echo base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.svg'); ?>" type="image/x-icon">
<!-- <link rel="stylesheet" href="<?php echo base_url('assets/vendors/simple-datatables/style.css'); ?>"> -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.material.min.css">
<script src="<?php echo base_url('assets/vendors/login_asset/js/jquery.min.js'); ?>"></script>



<body>
    <div class="row" style="width:1200; height:700px; background-color:white">
        <!--/Regform Header-->
        <div class="col-lg-12 AssessmentForm" style="text-align:center; color:#000; padding:30px">
            <img src="<?php echo base_url('assets/images/logo/SdcaHeader.jpg'); ?>" style="width:100%; height:auto">
            <h5>ASSESSMENT FORM</h5>
            <hr>
            <table style="width:100%; color:#000">
                <tbody>

                    <tr class="success" style="font-size: 12px; text-align:left">
                        <td width="40%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>REFERENCE NUMBER:</strong> <?php echo $get_Advise[0]->Reference_Number; ?> <br>
                            <strong>NAME:</strong> <?php echo $get_Advise[0]->First_Name . ' ' . $get_Advise[0]->Middle_Name . ' ' . $get_Advise[0]->Last_Name; ?> <br>
                            <strong>ADDRESS:</strong> <?php echo $get_Advise[0]->Address_No . ', ' . $get_Advise[0]->Address_Street . ', ' . $get_Advise[0]->Address_Subdivision . ', ' . $get_Advise[0]->Address_Barangay . ', ' . $get_Advise[0]->Address_City . ', ' . $get_Advise[0]->Address_Province; ?> <br>
                        </td>
                        <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>SEMESTER:</strong> <?php echo $get_Advise[0]->Semester; ?> <br>
                            <strong>COURSE:</strong> <?php echo $get_Advise[0]->Course; ?> <br>
                        </td>
                        <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>SCHOOL YEAR:</strong> <?php echo $get_Advise[0]->School_Year; ?> <br>
                            <strong>YEAR LEVEL:</strong> <?php echo $get_Advise[0]->Year_Level; ?> <br>
                        </td>
                        <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>SECTION:</strong> <?php echo $get_Advise[0]->Section; ?> <br>
                            <strong>DATE:</strong> <?php echo date("Y-m-d"); ?> <br>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <table style="width:100%">
                <thead>
                    <tr class="success" style="font-size: 13px; text-align:left">
                        <th style="padding-right: 10px;">Sched Code</th>
                        <th style="padding-right: 10px;">Course Code</th>
                        <th style="padding-right: 10px;">Course</th>
                        <th style="padding-right: 10px;">Units</th>
                        <th style="padding-right: 10px;">Day</th>
                        <th style="padding-right: 10px;">Time</th>
                        <th style="padding-right: 10px;">Room</th>
                    </tr>
                </thead>
                <tbody style="font-size: 12px; text-align:left">
                    <?php
                    $sched_checking = '';
                    $units = 0;
                    $subjectcount = 0;
                    ?>
                    <?php foreach ($get_Advise as $data) : ?>
                        <?php if ($sched_checking != $data->Sched_Code) : ?>
                            <tr>
                                <td>
                                    <?php echo $data->Sched_Code; ?>
                                </td>
                                <td>
                                    <?php echo $data->Course_Code; ?>
                                </td>
                                <td>
                                    <?php echo $data->Course_Title; ?>
                                </td>
                                <td>
                                    <?php echo $data->Course_Lec_Unit + $data->Course_Lab_Unit; ?>
                                </td>
                                <td id="<?php echo $data->Sched_Code; ?>_day">
                                    <?php echo $data->Day; ?>
                                </td>
                                <td id="<?php echo $data->Sched_Code; ?>_time">
                                    <?php echo $data->START . '-' . $data->END; ?>
                                </td>
                                <td id="<?php echo $data->Sched_Code; ?>_room">
                                    <?php echo $data->Room; ?>
                                </td>
                            </tr>
                        <?php else : ?>
                            <script>
                                $('#<?php echo $data->Sched_Code; ?>_day').append(', <?php echo $data->Day; ?>');
                                $('#<?php echo $data->Sched_Code; ?>_time').append(', <?php echo $data->START . ' - ' . $data->END ?>');
                                $('#<?php echo $data->Sched_Code; ?>_room').append(', <?php echo $data->Room; ?>');
                            </script>
                        <?php endif; ?>
                        <?php
                        $units = $units + ($data->Course_Lec_Unit + $data->Course_Lab_Unit);
                        $sched_checking = $data->Sched_Code;
                        $subjectcount++
                        ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <hr>
            <table class="pull-right" style="font-size: 13px; width: 80%; text-align:left">
                <tbody>
                    <tr>
                        <td><strong>Tuition:</strong></td>
                        <td class="feesbox"><?php echo $get_Advise[0]->tuition_Fee; ?></td>

                        <td><strong>Initial Payment:</strong></td>
                        <td class="feesbox"><?php echo $get_Advise[0]->InitialPayment; ?></td>

                        <td><strong>Total Units:</strong></td>
                        <td class="feesbox"><?php echo $units; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Misc Fees:</strong></td>
                        <td class="feesbox"><?php echo $get_miscfees[0]->Fees_Amount; ?></td>

                        <td><strong>First:</strong></td>
                        <td class="feesbox"><?php echo $get_Advise[0]->First_Pay; ?></td>

                        <td><strong>Total Subjects:</strong></td>
                        <td class="feesbox"><?php echo $subjectcount; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Lab Fees:</strong></td>
                        <td class="feesbox"><?php echo $get_labfees[0]->Fees_Amount; ?></td>

                        <td><strong>Second:</strong></td>
                        <td class="feesbox"><?php echo $get_Advise[0]->Second_Pay; ?></td>

                        <td><strong>Scholar:</strong></td>
                        <td class="feesbox"><?php echo $get_Advise[0]->Scholarship; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Other Fees:</strong></td>
                        <td class="feesbox"><?php echo $get_otherfees[0]->Fees_Amount; ?></td>

                        <td><strong>Third:</strong></td>
                        <td class="feesbox"><?php echo $get_Advise[0]->Third_Pay; ?></td>

                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Total Fees:</strong></td>
                        <td class="feesbox"><?php echo $get_Advise[0]->tuition_Fee + $get_miscfees[0]->Fees_Amount + $get_otherfees[0]->Fees_Amount + $get_labfees[0]->Fees_Amount; ?></td>

                        <td><strong>Fourth:</strong></td>
                        <td class="feesbox"><?php echo $get_Advise[0]->Fourth_Pay; ?></td>

                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <label>
                <h6><u>NOTE: THIS IS NOT A PROOF OF OFFICIAL ENROLLMENT</u></h6>
            </label>
        </div>
    </div>
</body>


<script src="<?php echo base_url(); ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/vendors/apexcharts/apexcharts.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/pages/dashboard.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script>
    window.jsPDF = window.jspdf.jsPDF;
    $(document).ready(function() {
        assessmentexport();
    });

    function assessmentexport() {
        // alert($(".AssessmentForm").width());
        var HTML_Width = $(".AssessmentForm").width();
        var HTML_Height = $(".AssessmentForm").height();
        var top_left_margin = 15;
        var PDF_Width = HTML_Width + (top_left_margin * 2);
        var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

        html2canvas(document.querySelector(".AssessmentForm")).then(canvas => {

            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            $('#student_information').append(canvas);

            var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'jpeg', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'jpeg', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4), canvas_image_width, canvas_image_height);
            }
            pdf.save("AssessmentForm.pdf");
            $(".html-content").hide();
            $('#canvas').append(canvas);
        });
        setTimeout(sayHi, 5000);
        window.close();


    }
</script>