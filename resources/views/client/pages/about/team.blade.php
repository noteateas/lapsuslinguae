<div id="team" class="team section-bg pt-5 pb-5">

        <div class="section-title">
            @if(session()->has('user'))
                @if(session()->get('user')->language_id == 1)
                    <h3>Our Team</h3>
                    <p>Some of the people responsible for our work.</p>
                @elseif(session()->get('user')->language_id == 2)
                    <h3>Naš tim</h3>
                    <p>Par ljudi zaslužni za naš rad.</p>
                @endif
            @else
                <h3>Our Team</h3>
                <p>Some of the people responsible for our work.</p>
            @endif
        </div>
        <div class="row pb-5">
            @foreach($team as $key => $employee)
                @php $key = $key + 1; @endphp
                @include('client.components.about.teammember',
                    ['employee' => $employee,
                     'photo_name' => 'team-'.$key.'.jpg'
                     ])
            @endforeach

    </div>
</div>
