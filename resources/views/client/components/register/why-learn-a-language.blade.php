<div>

    <label for="{{ $reason->id_name }}">
        <div data-aos="zoom-in" class="pointer" data-aos-delay="300">
            <div class="icon-box iconbox-teal">
                {!! $svg_container !!}
                <p>{{ $reason->title }}</p>
            </div>
        </div>
    </label>
</div>
<input type="radio" form="register-form" id="{{ $reason->id_name }}" name="why-learn-a-language" value="{{ $reason->id }}" class="d-none">
