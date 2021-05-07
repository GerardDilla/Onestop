
<!--Extra Large Modal -->
<!-- <div id="calendar"></div> -->
<div class="modal fade text-left w-100" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16">CHOOSE SUBJECTS</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>

            </div>
            <div class="modal-body row">

                <p class="col-md-12">
                    Select a Section below to display subjects
                </p>
                <div class="col-md-4">
                    <fieldset class="form-group">
                        <select class="form-select" id="section" required>
                            <option value="none" disabled selected>SELECT SECTION</option>
                        </select>
                    </fieldset>
                </div>
                <hr>

                <table class="mdl-data-table" id="subjectTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sched Code</th>
                            <th>Subject Code</th>
                            <th>Subject Title</th>
                            <th>Section</th>
                            <th>Units</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <img style="width:10%; display:none" class="temp_loading" src="<?php echo base_url('assets/images/barloader.gif'); ?>">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!--Extra Large Modal -->
<div class="modal fade text-left w-100" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true" style="width:100vw;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16">QUEUED SCHEDULE</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body" style="height:50vh;">
                <table class="table table-lg" id="scheduleTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th class="text-center">M</th>
                            <th class="text-center">T</th>
                            <th class="text-center">W</th>
                            <th class="text-center">TH</th>
                            <th class="text-center">F</th>
                            <th class="text-center">S</th>
                            <th class="text-center">A</th>
                        </tr>
                    </thead>
                    <tbody>

                    <tbody>

                        <tr>
                            <td>7:00AM</td>
                            <td id="700_M"></td>
                            <td id="700_T"></td>
                            <td id="700_W"></td>
                            <td id="700_H"></td>
                            <td id="700_F"></td>
                            <td id="700_SA"></td>
                            <td id="700_SU"></td>

                        </tr>
                        <tr>
                            <td>7:30AM</td>
                            <td id="730_M"></td>
                            <td id="730_T"></td>
                            <td id="730_W"></td>
                            <td id="730_H"></td>
                            <td id="730_F"></td>
                            <td id="730_SA"></td>
                            <td id="730_SU"></td>

                        </tr>
                        <tr>
                            <td>8:00AM</td>
                            <td id="800_M"></td>
                            <td id="800_T"></td>
                            <td id="800_W"></td>
                            <td id="800_H"></td>
                            <td id="800_F"></td>
                            <td id="800_SA"></td>
                            <td id="800_SU"></td>

                        </tr>
                        <tr>
                            <td>8:30AM</td>
                            <td id="830_M"></td>
                            <td id="830_T"></td>
                            <td id="830_W"></td>
                            <td id="830_H"></td>
                            <td id="830_F"></td>
                            <td id="830_SA"></td>
                            <td id="830_SU"></td>

                        </tr>
                        <tr>
                            <td>9:00AM</td>
                            <td id="900_M"></td>
                            <td id="900_T"></td>
                            <td id="900_W"></td>
                            <td id="900_H"></td>
                            <td id="900_F"></td>
                            <td id="900_SA"></td>
                            <td id="900_SU"></td>

                        </tr>
                        <tr>
                            <td>9:30AM</td>
                            <td id="930_M"></td>
                            <td id="930_T"></td>
                            <td id="930_W"></td>
                            <td id="930_H"></td>
                            <td id="930_F"></td>
                            <td id="930_SA"></td>
                            <td id="930_SU"></td>

                        </tr>
                        <tr>
                            <td>10:00AM</td>
                            <td id="1000_M"></td>
                            <td id="1000_T"></td>
                            <td id="1000_W"></td>
                            <td id="1000_H"></td>
                            <td id="1000_F"></td>
                            <td id="1000_SA"></td>
                            <td id="1000_SU"></td>

                        </tr>
                        <tr>
                            <td>10:30AM</td>
                            <td id="1030_M"></td>
                            <td id="1030_T"></td>
                            <td id="1030_W"></td>
                            <td id="1030_H"></td>
                            <td id="1030_F"></td>
                            <td id="1030_SA"></td>
                            <td id="1030_SU"></td>

                        </tr>
                        <tr>
                            <td>11:00AM</td>
                            <td id="1100_M"></td>
                            <td id="1100_T"></td>
                            <td id="1100_W"></td>
                            <td id="1100_H"></td>
                            <td id="1100_F"></td>
                            <td id="1100_SA"></td>
                            <td id="1100_SU"></td>

                        </tr>
                        <tr>
                            <td>11:30AM</td>
                            <td id="1130_M"></td>
                            <td id="1130_T"></td>
                            <td id="1130_W"></td>
                            <td id="1130_H"></td>
                            <td id="1130_F"></td>
                            <td id="1130_SA"></td>
                            <td id="1130_SU"></td>

                        </tr>
                        <tr>
                            <td>12:00PM</td>
                            <td id="1200_M"></td>
                            <td id="1200_T"></td>
                            <td id="1200_W"></td>
                            <td id="1200_H"></td>
                            <td id="1200_F"></td>
                            <td id="1200_SA"></td>
                            <td id="1200_SU"></td>

                        </tr>
                        <tr>
                            <td>12:30PM</td>
                            <td id="1230_M"></td>
                            <td id="1230_T"></td>
                            <td id="1230_W"></td>
                            <td id="1230_H"></td>
                            <td id="1230_F"></td>
                            <td id="1230_SA"></td>
                            <td id="1230_SU"></td>

                        </tr>
                        <tr>
                            <td>1:00PM</td>
                            <td id="1300_M"></td>
                            <td id="1300_T"></td>
                            <td id="1300_W"></td>
                            <td id="1300_H"></td>
                            <td id="1300_F"></td>
                            <td id="1300_SA"></td>
                            <td id="1300_SU"></td>

                        </tr>
                        <tr>
                            <td>1:30PM</td>
                            <td id="1330_M"></td>
                            <td id="1330_T"></td>
                            <td id="1330_W"></td>
                            <td id="1330_H"></td>
                            <td id="1330_F"></td>
                            <td id="1330_SA"></td>
                            <td id="1330_SU"></td>

                        </tr>
                        <tr>
                            <td>2:00PM</td>
                            <td id="1400_M"></td>
                            <td id="1400_T"></td>
                            <td id="1400_W"></td>
                            <td id="1400_H"></td>
                            <td id="1400_F"></td>
                            <td id="1400_SA"></td>
                            <td id="1400_SU"></td>

                        </tr>
                        <tr>
                            <td>2:30PM</td>
                            <td id="1430_M"></td>
                            <td id="1430_T"></td>
                            <td id="1430_W"></td>
                            <td id="1430_H"></td>
                            <td id="1430_F"></td>
                            <td id="1430_SA"></td>
                            <td id="1430_SU"></td>

                        </tr>
                        <tr>
                            <td>3:00PM</td>
                            <td id="1500_M"></td>
                            <td id="1500_T"></td>
                            <td id="1500_W"></td>
                            <td id="1500_H"></td>
                            <td id="1500_F"></td>
                            <td id="1500_SA"></td>
                            <td id="1500_SU"></td>

                        </tr>
                        <tr>
                            <td>3:30PM</td>
                            <td id="1530_M"></td>
                            <td id="1530_T"></td>
                            <td id="1530_W"></td>
                            <td id="1530_H"></td>
                            <td id="1530_F"></td>
                            <td id="1530_SA"></td>
                            <td id="1530_SU"></td>

                        </tr>
                        <tr>
                            <td>4:00PM</td>
                            <td id="1600_M"></td>
                            <td id="1600_T"></td>
                            <td id="1600_W"></td>
                            <td id="1600_H"></td>
                            <td id="1600_F"></td>
                            <td id="1600_SA"></td>
                            <td id="1600_SU"></td>

                        </tr>
                        <tr>
                            <td>4:30PM</td>
                            <td id="1630_M"></td>
                            <td id="1630_T"></td>
                            <td id="1630_W"></td>
                            <td id="1630_H"></td>
                            <td id="1630_F"></td>
                            <td id="1630_SA"></td>
                            <td id="1630_SU"></td>

                        </tr>
                        <tr>
                            <td>5:00PM</td>
                            <td id="1700_M"></td>
                            <td id="1700_T"></td>
                            <td id="1700_W"></td>
                            <td id="1700_H"></td>
                            <td id="1700_F"></td>
                            <td id="1700_SA"></td>
                            <td id="1700_SU"></td>

                        </tr>
                        <tr>
                            <td>5:30PM</td>
                            <td id="1730_M"></td>
                            <td id="1730_T"></td>
                            <td id="1730_W"></td>
                            <td id="1730_H"></td>
                            <td id="1730_F"></td>
                            <td id="1730_SA"></td>
                            <td id="1730_SU"></td>

                        </tr>
                        <tr>
                            <td>6:00PM</td>
                            <td id="1800_M"></td>
                            <td id="1800_T"></td>
                            <td id="1800_W"></td>
                            <td id="1800_H"></td>
                            <td id="1800_F"></td>
                            <td id="1800_SA"></td>
                            <td id="1800_SU"></td>

                        </tr>
                        <tr>
                            <td>6:30PM</td>
                            <td id="1830_M"></td>
                            <td id="1830_T"></td>
                            <td id="1830_W"></td>
                            <td id="1830_H"></td>
                            <td id="1830_F"></td>
                            <td id="1830_SA"></td>
                            <td id="1830_SU"></td>

                        </tr>
                        <tr>
                            <td>7:00PM</td>
                            <td id="1900_M"></td>
                            <td id="1900_T"></td>
                            <td id="1900_W"></td>
                            <td id="1900_H"></td>
                            <td id="1900_F"></td>
                            <td id="1900_SA"></td>
                            <td id="1900_SU"></td>

                        </tr>
                        <tr>
                            <td>7:30PM</td>
                            <td id="1930_M"></td>
                            <td id="1930_T"></td>
                            <td id="1930_W"></td>
                            <td id="1930_H"></td>
                            <td id="1930_F"></td>
                            <td id="1930_SA"></td>
                            <td id="1930_SU"></td>

                        </tr>
                        <tr>
                            <td>8:00PM</td>
                            <td id="2000_M"></td>
                            <td id="2000_T"></td>
                            <td id="2000_W"></td>
                            <td id="2000_H"></td>
                            <td id="2000_F"></td>
                            <td id="2000_SA"></td>
                            <td id="2000_SU"></td>

                        </tr>
                        <tr>
                            <td>8:30PM</td>
                            <td id="2030_M"></td>
                            <td id="2030_T"></td>
                            <td id="2030_W"></td>
                            <td id="2030_H"></td>
                            <td id="2030_F"></td>
                            <td id="2030_SA"></td>
                            <td id="2030_SU"></td>

                        </tr>
                        <tr>
                            <td>9:00PM</td>
                            <td id="2100_M"></td>
                            <td id="2100_T"></td>
                            <td id="2100_W"></td>
                            <td id="2100_H"></td>
                            <td id="2100_F"></td>
                            <td id="2100_SA"></td>
                            <td id="2100_SU"></td>

                        </tr>

                    </tbody>
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>

            </div>
        </div>
    </div>
</div>

<!-- 14174 -->
<div class="modal fade text-left modal-borderless" id="cashierPayment" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cashier Payment Steps:</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body" style="text-align:justified">

                <ol>
                    <li>Download Assessment Form</li>
                    <li>Proceed to Cashier</li>
                    <li>Show Assessment Form</li>
                    <li>Settle Payment</li>
                    <li>Proceed to Registrar's Office for the Official Registration form</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button onclick="assessment_exporter('<?php echo site_url('temp_api/export_assessmentform') ?>')" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Download Assessment Form</span>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    var schedule_array = [700,730,800,830,900,930,1000,1030,1100,1130,1200,1230,1300,1330,1400,1430,1500,1530,1600,1650,1700,1750,1800,1830,1900,1930,2000,2030,2100];
    var filtered = schedule_array.filter((time) => { return time >= 700 && time <= 1230});


    console.log('this is filtered:'+filtered)
</script>
    