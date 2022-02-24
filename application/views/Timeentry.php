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


                            <?php echo form_open('welcome', 'enctype="multipart/form-data"  
                                         method="post"  id="formID"  class="formular"'); ?>
                            <div class="card">
                                <div class="card-header ">
                                    <h4 class="text-center">Time Entry</h4>
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
                                                
                                                        echo '<option  value="' . $row['id']. '">' . $row['name'] . '</option>'; 
                                                    }
                                             
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4 offset-lg-2">
                                            <label class="col-form-label text-md-right">Task Name
                                                <span style="color:#FF0000">*</span></label>
                                            <select class="form-control " name="task" id="task" >
                                                <option value="">Select task</option>
                                    
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row">
                                
                                    <div class="form-group col-lg-4 offset-lg-1">
                                            <label class="col-form-label text-md-right">Hour
                                                <span style="color:#FF0000">*</span></label>
                                            <input type="number" class="form-control" name="hour"
                                                   id="hour" >
                                        
                                        </div>
                                        <div class="form-group col-lg-4 offset-lg-2">
                                            <label class="col-form-label text-md-right">Date
                                                <span style="color:#FF0000">*</span></label>
                                            <input type="date" class="form-control" name="date"
                                                   id="date"
                                                   min="<?php echo date("Y-m-d"); ?>">
                                          
                                        </div>
                                    </div>


                                    
                                    <div class="row">
                                
                                    <div class="form-group col-lg-4 offset-lg-1">
                                            <label class="col-form-label text-md-right">Description
                                                <span style="color:#FF0000">*</span></label>
                                                <textarea class="form-control"
                                                      name="description" id="description"></textarea>
                                        
                                        </div>
                                    </div>


                                    <div class="form-row text-center ">
                                        <div class="form-group">
                                            <button name="btnsubmit" type="submit"
                                                    value="Add" id="btnsubmit"
                                                    class="btn btn-primary btn-lg btn-action"
                                                    onclick="return submitForm();">
                                                Add
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php echo form_close(); ?>



                            <?php if (isset($timeentry)) {
                                ?>

                                <div class="card">
                                    <div class="card-header card-header1">
                                        <h4><b>Time Entry</b></h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="display nowrap myTable" style="width: 100%">

                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Project Name</th>
                                                <th>Task Name</th>
                                                <th>Hour</th>
                                                <th>Date</th>
                                                <th>Description</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $i = 1;

                                            foreach ($timeentry as $row) {
                                                $date = date("d-m-Y", strtotime($row->time_date));
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?>.</td>
                                                    <td><?php echo $row->project; ?></td>
                                                    <td><?php echo $row->task; ?></td>
                                                    <td><?php echo $row->time_hour; ?></td>
                                                    <td><?php echo $date ?></td>
                                                    <td><?php echo $row->description; ?></td>
                                                   


                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php } ?>





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
                hour: {
                    required: true
                },
                date: {
                    required: true
                    
                },
                description: {
                    required: true
                    
                }

            },

            messages: {
                project_name: {
                    required: "Please Select Project"
                },
                task: {
                    required: "Please Select Task"
                },
                hour: {
                    required: "Please Enter Hours"
                },
                date: {
                    required: "Please Enter Date"
                },
                description: {
                    required: "Please Enter Description"
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
