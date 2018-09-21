@if (session('success'))
    <div class="row">
        <div class="alert alert-success">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        </div>
    </div>
@elseif(session('error'))
    <div class="row">
        <div class="alert alert-danger">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        </div>
    </div>
@endif
