<div class="row">
    <div class="col">
        <div class="form-group">
            <h5>Product Name</h5>
            {!!Form::text('name',$productname,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <h5>Price</h5>
            {!!Form::number('price',$price,['class' => 'form-control', 'id' => 'total-price', 'required' => 'required', 'readonly'])!!}
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <div class="form-group">
            <h5>Materials</h5>
            {!!Form::number('materials',$materials,['class' => 'form-control', 'required' => 'required', 'min' => 1])!!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <h5>Labour</h5>
            {!!Form::number('labour',$labour,['class' => 'form-control', 'required' => 'required', 'min' => 1])!!}
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <div class="form-group">
            <h5>Price Percentage</h5>
            {!!Form::number('value_percentage',$valuepercentage,['class' => 'form-control', 'min' => 0, 'max' => 100])!!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <h5>Percentage Type</h5>
            {!!Form::select('value_type',['Increase'=>'Increase','Decrease'=>'Decrease'],$valuetype,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <div class="form-group">
            <h5>Short Description</h5>
            {!!Form::textarea('shortdescription',$productshortdescription,['class' => 'form-control', 'rows' => 3])!!}
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <div class="form-group">
            <h5>Description</h5>
            {!!Form::textarea('description',$productdescription,['class' => 'form-control', 'rows' => 3])!!}
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <div class="form-group">
            <h5>Image</h5>
            {!!Form::file('image',['class' => 'form-control', 'accept' => 'image/*'])!!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <h5>PDF</h5>
            {!!Form::file('pdf',['class' => 'form-control', 'accept' => 'application/pdf'])!!}
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <div class="form-group">
            <h5>Lower KW Bracket</h5>
            {!!Form::text('lower',$lower,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <h5>Upper KW Bracket</h5>
            {!!Form::text('upper',$upper,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col liter-option @if($iscombi != 5) hide @endif">
        <div class="form-group">
            <h5>Water Cylinder Litre</h5>
            {!!Form::select('liter',['125'=>'125 Litre','170'=>'170 Litre' ,'200'=>'200 Litre','250'=>'250 Litre'],$liter,['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="col liter-option @if($iscombi != 5) hide @endif">
    </div>
    <div class="w-100"></div>
    <div class="col">
        <h5>Product Type</h5>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <label class="form-group">
            @php
                $combichecked = false;
                if($iscombi == 1){
                    $combichecked = true;
                }
            @endphp
            Combi Boiler
            {!!Form::radio('combi',1, $combichecked)!!}
        </label>
    </div>
    <div class="col">
        <label class="form-group">
            @php
                $combichecked = false;
                if($iscombi == 2){
                    $combichecked = true;
                }
            @endphp
            Combi Storage
            {!!Form::radio('combi',2, $combichecked)!!}
        </label>
    </div>
    <div class="col">
        <label class="form-group">
            @php
                $combichecked = false;
                if($iscombi == 3){
                    $combichecked = true;
                }
            @endphp
            Open Vent Boiler
            {!!Form::radio('combi',3, $combichecked)!!}
        </label>
    </div>
    <div class="col">
        <label class="form-group">
            @php
                $combichecked = false;
                if($iscombi == 4){
                    $combichecked = true;
                }
            @endphp
            System Boiler
            {!!Form::radio('combi',4, $combichecked)!!}
        </label>
    </div>
    <div class="col">
        <label class="form-group">
            @php
                $combichecked = false;
                if($iscombi == 5){
                    $combichecked = true;
                }
            @endphp
            Water Cylinder
            {!!Form::radio('combi',5, $combichecked, ['class' => 'water-radio'])!!}
        </label>
    </div>
    <div class="col">
        <label class="form-group">
            @php
                $combichecked = false;
                if($iscombi == 6){
                    $combichecked = true;
                }
            @endphp
            Boost a main
            {!!Form::radio('combi',6, $combichecked)!!}
        </label>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <h5>Boiler Range</h5>
    </div>
    <div class="w-100"></div>
    {!!Form::hidden('range',0)!!}
    <div class="col">
        <label class="form-group">
            @php
                $rangechecked = false;
                if($isrange == 1){
                    $rangechecked = true;
                }
            @endphp
            100
            {!!Form::radio('range',1, $rangechecked)!!}
        </label>
    </div>
    <div class="col">
        <label class="form-group">
            @php
                $rangechecked = false;
                if($isrange == 2){
                    $rangechecked = true;
                }
            @endphp
            200
            {!!Form::radio('range',2, $rangechecked)!!}
        </label>
    </div>
</div>
