@php
    $Cart=Session::get('Cart')
@endphp

@if (isset($Cart)||$Cart !=null)
<span class="icon_bag_alt"></span>
<div class="tip">{{$Cart->sum()}}</div>

@else
<span class="icon_bag_alt"></span>
<div class="tip">0</div>
@endif

