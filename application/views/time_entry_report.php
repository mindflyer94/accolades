<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Accolades</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <style>
        .error {
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
            <div><input type="text" id="search" placeholder="Search for Project"></div>
            <div class="card">
                <div class="card-header card-header1">
                    <h4><b>Time Entry Report</b></h4>
                </div>
                <div class="card-body">
                    <table class="display nowrap myTable" style="width: 100%">

                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Task Hour</th>

                            </tr>
                        </thead>
                        <tbody id="tblbdy">

                            <?php
                            $sl = 1;

                            // echo sizeof($result); die()
                            $test = null;



                            for ($i = 0; $i < sizeof($result); $i++) {
                                // /($i==0 || ($i+1)<sizeof($result) && $result[$i+1]->name!=$result[$i]->name)
                            ?>
                                <?php if ($test != $result[$i]->name) {
                                ?>
                                    <tr style="background-color: yellow;">
                                        <td><?php echo $sl ?></td>
                                        <td><?php
                                            echo $result[$i]->name
                                            ?></td>
                                        <td></td>
                                    </tr>
                                <?php
                                    $test = $result[$i]->name;
                                    $sl++;
                                } ?>
                                <tr>
                                    <td></td>
                                    <td><?php
                                        echo $result[$i]->taskname;
                                        ?></td>
                                    <td><?php echo $result[$i]->hour; ?></td>
                                </tr>
                            <?php
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
        $(document).on('keyup', '#search', function() {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/welcome/search',
                data: {
                    projectname: $(this).val()
                },
                dataType: "json",
                success: function(result) {
                    var sl = 1,
                        test = null,
                        row = '';
                    for (var i = 0; i < result.length; i++) {
                        if (test != result[i].name) {
                            row += '<tr style = "background-color: yellow;" >';
                            row += '<td>' + sl + '</td>';
                            row += '<td>' + result[i].name + '</td>';
                            row += '<td></td></tr> ';
                            test = result[i].name;
                            sl++;
                        }
                        row += '<tr><td></td>';
                        row += '<td>' + result[i].taskname + '</td>';
                        row += '<td>' + result[i].hour + '</td></tr>';
                    }
                    $("#tblbdy").html(row);
                }
            });
        });
    </script>

    <?php
    if (isset($message)) {
        if ($message == 0)
            echo "<script> alert('Task mapping exsist')</script>";
        else if ($message == 1)
            echo "<script> alert('success')</script>";
    }
    ?>
</body>

</html>