<?php

use App\Questions;
use App\Quotes;

function questionSelect()
{
    $qu = Questions::where('account_id', Auth::user()->account_id)->get();
    $questions[0] = 'Next';
    foreach ($qu as $q) {
        $questions[$q->id] = 'Go To: ' . $q->id . ' - ' . $q->question;
    }
    $questions[1000] = 'Information Collection';
    $questions[1001] = 'End Quote';
    return $questions;
}

function generateInquiryNumber()
{
    $inquiryNumber = 0;
    do {
        $inquiryNumber = rand(100000, 999999);
    } while (Quotes::where('inquiry_no',$inquiryNumber)->exists());
    return $inquiryNumber;
}


function yourinformation()
{
    $output = '<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="name"> </label>
                        <input type="text" class="form-control required form-contact" id="InformationFirst" placeholder="First Name*" name="first" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="last-name"> </label>
                        <input type="text" class="form-control required form-contact" id="InformationLast" placeholder="Last Name*" name="last" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="email"> </label>
                        <input type="email" class="form-control required form-contact" id="InformationEmail" placeholder="Email Address*" name="email" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="phone"> </label>
                        <input type="text" class="form-control required form-contact" id="InformationPhoneNumber" placeholder="Phone Number*" name="phone" required>
                    </div>
                </div>
            </div>
            <div class="row">                  
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" for="InformationAddress1"></label>
                        <input type="text" class="form-control required form-contact" id="InformationAddress1" placeholder="Start Typing To Populate Your Address*" name="address1" autocomplete="off" required>
                    </div>
                </div>                                            
            </div>
            <div class="row">                  
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" for="InformationAddress2"></label>
                        <input type="text" class="form-control form-contact" id="InformationAddress2" placeholder="Address Line 2" name="address2">
                    </div>
                </div>  
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" for="InformationAddress3"></label>
                        <input type="text" class="form-control required form-contact" id="InformationAddress3" placeholder="Town*" name="address3" required>
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" for="AddressTown"></label>
                        <input type="text" class="form-control required form-contact" id="AddressTown" placeholder="City" name="town" required>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" for="InformationPostcode"></label>
                        <input type="text" class="form-control required form-contact" id="InformationPostcode" placeholder="Postcode*" name="postcode" required>
                    </div>
                </div> 
            </div>';
    // $output = '<div id="InformationError" class="alert alert-danger hide col"></div>
    //             <div class="w-100"></div>
    //             <div class="col">
    //                 <div class="row">
    //                     <div class="col">
    //                         <div class="form-group">
    //                             First Name <span class="required">*</span>
    //                             '.Form::text('first','',['class' => 'form-control', 'placeholder' => 'First Name*', 'id' => 'InformationFirst']).'
    //                         </div>
    //                     </div>
    //                     <div class="col">
    //                         <div class="form-group">
    //                             Last Name <span class="required">*</span>
    //                             '.Form::text('last','',['class' => 'form-control', 'placeholder' => 'Last Name*', 'id' => 'InformationLast']).'
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>
    //             <div class="col">
    //                 <div class="form-group">
    //                     Email Address <span class="required">*</span>
    //                     '.Form::text('email','',['class' => 'form-control', 'placeholder' => 'Email Address*', 'id' => 'InformationEmail']).'
    //                 </div>
    //             </div>
    //             <div class="w-100"></div>
    //             <div class="col">
    //                 <div class="form-group">
    //                     Address <span class="required">*</span>
    //                     '.Form::text('address1','',['class' => 'form-control', 'placeholder' => 'Start Typing To Populate Your Address*', 'id' => 'InformationAddress1', 'autocomplete'=>'off'])
    //                     .Form::text('address2','',['class' => 'form-control', 'placeholder' => 'Address Line 2', 'id' => 'InformationAddress2'])
    //                     .Form::text('address3','',['class' => 'form-control', 'placeholder' => 'Town', 'id' => 'InformationAddress3'])
    //                     .Form::text('town','',['class' => 'form-control', 'placeholder' => 'City', 'id' => 'AddressTown']).'
    //                 </div>
    //                 <div class="form-group">
    //                     Postcode <span class="required">*</span>
    //                     '.Form::text('postcode','',['class' => 'form-control', 'placeholder' => 'Postcode*', 'id' => 'InformationPostcode']).'
    //                 </div>
    //             </div>
    //             <div class="col">
    //                 <div class="form-group">
    //                     Phone <span class="required">*</span>
    //                     '.Form::text('phone','',['class' => 'form-control', 'placeholder' => 'Phone Number*', 'id' => 'InformationPhoneNumber']).'
    //                 </div>
    //             </div>';
    return $output;
}

function getProductPercentagedValue($product)
{
    $productPrice = $product->price;
    $valuePercentage = $product->global_value_percentage && $product->global_value_percentage > 0 ?  $product->global_value_percentage : ($product->value_percentage && $product->value_percentage > 0 ? $product->value_percentage : false);
    $valueType = $product->global_value_percentage && $product->global_value_percentage > 0 ?  $product->global_value_type : ($product->value_percentage && $product->value_percentage > 0 ? $product->value_type : false);
    if ($valuePercentage) {
        if ($valueType == 'Increase') {
            $productPrice += (($product->price / 100) * $valuePercentage);
        } else {
            $productPrice -= (($product->price / 100) * $valuePercentage);
        }
    }
    return $productPrice;
}
