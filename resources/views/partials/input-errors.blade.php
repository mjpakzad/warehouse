@if($errors->any())
    <div class="alert alert-danger alert-with-border alert-dismissable" role="alert">
        <h4 class="alert-heading">{{ __('Error') }}</h4>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
