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

                            <?php if (isset($result)) {
                                ?>

                                <div class="card">
                                    <div class="card-header card-header1">
                                        <h4><b>Project Details</b></h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="display nowrap myTable" style="width: 100%">

                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Project Name</th>
                                                <th>Task Name</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $i = 1;

                                            foreach ($result as $row) {

                                                $status = $row->status;
                                                
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?>.</td>
                                                    <td><?php echo $row->name; ?></td>
                                                    <td><?php echo $row->taskname; ?></td>
                                                    <td><?php if($status) echo "Active"; else echo "Inactive" ?></td>

                                                    <td align="center">
                                                        <a href="<?php echo base_url(); ?>index.php/welcome/edit_task?id=<?php echo $row->id;?> " 
                                                            title="edit">
                                                            <i>edit</i></a>
                                                            <a onclick="confirm('Do you want to delete?')" href="<?php echo base_url(); ?>index.php/welcome/delete_task?id=<?php echo $row->id;?> " 
                                                            title="delete">
                                                            <i>delete</i></a>
                                                        </td>
                                                   
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
//
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
</script>

<?php
if(isset($message)){ 
    if($message == 0)
    echo "<script> alert('Task mapping exsist')</script>";
    else if($message == 1)
    echo "<script> alert('success')</script>";
}
?>
</body>
</html>
