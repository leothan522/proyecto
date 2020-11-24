@extends("layouts.android.master")


@section('content')

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('adminlte/dist/img/prod-1.jpg') }}" class="img-thumbnail" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('adminlte/dist/img/prod-2.jpg') }}" class="img-thumbnail" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('adminlte/dist/img/prod-3.jpg') }}" class="img-thumbnail" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="col-12 product-image-thumbs">
        <div class="product-image-thumb active"><img src="{{ asset('adminlte/dist/img/prod-1.jpg') }}" alt="Product Image"></div>
        <div class="product-image-thumb"><img src="{{ asset('adminlte/dist/img/prod-2.jpg') }}" alt="Product Image"></div>
        <div class="product-image-thumb"><img src="{{ asset('adminlte/dist/img/prod-3.jpg') }}" alt="Product Image"></div>
        <!-- <div class="product-image-thumb"><img src="adminlte/img/prod-4.jpg" alt="Product Image"></div>
         <div class="product-image-thumb"><img src="adminlte/img/prod-5.jpg" alt="Product Image"></div>-->
    </div>

    <br>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
              10
              <small>%</small>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="card-body">
        <p>Add the classes <code>.btn.btn-app</code> to an <code>&lt;a&gt;</code> tag to achieve the following:</p>
        <a class="btn btn-app">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a class="btn btn-app">
            <i class="fas fa-play"></i> Play
        </a>
        <a class="btn btn-app">
            <i class="fas fa-pause"></i> Pause
        </a>
        <a class="btn btn-app">
            <i class="fas fa-save"></i> Save
        </a>
        <a class="btn btn-app">
            <span class="badge bg-warning">3</span>
            <i class="fas fa-bullhorn"></i> Notifications
        </a>
        <a class="btn btn-app">
            <span class="badge bg-success">300</span>
            <i class="fas fa-barcode"></i> Products
        </a>
        <a class="btn btn-app">
            <span class="badge bg-purple">891</span>
            <i class="fas fa-users"></i> Users
        </a>
        <a class="btn btn-app">
            <span class="badge bg-teal">67</span>
            <i class="fas fa-inbox"></i> Orders
        </a>
        <a class="btn btn-app">
            <span class="badge bg-info">12</span>
            <i class="fas fa-envelope"></i> Inbox
        </a>
        <a class="btn btn-app">
            <span class="badge bg-danger">531</span>
            <i class="fas fa-heart"></i> Likes
        </a>
    </div>

@endsection
