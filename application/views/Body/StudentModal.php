<style>
    #oldStudentAccountModal .modal-dialog{
        max-width: 650px;
    }
</style>
<div class="modal fade text-left w-100" id="oldStudentAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16">Old Student Account</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    <table id="oldStudentAccountTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Course</th>
                                <th>Major</th>
                                <th>Year</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <img style="width:10%; display:none" class="temp_loading" src="<?php echo base_url('assets/images/barloader.gif'); ?>">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-primary add-all-subject" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Add All</span>
                </button> -->
            </div>
        </div>
    </div>
</div>
<script>
$('#oldStudentAccountTable').DataTable({
    "responsive":true
});
$('#oldStudentAccountModal').on('shown.bs.modal', function () {
    
    // url: "<?php echo base_url(); ?>index.php/main/getOldAccountTable",
    $('#oldStudentAccountModal').waitMe({
        effect: 'bounce',
        text: '',
        bg: 'rgba(255,255,255,0.7)',
        color: '#000',
        maxSize: '',
        waitTime: -1,
        textPos: 'vertical',
        fontSize: '',
        source: '',
        onClose: function() {}
    });
    $.ajax({
        url: "<?php echo base_url(); ?>main/getOldAccountTable",
        method: 'get',
        dataType: 'json',
        success: function(response) {
            // storagedata
            $('#oldStudentAccountTable').DataTable().destroy();
            $('#oldStudentAccountTable tbody').empty();
            var html = '';
            $.each(response,function(index,value){
                console.log(value.Reference_Number)
                html += `<tr>
                <td>${value.First_Name+' '+value.Middle_Name+' '+value.Last_Name}</td>
                <td>${value.Course}</td>
                <td>${value.Major}</td>
                <td>${value.YearLevel}</td>
                <td><button class="btn btn-sm btn-info" data-ref_no="${value.Reference_Number}">Gen. Code</button></td>
                </tr>`
            })
            $('#oldStudentAccountTable tbody').append(html);
            $('#oldStudentAccountTable').DataTable({
                "ordering": true,
                "bPaginate": true,
                "bLengthChange": false,
                "responsive": true
            });
            $('#oldStudentAccountModal').waitMe('hide');
        },
        error: function(response) {
            $('#oldStudentAccountModal').waitMe('hide');
        }
    });
});
</script>
<script src="<?php echo base_url('assets/vendors/waitMe/waitMe.js');?>"></script>