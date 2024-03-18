@php
    $name = $getName();
    $header = $getHeader();
    $content = $getContent();
    $image = $getImage();
@endphp
<div class="card">
    @if($image)
        <img
            src="{{ $image  }}"
            class="card-img-top"
            alt="{{ $name }}">
    @endif

    <div class="card-inner">
        <h5 class="card-title">Card with stretched link</h5>
        <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the card's
            content.
        </p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
