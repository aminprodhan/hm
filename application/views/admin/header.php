<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
    <title>Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/default_css.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.css">
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <!--    Online CSS & JS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/extjs/6.0.0/classic/theme-triton/resources/theme-triton-all.css"
          rel="stylesheet"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/extjs/6.0.0/ext-all.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/extjs/6.0.0/classic/locale/locale-ko.js"></script>

    <!--Custom CSS In Folders  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom-css-mizan.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/tcal.css">

    <!--Custom JS In Folders    -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/common/link.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/tcal.js"></script>

</head>

<body>
<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="<?php echo base_url(); ?>" class="logo">
                <img src="<?php echo base_url(); ?>assets/img/logo.png" width="40" height="40" alt="">
            </a>
        </div>
        <div class="page-title-box pull-left">
            <h3>Admin</h3>
        </div>
        <a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars"
                                                                           aria-hidden="true"></i></a>
        <ul class="nav navbar-nav navbar-right user-menu pull-right">
            <li class="dropdown">
                <a href="profile.php" class="dropdown-toggle user-link" data-toggle="dropdown" title="Admin">
                        <span class="user-img"><img class="img-circle"
                                                    src="<?php echo base_url(); ?>assets/img/user.jpg" width="40"
                                                    alt="Admin">
							<span class="status online"></span></span>
                    <span>admin</span>
                    <i class="caret"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="login.php">Logout</a></li>
                </ul>
            </li>
        </ul>
        <div class="dropdown mobile-user-menu pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
            <ul class="dropdown-menu pull-right">
                <li><a href="login.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li>
                        <a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> <span> Setting</span> <span
                                    class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="<?php echo base_url(); ?>admin/menu">Menu</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/country">Country</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/season">Season</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/floorCreate">Floor Create</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#hmModal">Hotel Info</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#hmModal">Hotel Module</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-laptop" aria-hidden="true"></i> <span> Components</span> <span
                                    class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="<?php echo base_url(); ?>demo/uikit">UI Kit</a></li>
                            <li><a href="<?php echo base_url(); ?>demo/tabs">Tabs</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-edit" aria-hidden="true"></i> <span> Forms</span> <span
                                    class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="<?php echo base_url(); ?>demo/form_basic_inputs">Basic Inputs</a></li>
                            <li><a href="<?php echo base_url(); ?>demo/form_input_groups">Input Groups</a></li>
                            <li><a href="<?php echo base_url(); ?>demo/form_horizontal">Horizontal Form</a></li>
                            <li><a href="<?php echo base_url(); ?>demo/form_vertical">Vertical Form</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-table" aria-hidden="true"></i> <span> Tables</span> <span
                                    class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="<?php echo base_url(); ?>demo/tables_basic">Basic Tables</a></li>
                            <li><a href="<?php echo base_url(); ?>demo/tables_datatables">Data Table</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-columns" aria-hidden="true"></i> <span>Pages</span> <span
                                    class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="<?php echo base_url(); ?>demo/login"> Login </a></li>
                            <li><a href="<?php echo base_url(); ?>demo/forgot_password"> Forgot Password </a></li>
                            <li><a href="<?php echo base_url(); ?>demo/blank_page"> Blank Page </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><i class="fa fa-share-alt" aria-hidden="true"></i> <span>Multi Level</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="submenu">
                                <a href="javascript:void(0);"><span>Level 1</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                    <li class="submenu">
                                        <a href="javascript:void(0);"> <span> Level 2</span> <span
                                                    class="menu-arrow"></span></a>
                                        <ul class="list-unstyled" style="display: none;">
                                            <li><a href="javascript:void(0);">Level 3</a></li>
                                            <li><a href="javascript:void(0);">Level 3</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><span>Level 1</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hmModal" tabindex="-1" role="dialog" aria-labelledby="hmModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Hotel Add Form</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-9 col-md-9">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hotel Name</label>
                                            <input type="text" class="input-sm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="input-sm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Website</label>
                                            <input type="text" class="input-sm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="select-sm form-group">
                                            <label>Hotel Type</label>
                                            <select class="select">
                                                <option>Select</option>
                                                <option value="1">2 Star</option>
                                                <option value="2">3 Star</option>
                                                <option value="2">4 Star</option>
                                                <option value="2">5 Star</option>
                                                <option value="2">6 Star</option>
                                                <option value="2">7 Star</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="input-sm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="input-sm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="input-sm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" class="input-sm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" class="input-sm form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="input-sm form-control">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <button type="sumbit" class="btn btn-success input-sm form-control">Save</button>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning input-sm form-control">Update</button>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-danger input-sm form-control">Delete</button>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-default input-sm form-control"
                                        data-dismiss="modal">Close
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer text-left">
                    <!--Table list -->
                    <div class="card-box">
                        <div class="card-block">
                            <h6 class="card-title text-bold">Hotel list</h6>
                            <table class="display datatable table table-stripped">
                                <thead>
                                <tr>
                                    <th>Hotel Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                    <!-- <th>Salary</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Hotel The Cox Today</td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 1 &nbsp;
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 2 &nbsp;
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 3 &nbsp;
                                            </label>
                                        </div>
                                    </td>
                                    <td>Edinburgh</td>
                                    <td>Active</td>
                                    <td>
                                        <a href="#" title="Edit" class="btn btn-warning"><i
                                                    class="fa fa-pencil fa-1x"></i></a>
                                        <a href="#" title="delete" class="btn btn-danger"><i
                                                    class="fa fa-trash fa-1x"></i></a>
                                    </td>
                                    <!-- <td>$320,800</td> -->
                                </tr>
                                <tr>
                                    <td>Hotel Shaibal</td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 1 &nbsp;
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox"> Module 2 &nbsp;
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 3 &nbsp;
                                            </label>
                                        </div>
                                    </td>
                                    <td>Edinburgh</td>
                                    <td>Inactive</td>
                                    <td>
                                        <a href="#" title="Edit" class="btn btn-warning"><i
                                                    class="fa fa-pencil fa-1x"></i></a>
                                        <a href="#" title="delete" class="btn btn-danger"><i
                                                    class="fa fa-trash fa-1x"></i></a>
                                    </td>
                                    <!-- <td>$320,800</td> -->
                                </tr>
                                <tr>
                                    <td>Hotel Seagull</td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 1 &nbsp;
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox""> Module 2 &nbsp;
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox"> Module 3 &nbsp;
                                            </label>
                                        </div>
                                    </td>
                                    <td>Edinburgh</td>
                                    <td>Active</td>
                                    <td>
                                        <a href="#" title="Edit" class="btn btn-warning"><i
                                                    class="fa fa-pencil fa-1x"></i></a>
                                        <a href="#" title="delete" class="btn btn-danger"><i
                                                    class="fa fa-trash fa-1x"></i></a>
                                    </td>
                                    <!-- <td>$320,800</td> -->
                                </tr>
                                <tr>
                                    <td>Hotel Sea Palace</td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 1 &nbsp;
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 2 &nbsp;
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 3 &nbsp;
                                            </label>
                                        </div>
                                    </td>
                                    <td>Edinburgh</td>
                                    <td>Active</td>
                                    <td>
                                        <a href="#" title="Edit" class="btn btn-warning"><i
                                                    class="fa fa-pencil fa-1x"></i></a>
                                        <a href="#" title="delete" class="btn btn-danger"><i
                                                    class="fa fa-trash fa-1x"></i></a>
                                    </td>
                                    <!-- <td>$320,800</td> -->
                                </tr>
                                <tr>
                                    <td>Cox Valley</td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 1 &nbsp;
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 2 &nbsp;
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked=""> Module 3 &nbsp;
                                            </label>
                                        </div>
                                    </td>
                                    <td>Edinburgh</td>
                                    <td>Active</td>
                                    <td>
                                        <a href="#" title="Edit" class="btn btn-warning"><i
                                                    class="fa fa-pencil fa-1x"></i></a>
                                        <a href="#" title="delete" class="btn btn-danger"><i
                                                    class="fa fa-trash fa-1x"></i></a>
                                    </td>
                                    <!-- <td>$320,800</td> -->
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->