<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
    <div class="member">
        <div class="member-img">
        <img src="{{ asset('assets/img/team/'.$photo_name)}}" class="img-fluid" alt="team-member-photo">
            <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
        <div class="member-info">
            <h4>{{ $employee->first_name ." ". $employee->last_name }}</h4>
            <span></span>
        </div>
    </div>
</div>
