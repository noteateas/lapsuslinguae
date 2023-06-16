<div class="progress-container">
    @php
        //dd($challenges_quantity, $current_challenge);
        $step = 100 / $challenges_quantity;
        $current_percentage = $step * ($current_challenge - 1);
        //dd($current_percentage);
    @endphp
    <div class="x-sign" id="exit-task">
        <a href="{{ route('exit-task') }}">
            <span></span>
            <span></span>
        </a>
    </div>
    <div class="progress">
        <div class="progress-bar bg-warning" aria-valuenow="{{ $current_challenge }}" aria-valuemin="0" aria-valuemax="{{ $challenges_quantity }}" role="progressbar" style="width: {{$current_percentage}}%"></div>
    </div>
</div>
