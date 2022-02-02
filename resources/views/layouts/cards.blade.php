<div class="row mb-2">
    @can('Countries')
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body">
                <h1 class="card-title">{{__('Countries')}}</h1>
                <h4 class="card-text text-grey">{{App\Models\Country::count()}}</h4>
                <hr>
                <a href="{{route('countries.index')}}" class="nav-link text-grey">View All</a>
            </div>
        </div>
    </div>
    @endcan
    @can('Locations')
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body">
                <h1 class="card-title">{{__('Locations')}}</h1>
                <h4 class="card-text text-grey">{{App\Models\Location::count()}}</h4>
                <hr>
                <a href="{{route('locations.index')}}" class="nav-link text-grey">View All</a>
            </div>
        </div>
    </div>
    @endcan
    @can('Workers')
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body">
                <h1 class="card-title">{{__('Plant Workers')}}</h1>
                <h4 class="card-text text-grey">{{App\Models\Worker::count()}}</h4>
                <hr>
                <a href="{{route('workers.index')}}" class="nav-link text-grey">View All</a>
            </div>
        </div>
    </div>
    @endcan
    @can('Users')
    <div class="col-12 col-md-3">
        <div class="card card-statistic">
            <div class="card-body">
                <h1 class="card-title">Application Users</h1>
                <h4 class="card-text text-grey">{{App\Models\User::count()}}</h4>
                <hr>
                <a href="{{route('users.index')}}" class="nav-link text-grey">View All</a>
            </div>
        </div>
    </div>
    @endcan

</div>
