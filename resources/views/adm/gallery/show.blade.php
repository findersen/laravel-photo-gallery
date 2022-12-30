<br>
<div class="col-12">
    @if( ! empty($photos))
        <div class="row" style="display: flex; flex-wrap: wrap;">
        @foreach($photos as $photo)
            <div class="col-sm-6 col-md-4 col-lg-3" style="padding-bottom: 20px">
                <img src="{{ asset('storage/'. $photo->filename) }}" style="width: 100%; height: 100%; object-fit: cover;" />
            </div>
        @endforeach
        </div>
    @endif
</div>