<div class="row">
    <div class="col">
        <div class="form-group">
            Question
            {!!Form::text('question',$questiontext,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <div class="form-group">
            Sales Text
            {!!Form::text('sales',$salestext,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            Sales Image
            {!!Form::file('image',['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <h5>Options</h5>
    </div>
    <div class="w-100"></div>
</div>
<div id="question-options">
    @for($x=0; $x < $optioncount; $x++)
        @include('questions.formoption')
    @endfor
</div>
<div class="w-100"></div>
<div class="row">
    <div class="new-option col">
        <div id="addNewOption" class="btn btn-secondary" data-count="{!!$optioncount!!}">+ New Option</div>
    </div>
</div>