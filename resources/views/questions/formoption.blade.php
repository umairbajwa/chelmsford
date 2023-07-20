@php
$textoption = '';
$selectoption = '';
$priceoption = 0;
$priceoptionSelect = 2;
$fieldTypeSelect = 1;
$estimatelabel = '';
$optionIcon = '';

if(isset($option[$x]['text'])){
    $textoption = $option[$x]['text'];
}

if(isset($option[$x]['goto'])){
    $selectoption = $option[$x]['goto'];
}

if(isset($option[$x]['price'])){
    $priceoption = $option[$x]['price'];
}
if(isset($option[$x]['price-option'])){
    $priceoptionSelect = $option[$x]['price-option'];
}

if(isset($option[$x]['field-type'])){
    $fieldTypeSelect = $option[$x]['field-type'];
}

if(isset($option[$x]['estimate-label'])){
    $estimatelabel = $option[$x]['estimate-label'];
}

if(isset($option[$x]['icon'])){
    $optionIcon = $option[$x]['icon'];
}

$goto = questionSelect();

@endphp
<div id="row-{!!$x!!}" class="row option-wrap m-0 mb-2">
    <div class="col">
        <div class="form-group">
            Option Label
            {!!Form::text('option['.$x.'][text]',$textoption,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            @if(isset($option[$x]['image']))
                {!!Form::hidden('option['.$x.'][image]',$option[$x]['image'])!!}
            @endif
            Option Image
            {!!Form::file('option['.$x.'][image]',['class' => 'form-control'])!!}
        </div>
    </div>
    
    <div class="col">
        <div class="form-group">
            Field Type
            {!!Form::select('option['.$x.'][field-type]',[1=>'Single Select Option',2=>'Text Input',3=>'Quantity Input Multiple', 4=> 'Quantity Input Single'],$fieldTypeSelect,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <div class="form-group">
            Add Value
            {!!Form::text('option['.$x.'][price]',$priceoption,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            Value Meta
            {!!Form::select('option['.$x.'][price-option]',[1=>'Price Increase',2=>'KW Increase',3=>'KW % Increase',4=>'KW % Decrease',0=>'None'],$priceoptionSelect,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            Estimate Screen Label
            {!!Form::text('option['.$x.'][estimate-label]',$estimatelabel,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            Go To {!!Form::select('option['.$x.'][goto]',$goto,$selectoption,['class' => 'form-control'])!!}
        </div>
    </div>

    @if($x >= 1)
        <div class="option-cross">
            <div class="btn btn-secondary removeoption-button" data-row="{!!$x!!}">X</div>
        </div>
    @endif
</div>
<div class="w-100"></div>
