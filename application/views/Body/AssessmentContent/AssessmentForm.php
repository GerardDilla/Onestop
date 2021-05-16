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
            <table style="width:100%">
                <tbody>
                    <tr class="success" style="font-size: 12px; text-align:left">
                        <td width="40%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>REFERENCE NUMBER:</strong> <span id="reg_rn"></span> <br>
                            <strong>NAME:</strong> <span id="reg_name" class="capitalizetext"></span> <br>
                            <strong>ADDRESS:</strong> <span id="reg_address"></span> <br>
                        </td>
                        <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>SEMESTER:</strong> <span id="reg_sem"></span> <br>
                            <strong>COURSE:</strong> <span id="reg_course"></span> <br>
                        </td>
                        <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>SCHOOL YEAR:</strong> <span id="reg_sy"></span> <br>
                            <strong>YEAR LEVEL:</strong> <span id="reg_yl"></span> <br>
                        </td>
                        <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>SECTION:</strong> <span id="reg_sec"></span> <br>
                            <strong>DATE:</strong> <span id="reg_date"></span> <br>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <table>
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
                <tbody id="registration_form" style="font-size: 12px; text-align:left">

                </tbody>
            </table>
            <hr>
            <table class="pull-right" style="font-size: 13px; width: 80%; text-align:left">
                <tbody>
                    <tr>
                        <td><strong>Tuition:</strong></td>
                        <td class="feesbox" id="reg_tuition"></td>

                        <td><strong>Initial Payment:</strong></td>
                        <td class="feesbox" id="reg_initial"></td>

                        <td><strong>Total Units:</strong></td>
                        <td class="feesbox" id="reg_total_units"></td>
                    </tr>
                    <tr>
                        <td><strong>Misc Fees:</strong></td>
                        <td class="feesbox" id="reg_misc"></td>

                        <td><strong>First:</strong></td>
                        <td class="feesbox" id="reg_first"></td>

                        <td><strong>Total Subjects:</strong></td>
                        <td class="feesbox" id="reg_total_subject"></td>
                    </tr>
                    <tr>
                        <td><strong>Lab Fees:</strong></td>
                        <td class="feesbox" id="reg_lab"></td>

                        <td><strong>Second:</strong></td>
                        <td class="feesbox" id="reg_second"></td>

                        <td><strong>Scholar:</strong></td>
                        <td class="feesbox" id="reg_scholar"></td>
                    </tr>
                    <tr>
                        <td><strong>Other Fees:</strong></td>
                        <td class="feesbox" id="reg_other"></td>

                        <td><strong>Third:</strong></td>
                        <td class="feesbox" id="reg_third"></td>

                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Total Fees:</strong></td>
                        <td class="feesbox" id="reg_total_fees"></td>

                        <td><strong>Fourth:</strong></td>
                        <td class="feesbox" id="reg_fourth"></td>

                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
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