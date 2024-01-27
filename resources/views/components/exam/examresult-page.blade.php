<div class="container">
    <div class="row">
        <h2> {{ $exam_name->Exam_name }} </h2>
        <h4>Result : {{ $result }}</h4>
    </div>

    <div class="row">
        <a href="{{ url('/exam-list') }}"><h3>Exam Page</h3></a>
    </div>
</div>