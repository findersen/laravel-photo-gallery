<div class="col-12">

    <form action="{{ route(config('admin.route.prefix') . '.admin.gallery.store') }}" method="post"
          enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="Product Name">Gallery Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter the Gallery Title">
        </div>

        <div class="form-group">
            <label for="Product Name">Gallery Description</label>
            <textarea name="description" class="form-control" placeholder="Enter the Gallery Description"></textarea>
        </div>

        <div class="form-group">
            <label for="Product Name">Gallery photos (can attach more than one):</label>
            <input type="file" class="form-control" name="photos[]" multiple/>
        </div>

        <input type="submit" class="btn btn-primary" value="Upload"/>

    </form>

</div>