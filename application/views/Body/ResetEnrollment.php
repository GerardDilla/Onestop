<section class="section col-sm-12">
    <div class="card" style="margin:none;">
        <div class="card-header">
            Update Legend
        </div>
        <div class="card-body">
            <div class="col-md-12 row">
                <div class="col-md-6 form-group">
                    <label class="input-label"><b>Semester</b></label>
                        <select name="reset_sem" class="form-control" onchange="updateLegend()">
                            <option></option>
                            <option value="FIRST">FIRST</option>
                            <option value="SECOND">SECOND</option>
                            <option value="SUMMER">SUMMER</option>
                        </select> 
                    <div class="invalid-feedback">
                        This is required.
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label class="input-label"><b>School Year</b></label>
                            <?php
                                $current_year = intval(date("Y"));
                                // echo '<option value="'.$current_year-1.'-'.$current_year.'">'.$current_year-1.'-'.$current_year.'</option>';
                                // echo '<option value="'.$current_year.'-'.$current_year+1.'">'.$current_year.'-'.$current_year+1.'</option>';
                                // echo '<option value="'.$current_year+1.'-'.$current_year+2.'">'.$current_year+1.'-'.$current_year+2.'</option>';
                            ?>
                        <select name="school_year" class="form-control" onchange="updateLegend()">
                            <option value=""></option>
                            <option value="<?php echo ($current_year-2).'-'.($current_year-1);?>"><?php echo ($current_year-2).'-'.($current_year-1);?></option>
                            <option value="<?php echo ($current_year-1).'-'.$current_year;?>"><?php echo ($current_year-1).'-'.$current_year;?></option>
                            <option value="<?php echo $current_year.'-'.($current_year+1);?>"><?php echo $current_year.'-'.($current_year+1); ?></option>
                            <option value="<?php echo ($current_year+1).'-'.($current_year+2);?>"><?php echo ($current_year+1).'-'.($current_year+2);?></option>
                        </select>
                    <div class="invalid-feedback">
                        This is required.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function updateLegend(){
    // alert('asdasd');
    // updateEnrollmentLegend
    $.ajax({
        url: "<?php echo base_url('main/updateEnrollmentLegend');?>",
        method: 'get',
        dataType: 'json',
        data:{
            school_year:$('select[name=school_year]').val(),
            sem:$('select[name=reset_sem]').val()
        },
        success: function(response) {
            // alert('zuasd');
            console.log(response)
        },
        error: function(response){
            console.log(response)
        }
    });
}
$(document).ready(function(){
    var sem_legend = "<?php echo $sem;?>";
    var sy_legend = "<?php echo $sy;?>";
    $('select[name=reset_sem]').val(sem_legend);
    $('select[name=school_year]').val(sy_legend);
    
})
</script>