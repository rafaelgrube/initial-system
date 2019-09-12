@if(session()->has('message'))
  <alert prop-message="{{ session()->get('message') }}" prop-type="success"></alert>
@endif

@if($errors->count() > 0)
  @foreach($errors->all() as $error)
    <alert prop-message="{{ $error }}" prop-type="error"></alert>
  @endforeach
@endif

<alert v-on:my-alert="show(message)"></alert>