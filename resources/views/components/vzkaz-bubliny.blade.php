@php
    $barva = $barvy[array_rand($barvy)];
@endphp

<div class="vzkaz-bublina" style="background-color: {{ $barva }};">
    <p class="vzkaz-text">"{{ $vzkaz->text }}"</p>
    <p class="vzkaz-jmeno">– {{ $vzkaz->jmeno }}</p>
</div>
