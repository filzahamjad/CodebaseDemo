@if(isset($data))

<div class="card-body">
    <p>Dynamic Wallet Address:</p>
    <p>{{$data['dynamicAddress']}}</p>
</div>
<div class="card-body">
    <p>Bitcoin Amount:</p>
    <p>{{$data['bitcoinAmount']}} {{$data['bitcoinCurrency']}}</p>
</div>
<div class="card-body">
    <p>Amount Entered By The User:</p>
    <p>{{$data['localAmount']}} {{$data['localCurrency']}}</p>
</div>
<img src={{$data['imgSrc']}} >
@endif
