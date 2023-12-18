@include('user.header')

@if (session()->has('message'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">X</button>
    {{ session()->get('message') }}
</div>
@endif
<div class="alert alert-success" role="alert">
<span style="font-weight:bold;display:inline;" >Görüşmenin Tamamlanmasına Kalan Süre :  </span> <div style="font-weight:bold;display:inline;" id="countdown" data-roomname="{{$roomname}}">2:00</div>
</div>

<div  id="metered-frame"></div>
<script src="https://cdn.metered.ca/sdk/frame/1.4.3/sdk-frame.min.js"></script>
<script>
    var frame = new MeteredFrame(); 
    frame.init({
        roomURL: "birliktegelisim.metered.live/{{$roomname}}",
    }, document.getElementById("metered-frame"));
</script>
