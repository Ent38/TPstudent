@section('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <style>
        .stat-text a {
            word-wrap: break-word !important;
        }
    </style>
@endsection

@can('view_students')
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-1">
            <div class="card-body pb-0">

                <h4 class="mb-0">
                    <span class="count">{{ $numberOfStudents }}</span>
                </h4>
                <p class="text-light">@lang('roles.student')</p>

                <div class="chart-wrapper px-0" style="height:70px;" height="70">
                    <i class="fa fa-graduation-cap fa-4x"></i>
                </div>

            </div>

        </div>
    </div>
@endcan

<!--/.col-->


@can('view_admin')
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count">{{ $numberOfAdmins }}</span>
                </h4>
                <p class="text-light">@lang('roles.admin')</p>
                <div class="chart-wrapper px-3" style="height:70px;" height="70">
                    <i class="fa fa-user fa-4x"></i>
                </div>
            </div>
        </div>
    </div>
@endcan




<div class="col-lg-3 col-md-6">
    <div class="social-box twitter">
        <i class="fa fa-graduation-cap fa-4x"></i>
        <ul>
            <li>
                <span class="count">{{ $numberOfActiveStudents }}</span>
                <span style="color:green">@lang('Active')</span>
            </li>
            <li>
                <span class="count">{{ $numberOfInactiveStudents }}</span>
                <span style=" color:red">@lang('Inactive')</span>
            </li>
        </ul>
    </div>
    <!--/social-box-->
</div>
<!--/.col-->


