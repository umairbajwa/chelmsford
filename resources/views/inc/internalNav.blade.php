@if (checkPermissions('estimates', 1))
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Estimates</h5>
                <a href="{{ url('estimates') }}" class="card-link">View</a>
            </div>
        </div>
    </div>
@endif

@if (checkPermissions('products', 1))
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Products</h5>
                <a href="{{ url('products') }}" class="card-link">View</a>
            </div>
        </div>
    </div>
@endif

@if (checkPermissions('questions', 1))
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Questions</h5>
                <a href="{{ url('questions') }}" class="card-link">View</a>
            </div>
        </div>
    </div>
@endif

@if (checkPermissions('postcodes', 1))
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Postcodes</h5>
                <a href="{{ url('postcodes') }}" class="card-link">View</a>
            </div>
        </div>
    </div>
@endif

@if (checkPermissions('users', 1) || checkPermissions('permissions', 1))
    <div class="col">
        <div class="card">
            <div class="card-body">
                @if (!checkPermissions('users', 1) && checkPermissions('permissions', 1))
                    <h5 class="card-title">Roles</h5>
                    <a href="{{ url('roles') }}" class="card-link">View</a>
                @else
                    <h5 class="card-title">Users</h5>
                    <a href="{{ url('users') }}" class="card-link">View</a>
                @endif
            </div>
        </div>
    </div>
@endif

@if (checkPermissions('coverages', 1))
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Coverages</h5>
                <a href="{{ url('coverages') }}" class="card-link">View</a>
            </div>
        </div>
    </div>
@endif

<div class="w-100 my-3"></div>
