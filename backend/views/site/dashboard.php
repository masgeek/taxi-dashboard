<?php

/**
 * Created by PhpStorm.
 * User: MAS
 * Date: 4/3/2019
 * Time: 6:48 PM
 */

/* @var $this \yii\web\View */
$this->params['breadcrumbs'][] = $this->title;

$fmt = Yii::$app->formatter;
?>

<div class="row">
    <div class="col-xl-3 col-md-6 col-12">
        <div class="box box-body">
            <h6 class="mb-0">
                <span class="text-uppercase">Ongoing Trips</span>
                <span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span>
            </h6>
            <br>
            <small>Daily Ongoing Trips</small>
            <p class="font-size-26">51</p>

            <div class="font-size-12"><i class="ion-arrow-graph-up-right text-success mr-1"></i> %16 decrease from last
                month
            </div>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-xl-3 col-md-6 col-12">
        <div class="box box-body">
            <h6 class="mb-0">
                <span class="text-uppercase">Scheduled Trips</span>
                <span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span>
            </h6>
            <br>
            <small>Weekly Scheduled Trips</small>
            <p class="font-size-26"><?= $fmt->asDecimal(200) ?></p>

            <div class="font-size-12"><i class="ion-arrow-graph-up-right text-success mr-1"></i> 120 more than last
                week
            </div>
        </div>
    </div>
    <!-- /.col -->

    <div class="col-xl-3 col-md-6 col-12">
        <div class="box box-body">
            <h6 class="mb-0">
                <span class="text-uppercase">Completed Trips</span>
                <span class="float-right"><a class="btn btn-xs btn-success" href="#">View</a></span>
            </h6>
            <br>
            <small>Daily Completed Trips</small>
            <p class="font-size-26"><?= $fmt->asDecimal(200) ?></p>

            <div class="flexbox font-size-12">
                <span><i class="ion-arrow-graph-up-right text-success mr-1"></i> %37 up yesterday</span>
            </div>
        </div>
    </div>
    <!-- /.col -->

    <div class="col-xl-3 col-md-6 col-12">
        <div class="box box-body">
            <h6 class="mb-0">
                <span class="text-uppercase">REVENUE STATUS</span>
                <span class="float-right"><a class="btn btn-xs btn-success" href="#">View</a></span>
            </h6>
            <br>
            <small>Daily Revenue</small>
            <p class="font-size-26"><?= $fmt->asCurrency('120000') ?></p>

            <div class="font-size-12"><i class="ion-arrow-graph-down-right text-danger mr-1"></i> %41 down last
                yesterday
            </div>
        </div>
    </div>
    <!-- /.col -->

</div>

<div class="row">
    <div class="col-12 col-lg-7 connectedSortable">
        <!-- AREA CHART -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Revenue Statistics</h4>

                <ul class="box-controls pull-right">
                    <li><a class="box-btn-close" href="#"></a></li>
                    <li><a class="box-btn-slide" href="#"></a></li>
                    <li><a class="box-btn-fullscreen" href="#"></a></li>
                </ul>
            </div>
            <div class="box-body chart-responsive">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-12">
                        <ul class="list-unstyled">
                            <li class="bb-1 py-10">
                                <p class="mb-0">Trips</p>
                                <div class="font-size-20 mb-5"><?= $fmt->asDecimal(50000) ?></div>
                                <div class="font-size-18 text-success">
                                    <i class="fa fa-arrow-up pr-5"></i><span>+18%</span>
                                </div>
                            </li>

                            <li class="bb-1 py-10">
                                <p class="mb-0">Bookings</p>
                                <div class="font-size-20 mb-5"><?= $fmt->asDecimal(1000) ?></div>
                                <div class="font-size-18 text-success">
                                    <i class="fa fa-arrow-up pr-5"></i><span>+9%</span>
                                </div>
                            </li>

                            <li class="py-10">
                                <p class="mb-0">Revenue</p>
                                <div class="font-size-20 mb-5"><?= $fmt->asCurrency(3427537.82) ?></div>
                                <div class="font-size-18 text-danger">
                                    <i class="fa fa-arrow-down pr-5"></i><span>-8%</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-10 col-md-9 col-12">
                        <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>

    <div class="col-12 col-lg-5 connectedSortable">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Top 10 Drivers</h4>
                <ul class="box-controls pull-right">
                    <li><a class="box-btn-close" href="#"></a></li>
                    <li><a class="box-btn-slide" href="#"></a></li>
                    <li><a class="box-btn-fullscreen" href="#"></a></li>
                </ul>
            </div>
            <div class="box-body">
                <div class="flexbox align-items-center">
                    <div>
                        <div id="e_chart_3" class="w-200" style="height:200px;"></div>
                    </div>
                    <div>
                        <ul class="list-inline">
                            <li class="mb-5">
                                <span class="badge badge-dot badge-lg mr-1 badge-primary"></span>
                                <span>iPhone X</span>
                            </li>

                            <li class="mb-5">
                                <span class="badge badge-dot badge-lg mr-1 badge-secondary"></span>
                                <span>Mi tv4 55"</span>
                            </li>

                            <li class="mb-5">
                                <span class="badge badge-dot badge-lg mr-1 badge-success"></span>
                                <span>S9 plus</span>
                            </li>

                            <li class="mb-5">
                                <span class="badge badge-dot badge-lg mr-1 badge-info"></span>
                                <span>Pixal 2</span>
                            </li>

                            <li class="mb-5">
                                <span class="badge badge-dot badge-lg mr-1 badge-warning"></span>
                                <span>Macbook Air</span>
                            </li>

                            <li class="mb-5">
                                <span class="badge badge-dot badge-lg mr-1 badge-danger"></span>
                                <span>iPhone 8 plus</span>
                            </li>

                            <li class="mb-5">
                                <span class="badge badge-dot badge-lg mr-1 badge-purple"></span>
                                <span>Mi Note 7</span>
                            </li>

                            <li class="mb-5">
                                <span class="badge badge-dot badge-lg mr-1 badge-pink"></span>
                                <span>Lg G9</span>
                            </li>

                            <li class="mb-5">
                                <span class="badge badge-dot badge-lg mr-1 badge-yellow"></span>
                                <span>iMac 21"</span>
                            </li>

                            <li>
                                <span class="badge badge-dot badge-lg mr-1 badge-brown"></span>
                                <span>Google Home</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>

    <div class="col-12 col-lg-4 connectedSortable">
        <div class="box">
            <div class="bg-img box-inverse" style="background-image: url(../images/gallery/thumb/14.jpg);"
                 data-overlay="5">
                <div class="box-header no-border">
                    <h4>Data Stats</h4>
                    <ul class="box-controls pull-right">
                        <li class="dropdown">
                            <a data-toggle="dropdown" href="#"
                               class="btn btn-rounded btn-outline btn-white px-10">Stats</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
                                <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
                                <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="box-body">
                    <div class="flexbox flex-justified text-center mt-50">
                        <div class="b-1 rounded py-20">
                            <p class="mb-0 fa-3x">30%</p>
                            <p class="mb-0 font-weight-300">DIRECT SALE</p>
                        </div>
                        <div class="b-1 rounded py-20">
                            <p class="mb-0 fa-3x">40%</p>
                            <p class="mb-0 font-weight-300">WHOLE SALE</p>
                        </div>
                        <div class="b-1 rounded py-20">
                            <p class="mb-0 fa-3x">50%</p>
                            <p class="mb-0 font-weight-300">RETAIL SALE</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="text-center py-15 bb-1 bb-dashed">
                    <h4>Monthly Income</h4>
                    <ul class="flexbox flex-justified text-center my-20">
                        <li class="px-10">
                            <h6 class="mb-0 text-bold">8952</h6>
                            <small>Abu Dhabi</small>
                        </li>

                        <li class="br-1 bl-1 px-10">
                            <h6 class="mb-0 text-bold">7458</h6>
                            <small>Miami</small>
                        </li>

                        <li class="px-10">
                            <h6 class="mb-0 text-bold">3254</h6>
                            <small>London</small>
                        </li>
                    </ul>
                </div>
                <div class="text-center py-10 bb-1 bb-dashed">
                    <h4>Taxes info</h4>
                    <ul class="flexbox flex-justified text-center my-20">
                        <li class=" px-10">
                            <h6 class="mb-0 text-bold">8952</h6>
                            <small>Abu Dhabi</small>
                        </li>

                        <li class="br-1 bl-1 px-10">
                            <h6 class="mb-0 text-bold">7458</h6>
                            <small>Miami</small>
                        </li>

                        <li class="px-10">
                            <h6 class="mb-0 text-bold">3254</h6>
                            <small>London</small>
                        </li>
                    </ul>
                </div>
                <div class="text-center py-10 mt-2">
                    <h4>Partners Sale</h4>
                    <ul class="flexbox flex-justified text-center my-20">
                        <li class="px-10">
                            <h6 class="mb-0 text-bold">8952</h6>
                            <small>Abu Dhabi</small>
                        </li>

                        <li class="br-1 bl-1 px-10">
                            <h6 class="mb-0 text-bold">7458</h6>
                            <small>Miami</small>
                        </li>

                        <li class="px-10">
                            <h6 class="mb-0 text-bold">3254</h6>
                            <small>London</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-12 connectedSortable">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Invoice List</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="invoice-list" class="table table-hover no-wrap" data-page-size="10">
                        <thead>
                        <tr>
                            <th>#Invoice</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Issue</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>#5010</td>
                            <td>Lorem Ipsum</td>
                            <td>$548</td>
                            <td><span class="label label-danger">Unpaid</span></td>
                            <td>15-Jan</td>
                            <td>
                                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#5011</td>
                            <td>Lorem Ipsum</td>
                            <td>$548</td>
                            <td><span class="label label-success">Paid</span></td>
                            <td>15-Sep</td>
                            <td>
                                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#5012</td>
                            <td>Lorem Ipsum</td>
                            <td>$9658</td>
                            <td><span class="label label-danger">Unpaid</span></td>
                            <td>15-Jun</td>
                            <td>
                                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#5013</td>
                            <td>Lorem Ipsum</td>
                            <td>$4587</td>
                            <td><span class="label label-success">Paid</span></td>
                            <td>15-May</td>
                            <td>
                                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#5014</td>
                            <td>Lorem Ipsum</td>
                            <td>$856</td>
                            <td><span class="label label-danger">Unpaid</span></td>
                            <td>15-Mar</td>
                            <td>
                                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#5015</td>
                            <td>Lorem Ipsum</td>
                            <td>$956</td>
                            <td><span class="label label-danger">Unpaid</span></td>
                            <td>15-Aug</td>
                            <td>
                                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#5016</td>
                            <td>Lorem Ipsum</td>
                            <td>$745</td>
                            <td><span class="label label-success">Paid</span></td>
                            <td>15-Aug</td>
                            <td>
                                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#5010</td>
                            <td>Lorem Ipsum</td>
                            <td>$548</td>
                            <td><span class="label label-danger">Unpaid</span></td>
                            <td>15-Jan</td>
                            <td>
                                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#5011</td>
                            <td>Lorem Ipsum</td>
                            <td>$548</td>
                            <td><span class="label label-success">Paid</span></td>
                            <td>15-Sep</td>
                            <td>
                                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#5012</td>
                            <td>Lorem Ipsum</td>
                            <td>$9658</td>
                            <td><span class="label label-danger">Unpaid</span></td>
                            <td>15-Jun</td>
                            <td>
                                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>#5013</td>
                            <td>Lorem Ipsum</td>
                            <td>$4587</td>
                            <td><span class="label label-success">Paid</span></td>
                            <td>15-May</td>
                            <td>
                                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>

    <div class="col-lg-6 col-12 connectedSortable">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Recent Reviews</h4>
                <div class="box-controls pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-xs btn-default">Sort by Newest</button>
                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Sort by Newest</a>
                            <a class="dropdown-item" href="#">Sort by Highest Rating</a>
                            <a class="dropdown-item" href="#">Sort by Highest Rating</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-body">
                <div class="media-list media-list-divided">
                    <div class="media p-0">
                        <div class="media-body m-0">
                            <div class="flexbox">
                                <div>
                                    <h4 class="mb-0">For T-shirt</h4>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star-half"></a>
                                </div>
                            </div>
                            <p>By<strong><a href="javascript:void(0)" class="inline-block capitalize-font  mb-5">Johen
                                        Doe</a></strong> <span class="float-right">11 day ago</span></p>
                            <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                                velit.</p>
                            <div class="media-block-actions my-5">
                                <nav class="nav nav-dot-separated no-gutters">
                                    <div class="nav-item">
                                        <a class="nav-link text-success" href="#"><i class="fa fa-thumbs-up"></i>
                                            (17)</a>
                                    </div>
                                    <div class="nav-item">
                                        <a class="nav-link text-danger" href="#"><i class="fa fa-thumbs-down"></i> (22)</a>
                                    </div>
                                </nav>

                                <nav class="nav no-gutters gap-2 font-size-16 media-hover-show">
                                    <a class="nav-link text-success" href="#" data-toggle="tooltip" title=""
                                       data-original-title="Approve"><i class="ion-checkmark"></i></a>
                                    <a class="nav-link text-danger" href="#" data-toggle="tooltip" title=""
                                       data-original-title="Delete"><i class="ion-close"></i></a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="media p-0">
                        <div class="media-body m-0">
                            <div class="flexbox mt-10">
                                <div>
                                    <h4 class="mb-0">For Shirt</h4>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star-half"></a>
                                </div>
                            </div>
                            <p>By<strong><a href="javascript:void(0)" class="inline-block capitalize-font  mb-5">Johen
                                        Doe</a></strong> <span class="float-right">11 day ago</span></p>
                            <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                                velit.</p>
                            <div class="media-block-actions my-5">
                                <nav class="nav nav-dot-separated no-gutters">
                                    <div class="nav-item">
                                        <a class="nav-link text-success" href="#"><i class="fa fa-thumbs-up"></i>
                                            (17)</a>
                                    </div>
                                    <div class="nav-item">
                                        <a class="nav-link text-danger" href="#"><i class="fa fa-thumbs-down"></i> (22)</a>
                                    </div>
                                </nav>

                                <nav class="nav no-gutters gap-2 font-size-16 media-hover-show">
                                    <a class="nav-link text-success" href="#" data-toggle="tooltip" title=""
                                       data-original-title="Approve"><i class="ion-checkmark"></i></a>
                                    <a class="nav-link text-danger" href="#" data-toggle="tooltip" title=""
                                       data-original-title="Delete"><i class="ion-close"></i></a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="media p-0">
                        <div class="media-body m-0">
                            <div class="flexbox mt-10">
                                <div>
                                    <h4 class="mb-0">For Dress</h4>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star"></a>
                                    <a href="javascript:void(0);" class="fa fa-star-half"></a>
                                </div>
                            </div>
                            <p>By<strong><a href="javascript:void(0)" class="inline-block capitalize-font  mb-5">Johen
                                        Doe</a></strong> <span class="float-right">11 day ago</span></p>
                            <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                                velit.</p>
                            <div class="media-block-actions my-5">
                                <nav class="nav nav-dot-separated no-gutters">
                                    <div class="nav-item">
                                        <a class="nav-link text-success" href="#"><i class="fa fa-thumbs-up"></i>
                                            (17)</a>
                                    </div>
                                    <div class="nav-item">
                                        <a class="nav-link text-danger" href="#"><i class="fa fa-thumbs-down"></i> (22)</a>
                                    </div>
                                </nav>

                                <nav class="nav no-gutters gap-2 font-size-16 media-hover-show">
                                    <a class="nav-link text-success" href="#" data-toggle="tooltip" title=""
                                       data-original-title="Approve"><i class="ion-checkmark"></i></a>
                                    <a class="nav-link text-danger" href="#" data-toggle="tooltip" title=""
                                       data-original-title="Delete"><i class="ion-close"></i></a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6 col-lg-6 connectedSortable">
        <div class="box">
            <div class="box-header with-border">
                <h5 class="box-title">Resent Notifications</h5>
            </div>
            <div class="box-body p-15">
                <div class="media-list media-list-hover">
                    <a class="media media-single" href="#">
                        <h4 class="w-50 text-gray font-weight-500">10:10</h4>
                        <div class="media-body pl-15 bl-5 rounded border-primary">
                            <p>Morbi quis ex eu arcu auctor sagittis.</p>
                            <span class="text-fade">by Johne</span>
                        </div>
                    </a>

                    <a class="media media-single" href="#">
                        <h4 class="w-50 text-gray font-weight-500">08:40</h4>
                        <div class="media-body pl-15 bl-5 rounded border-success">
                            <p>Proin iaculis eros non odio ornare efficitur.</p>
                            <span class="text-fade">by Amla</span>
                        </div>
                    </a>

                    <a class="media media-single" href="#">
                        <h4 class="w-50 text-gray font-weight-500">07:10</h4>
                        <div class="media-body pl-15 bl-5 rounded border-info">
                            <p>In mattis mi ut posuere consectetur.</p>
                            <span class="text-fade">by Josef</span>
                        </div>
                    </a>

                    <a class="media media-single" href="#">
                        <h4 class="w-50 text-gray font-weight-500">01:15</h4>
                        <div class="media-body pl-15 bl-5 rounded border-danger">
                            <p>Morbi quis ex eu arcu auctor sagittis.</p>
                            <span class="text-fade">by Rima</span>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>

</div>
