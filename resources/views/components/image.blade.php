<div>
@props(['name','class'=>''])
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
    <img src="{{asset('storage/files/'.$name)}}" class="{{$class}}">
</div>