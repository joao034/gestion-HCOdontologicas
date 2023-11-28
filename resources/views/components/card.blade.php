<div {{ $attributes->merge(['class' => 'card']) }}>
    <div class="card-body">
      <h5 class="card-title"> <strong> {{$title}} </strong> </h5>
      <p class="card-text">{!! $content !!}</p>
    </div>
  </div>