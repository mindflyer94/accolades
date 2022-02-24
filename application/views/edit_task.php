<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Accolades</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

<style>
    .error{
        color: red;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body>
<div class="col-12">


<div class="section-header">
    <nav class="navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="nav nav-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url() . 'index.php/welcome/get_project' ?>">Project</a>
                    </li>
                </ul>
            </div>
            <div class="nav nav-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url() . 'index.php/welcome/view_task'  ?>">Task</a>
                    </li>
                </ul>
            </div>

            <div class="nav nav-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url() . 'index.php/welcome/get_timeentry'  ?>">Time Entry Report</a>
                    </li>
                </ul>
            </div>
            
            
        </div>
    </nav>
</div>
<?php
                //echo $batch;
                if (isset($edit_task)) {
                    //echo $batch;
                    foreach ($edit_task as $row1) {
                       $t_id = $row1->id;
                     $status = $row1->status; 
                     $t_name = $row1->taskname; 
                     $p_id = $row1->project_id; 

                    }
                }
                ?>


                            <?php echo form_open('welcome/view_task', 'enctype="multipart/form-data"  
                                         method="post"  id="formID"  class="formular"'); ?>
                            <div class="card">
                                <input type="hidden" id="t_id" name="t_id" value="<?php echo $t_id; ?>"/>
                                <div class="card-header ">
                                    <h4 class="text-center">Update Project</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                
                                    <div class="form-group col-lg-4 offset-lg-1">
                                            <label class="col-form-label text-md-right">Project Name
                                                <span style="color:#FF0000">*</span></label>
                                            <select class="form-control" name="project_name" id="project_name"
                                                    onChange="get_task(this.value)">
                                                <option value="">Select Project</option>
                                                <?php
                                                foreach ($project as $row) {
                                                if($p_id == $row['id'])
                                                echo '<option  value="' . $row['id']. '" selected="selected">' . $row['name'] . '</option>'; 
                                                else
                                                 echo '<option  value="' . $row['id']. '">' . $row['name'] . '</option>'; 
                                                    }
                                             
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-4 offset-lg-2">
                                            <label class="col-form-label text-md-right">Task Name
                                                <span style="color:#FF0000">*</span></label>
                                            <input class="form-control" type="text" name="task" id="task" value="<?php  echo $t_name; ?>"/>
                                        </div>
                                    
                                    </div>


                                    <div class="row">
                                    <div class="form-group col-lg-4 offset-lg-1">
                                            <label class="col-form-label text-md-right">Status
                                                <span style="color:#FF0000">*</span></label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="">Select</option>
                                                <option value="1" <?php if($status == 1) echo 'selected="selected"';?>>Active</option>
                                                <option value="0" <?php if($status == 0) echo 'selected="selected"';?> >Inactive</option>
                                               
                                               
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-row text-center ">
                                        <div class="form-group">
                                            <button name="btnsubmit" type="submit"
                                                    value="update" id="btnsubmit"
                                                    class="btn btn-primary btn-lg btn-action"
                                                    onclick="return submitForm();">
                                                 Update
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php echo form_close(); ?>



                        </div>
                    </div>
                </div>


</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

jQuery(document).ready(function () {
    $('.myTable').DataTable();

        $("#formID").validate({
            rules: {

                project_name: {
                    required: true
                },
                task: {
                    required: true
                },
                status: {
                    required: true
                }

            },

            messages: {
                project_name: {
                    required: "Please Select Project"
                },
                task: {
                    required: "Please enter Task"
                },
                status: {
                    required: "Please select status"
                }
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            }


        });
    });


function get_task(str){

var url = '<?php echo base_url();?>index.php/welcome/get_task/' + str ;
//$('#task option').remove();
var newR = "<option value=''>Select</option>";
var newR1 = "<label></label><input type='text' name='' value=''/>";
$.ajax({
    type: 'get',
    url: url,
    data: '',
    dataType: "json",
    beforeSend: function () {
    },
    success: function (data) {
        if ($.isEmptyObject(data.task)) {
            alert("No Task Added");
        }
        else {
            var newR = "<option value=''>Select</option>";
            $.each(data.task, function (index, element) {
                newR += "<option value=" + element.id + ">" + element.taskname + "</option>";
            
            });
            $('#task').html();
            $('#task').html(newR);
        }
    }
});


}
</script>
</body>
</html>
