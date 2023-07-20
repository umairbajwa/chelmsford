<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quotes;
use App\Account;
use App\FormSession;
use App\Questions;
use App\Products;

use App\Mail\NewEstimate;
use App\Mail\BookAppointment;
use App\Mail\FormSessionMail;
use App\Mail\newAppointment;
use App\Mail\PostCodeEmail;
use App\PostCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class QuotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['getQuote', 'submitQuote', 'display', 'SubmitBook', 'saveFormSession', 'verifyPostCode']);
    }

    public function index()
    {
        $estimates0 = Quotes::where([['followed_up', '=', 0]])->orderBy('id', 'DESC')->get();
        $estimates1 = Quotes::where([['followed_up', '=', 1]])->orderBy('id', 'DESC')->get();
        $estimates2 = Quotes::where([['followed_up', '=', 2]])->orderBy('id', 'DESC')->get();
        $estimates3 = Quotes::where([['followed_up', '=', 3]])->orderBy('id', 'DESC')->get();
        $estimates4 = Quotes::where([['followed_up', '=', 4]])->orderBy('id', 'DESC')->get();
        return view('estimates.index')->with('estimates0', $estimates0)->with('estimates1', $estimates1)->with('estimates2', $estimates2)->with('estimates3', $estimates3)->with('estimates4', $estimates4);
    }

    public function getQuote(Request $request, $stage = 0)
    {
        if ($request->sessionId) {
            session(['sessionId' => $request->sessionId]);
        } else {
            session(['sessionId' => Str::random(50)]);
        }
        if ($session = FormSession::where('session_id', session('sessionId'))->first()) {
            if ($session->form_data) {
                $session = (array) json_decode($session->form_data);
                $session['option'] = (array) $session['option'];
                $session['optiondata'] = (array) $session['optiondata'];
                foreach ($session['optiondata'] as $key => $value) {
                    if (is_object($value)) {
                        $session['optiondata'][$key] = (array) $value;
                    }
                }
            }
        }
        $sessionEmail = $session ? $session['email'] : '';
        $questions = Questions::orderBy('order', 'ASC')->orderBy('id', 'ASC')->get();
        // foreach ($questions as $key => $q) {
        //     $options = unserialize($q->options);
        //     if($q->id == 6){
        //         // unset($options[0]);
        //         $options = array_values($options);
        //         // dd($options);
        //         foreach ($options as $optionKey => $option) {
        //             if(isset($options[$optionKey]['zoom-image'])){
        //                 // $options[$optionKey]['image'] = str_replace(' ','-', strtolower($options[$optionKey]['text']));
        //                 $options[$optionKey]['zoom-image'] = NULL;
        //             }
        //         }
        //         $q->options = serialize($options);
        //         $q->save();
        //         dd($options);
        //     }
        // }
        $progressBar = 0;
        $progressBarPrevious = 0;
        $hide0 = '';
        $hide1 = 'hide';
        $hide2 = 'hide';
        if ($stage != 0) {
            // $hide0 = 'hide';
        }
        $hide1000 = 'hide';
        if ($stage == 1000) {
            $hide1000 = '';
        }
        $hide1001 = 'hide';
        if ($stage == 1001) {
            $hide1001 = '';
        }
        if (isset($session['option'])) {
            $hide0 = 'hide';
            $hide1 = 'hide';
            $hide2 = '';
            $hide1001 = 'hide';
            $progressBar = (count($session['option']) * 6.25);
        }

        $questionsOutput = '
                            <section class="banner-zxm ' . $hide0 . '">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="banner-bg-img" style="
                                                            background-size: cover;
                                                            background-position:top center;">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="carousel-caption  ">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-md-12 inner-content-box-data">
                                                                            <h5 class="tittle-one"> Get your free instant estimate!</h5>

                                                                            <p class="disciption-p">To get an idea of how much it will cost, just answer a few quick questions.</p>
                                                                            <a href="javascript:void(0)" class="btn btn-primary start-button nextButton" data-goto="1002" data-parent="0">Start</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                </div>

                            </section>
                            <section class="log-in home-servey sorry-page fuel-type your-estimate ' . $hide1 . '">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6 mx-auto ">
                                            <div class="login-box" id="question-1002">
                                                <div class="thank-you-img hide">
                                                    <img src="' . url('new-assets/img/sorry-img.png') . '" alt="img">
                                                </div>
                                                <form action="' . url('save-form-session') . '" id="survey-postcode" method="POST">
                                                    ' . csrf_field() . '
                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="normal">
                                                                <h3 class="log-in-heading text-center">Please Enter Your Post Code</h3>
                                                                <p class="stardard-text"></p>
                                                            </div>
                                                            <div class="error-header hide">
                                                                <p class="stardard-text">We’re sorry, it seems we don’t cover your area. Please send us your email because we might still be able to help.</p>
                                                            </div>
                                                             ' . RecaptchaV3::field("register") . '
                                                            <div class="form-group m-b-25">
                                                                <label class="required" for="Post Code"> </label>
                                                                <input type="text" class="form-control required form-contact" required id="post-code" placeholder="Post Code" name="post_code">
                                                                <span class="text text-danger post-code-check-error-invalid d-none">Please enter a valid post code address</span>
                                                            </div>
                                                            <input type="text" class="d-none" name="address">
                                                            <div class="form-group m-b-25 post-code-email-row hide">
                                                                <label class="required" for="PostCodeEmail"> </label>
                                                                <input type="email" class="form-control required form-contact" id="PostCodeEmail" placeholder="Email Address" name="email">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-md-6-ctm">
                                                            <div class="submit-btn text-center">
                                                                <a href="' . url('/') . '" id="startOverButton" type="button" class="mr-5 hide btn-submit-form" >Start Over</a>
                                                                <input id="submit-form" class="btn-submit-form" type="submit" value="Start">
                                                                <button type="button" class="nextButton hide postcode-form-next-btn" data-goto="' . $questions[0]['id'] . '" ></button>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-md-6-ctm">
                                                            <div class="submit-btn text-center">
                                                                <h5 class="text-success my-2 hide">Thank you for submitting. Someone will get back to you shortly.</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="fuel-type ' . $hide2 . '">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex start-over-box">
                                                        <button type="button" class="btn-start nextButton  start-over" data-goto="1" data-progress_bar="0">Start Over</button>
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width:' . $progressBar . '%"></div>
                                                        </div>
                                                        <button type="button" class="btn-start btn-save opacity-0">Save and Exit</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">

                                                    <form method="POST" action="' . url('submitInformation') . '" id="estimate-form">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-8 mx-auto">
                                                                        ' . csrf_field() . '
                                                                        <div id="question-1000" class="question-row question-wrap text-center ' . $hide1000 . '">

                                                                            <h3 class="log-in-heading text-center">Your Information</h3>
                                                                            <div class="login-box ">
                                                                                ' . yourinformation() . '
                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-md-6-ctm">
                                                                                        <div class="submit-btn text-center">
                                                                                            <button id="submit-form" class="btn btn-submit-form btn-secondary backButton btn-sm" type="button"  data-goto="" data-parent="1000">Back</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-md-6-ctm">
                                                                                        <div class="submit-btn text-center">
                                                                                            <button id="submit-form" class="btn-submit-form btn-sm" type="submit">See my estimates</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mx-auto">
                                                                    <div id="question-1001" class="question-wrap question-row text-center ' . $hide1001 . '">
                                                                        <h2 class="">Sorry</h2>
                                                                        <div class="row text-center">
                                                                            <div class="col selling-point">
                                                                                <div class="alert alert-secondary">Sorry, we are unable to help with oil filled boilers at this time.</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="w-100"></div>
                                                                            <div class="col text-center">
                                                                                <div class="btn btn-gradient float-right nextButton start-over" data-goto="' . $questions[0]['id'] . '" data-parent="1001" data-progress_bar="0">Start Again!</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>';
        $progressBar = 0;
        foreach ($questions as $k => $q) {

            $progressBar += round(100 / count($questions), 2);
            $progressBarPrevious = $progressBar - (round(100 / count($questions), 2) * 2);
            $hideclass = 'hide';
            $opacity0 = 'opacity-0';
            $back = '';
            if ($k == 0) {
                $back = 'opacity-0';
            }
            if (isset($session['option'])) {

                if (count($session['option']) == $q->id) {
                    $hideclass = '';
                }
                if ($k < count($session['option'])) {
                    $opacity0 = '';
                }
            } else {
                if ($stage != 0) {
                    if ($stage == $q->id) {
                        $hideclass = '';
                    }
                }
            }
            $placeholder = '';
            if ($q->id == 16) {
                $placeholder = 'Enter Location';
            }
            $checked = '';
            $optionsOutput = '';
            $optionBreak = 0;
            $zoom = '';
            // if ($q->id == 18) {
            //     $opacity0 = '';
            // }
            foreach (unserialize($q->options) as $optionk => $o) {
                $checked = '';
                $inputValue = '';
                if (isset($session['option'][$q->id]) && $session['option'][$q->id] == $optionk) {
                    $checked = 'checked';
                }
                if (isset($session['option'][$q->id]) && isset($session['optiondata'][$q->id])) {
                    if (is_array($session['optiondata'][$q->id]) && isset($session['optiondata'][$q->id][$optionk])) {
                        $inputValue = $session['optiondata'][$q->id][$optionk];
                    } else {
                        $inputValue = $session['optiondata'][$q->id];
                    }
                }
                $optionBreak++;
                $image = '';
                $zoom = '';
                if (isset($o['image']) && file_exists('storage/options/' . $o['image'] . '.png')) {
                    if (isset($o['zoom-image']) && file_exists('storage/options/zoom-images/' . $o['zoom-image'])) {
                        $zoom = '<a class="zoom eye" data-toggle="modal" data-target="#imageModal-' . $q->id . '" data-image="' . url('/') . '/storage/options/zoom-images/' . $o['zoom-image'] . '"><i class="fas fa-eye text-white"></i></a>';
                    }
                    $image = '<img class="img-hover-none" src="' . url('/') . '/storage/options/' . $o['image'] . '-outline.png"/>';
                    $image .= '<img class="img-hover" src="' . url('/') . '/storage/options/' . $o['image'] . '.png"/>';
                } else if (isset($o['zoom-image']) && file_exists('storage/options/zoom-images/' . $o['zoom-image'])) {
                    if (isset($o['zoom-image']) && file_exists('storage/options/zoom-images/' . $o['zoom-image'])) {
                        $zoom = '<a class="zoom eye" data-toggle="modal" data-target="#imageModal-' . $q->id . '" data-image="' . url('/') . '/storage/options/zoom-images/' . $o['zoom-image'] . '"><i class="fas fa-eye text-white"></i></a>';
                    }
                    $image = '<img class="img-hover-none" src="' . url('/') . '/storage/options/zoom-images/' . $o['zoom-image'] . '"/>';
                    $image .= '<img class="img-hover" src="' . url('/') . '/storage/options/zoom-images/' . $o['zoom-image'] . '"/>';
                }
                $goto = $o['goto'];
                if ($goto == 0) {
                    $nextK = $k + 1;
                    if (!isset($questions[$nextK]['id'])) {
                        $goto = 1000;
                    } else {
                        $goto = $questions[$nextK]['id'];
                    }
                }
                $floorModal = '';
                $inputStep = '';
                $quantity = 'Qty';
                $distanceQuestion = '';
                if ($q->id == 13) {
                    $floorModal = '<div class="label-ctm-cal floor-modal"  data-question="' . $q->id . '"><i class="fas fa-calculator"></i></div>';
                    $inputStep = 'step="0.01"';
                    $quantity = 'Sq. M';
                }
                if ($q->id == 17 || $q->id == 18) {
                    $distanceQuestion = 'question-distance';
                }
                if ($q->id == 19) {
                    $quantity = 'M';
                }
                switch ($o['field-type']) {
                    case (1):
                        if ($q->id == 6) {
                            $optionsOutput .= '<div class="radio-ctm  ' . $distanceQuestion . '" data-question="' . $q->id . '">
                                                ' . $zoom . '
                                                <input type="checkbox" name="option[' . $q->id . ']" id="option-' . $q->id . '-' . $optionk . '" value="' . $optionk . '"  ' . $checked . '/>
                                                <label class="option-wrap" data-goto="' . $goto . '" for="option-' . $q->id . '-' . $optionk . '">
                                                    ' . $image . '
                                                    <div class="text-box">
                                                        <h2 class="text-input">' . $o['text'] . '</h2>
                                                    </div>
                                                </label>
                                            </div>';
                        } else {
                            $optionsOutput .= '<div class="radio-ctm nextButton ' . $distanceQuestion . '" data-goto="' . ($q->id + 1) . '"  data-parent="' . $q->id . '" data-progress_bar="' . $progressBar . '" data-name="' . $o['text'] . ' Rooms" data-question="' . $q->id . '">
                                                ' . $zoom . '
                                                <input type="radio" name="option[' . $q->id . ']" id="option-' . $q->id . '-' . $optionk . '" value="' . $optionk . '"  ' . $checked . '/>
                                                <label class="option-wrap" data-goto="' . $goto . '" for="option-' . $q->id . '-' . $optionk . '">
                                                    ' . $image . '
                                                    <div class="text-box">
                                                        <h2 class="text-input">' . $o['text'] . '</h2>
                                                    </div>
                                                </label>
                                            </div>';
                        }
                        break;
                    case (2):
                        //Free text input
                        $optionsOutput .= '<div class="radio-ctm  ' . $distanceQuestion . '" data-question="' . $q->id . '">
                                                ' . $floorModal . '
                                                ' . $zoom . '
                                                <input type="radio" name="option[' . $q->id . ']" id="option-' . $q->id . '-' . $optionk . '" value="' . $optionk . '"  ' . $checked . '/>
                                                <label class="option-wrap input-field-label textOption" data-goto="' . $goto . '" for="option-' . $q->id . '-' . $optionk . '">
                                                    ' . $image . '
                                                    <div class="text-box">
                                                        <h2 class="text-input">' . $o['text'] . '</h2>
                                                    </div>
                                                    <div class="radio-input">
                                                        <input type="text" class="form-control text-input" name="optiondata[' . $q->id . ']" data-radio="option-' . $q->id . '-' . $optionk . '" value="' . $inputValue . '" placeholder="' . $placeholder . '">
                                                    </div>
                                                </label>
                                            </div>';
                        break;
                    case (3):
                        //Quantity input, taking the clicked item and giving a counter for the quanity
                        $optionsOutput .= '<div class="radio-ctm ' . $distanceQuestion . '" data-question="' . $q->id . '">
                                                ' . $floorModal . '
                                                ' . $zoom . '
                                                <input type="checkbox" name="option[' . $q->id . '][' . $optionk . ']" id="option-' . $q->id . '-' . $optionk . '" value="' . $optionk . '"  ' . $checked . '/>
                                                <label class="option-wrap input-field-label quantityOption" data-goto="' . $goto . '" for="option-' . $q->id . '-' . $optionk . '">
                                                    ' . $image . '
                                                    <div class="text-box">
                                                        <h2 class="text-input">' . $o['text'] . '</h2>
                                                    </div>
                                                    <div class="radio-input">
                                                        <div class="qtv">' . $quantity . '
                                                        </div>
                                                        <button class="qty-add btn" type="button"><i class="fa fa-plus"></i></buttton>
                                                        <button class="qty-subtract btn" type="button"><i class="fa fa-minus"></i></button>
                                                        <input type="number" ' . $inputStep . ' name="optiondata[' . $q->id . '][' . $optionk . ']" data-radio="option-' . $q->id . '-' . $optionk . '" min="0" value="0" class="form-control quantity-input" value="' . $inputValue . '">
                                                    </div>
                                                </label>
                                            </div>';
                        break;
                    case (4):
                        //Quantity input, taking the clicked item and giving a counter for the quanity

                        $optionsOutput .= '<div class="radio-ctm ' . $distanceQuestion . '" data-question="' . $q->id . '">
                                                 ' . $floorModal . '
                                                 ' . $zoom . '
                                                <input type="radio" name="option[' . $q->id . ']" id="option-' . $q->id . '-' . $optionk . '" value="' . $optionk . '"  ' . $checked . '/>
                                                <label class="option-wrap input-field-label quantityOption" data-goto="' . $goto . '" for="option-' . $q->id . '-' . $optionk . '">
                                                    ' . $image . '
                                                    <div class="text-box">
                                                        <h2 class="text-input">' . $o['text'] . '</h2>
                                                    </div>
                                                    <div class="radio-input">
                                                        <div class="qtv">
                                                            ' . $quantity . ':
                                                        </div>
                                                        <button class="qty-add btn" type="button"><i class="fa fa-plus"></i></buttton>
                                                        <button class="qty-subtract btn" type="button"><i class="fa fa-minus"></i></button>
                                                        <input type="number" ' . $inputStep . '  name="optiondata[' . $q->id . '][' . $optionk . ']" data-radio="option-' . $q->id . '-' . $optionk . '" min="0" value="0" class="form-control quantity-input" value="' . $inputValue . '">
                                                    </div>
                                                </label>
                                            </div>';
                        break;
                }

                // if($optionBreak == 5){
                //     $optionsOutput.= '<div class="w-100"></div>';
                //     $optionBreak = 0;
                // }

            }
            $moreIcon = '';
            if (count(unserialize($q->options)) > 1) {
                $moreIcon = '<div class="scroll-bottom"><i class="fas fa-chevron-down"></i></div>';
            }
            $selling = '';
            if ($q->selling_point !== null || !empty($q->selling_point)) {
                $selling = $q->selling_point;
            }
            $salesTax = '';
            if ($q->image && file_exists('storage/options/sales-images/' . $q->image)) {
                $salesTax = '<a class="zoom eye" data-toggle="modal" data-target="#imageModal-' . $q->id . '" data-image="' . url('/') . '/storage/options/sales-images/' . $q->image . '"><i class="fas fa-eye text-white"></i></a>';
            }


            $imageModal = '<div class="modal fade" id="imageModal-' . $q->id . '" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div id="image-output" class="modal-body"><img src="" class="img-fluid" ></div>
                                </div>
                            </div>
                        </div>';
            $questionsOutput .= '<div class="col-md-12 question-row ' . $hideclass . '"  id="question-' . $q->id . '" >
                                    ' . $moreIcon . '
                                    <div class="row mx-auto">
                                        <div class="col-md-12 mb-4">  ' . $imageModal . '
                                            <h2 class="heading-prime" data-question="' . $q->question . '">' . $q->question . '</h2>
                                        </div>
                                        <div class="col-md-12 mx-auto">
                                            <div class="inputs-design">
                                                ' . $optionsOutput . '
                                            </div>
                                        </div>
                                        <div class="col-md-8 mx-auto">
                                            <div class="d-flex  arrow-w">
                                                <a href="javascript:void(0)" class="arrow-l backButton ' . $back . '" data-goto="' . ($q->id - 1) . '" data-parent="' . $q->id . '" data-progress_bar="' . $progressBarPrevious . '">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.453" height="10.302" viewBox="0 0 15.453 10.302">
                                                        <path id="Icon_material-keyboard-backspace" data-name="Icon material-keyboard-backspace" d="M19.953,13.293H7.788l3.073-3.082L9.651,9,4.5,14.151,9.651,19.3l1.21-1.21L7.788,15.01H19.953Z" transform="translate(-4.5 -9)" fill="#797979"/>
                                                        </svg>

                                                </a>
                                                <div class="notification-message">
                                                    <a class="message-img" href="#">
                                                        <img src="' . url('new-assets/img/notification-img.svg') . '" alt="img">
                                                    </a>
                                                    <div class="dest-para">
                                                        ' . $salesTax . '
                                                        <p class="para-text">' . $selling . '</p>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" class="arrow-r nextButton ' . $opacity0 . '" data-goto="' . ($q->id + 1) . '"  data-parent="' . $q->id . '" data-progress_bar="' . $progressBar . '">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.453" height="10.302" viewBox="0 0 15.453 10.302">
                                                        <path id="Icon_material-keyboard-backspace" data-name="Icon material-keyboard-backspace" d="M19.953,13.293H7.788l3.073-3.082L9.651,9,4.5,14.151,9.651,19.3l1.21-1.21L7.788,15.01H19.953Z" transform="translate(19.953 19.302) rotate(-180)" fill="#324dfb"/>
                                                    </svg>

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="line-draw">
                                </div>';
        }

        $questionsOutput .= '
                                </div>
                            </form>
                        </div>
                </section>';
        return view('estimates.getaquote')->with('questions', $questionsOutput)->with('sessionEmail', $sessionEmail);
    }

    public function submitQuote(Request $request)
    {
        $options = serialize($request->input('option'));
        $optiondata = serialize($request->input('optiondata'));
        $this->validate($request, [
            'first' => 'required',
            'last' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address1' => 'required',
            'town' => 'required',
            'postcode' => 'required'
        ]);

        $account = Account::where('url', $request->root())->first();
        $quotes = new Quotes;
        $quotes->account_id = $account->id;
        $quotes->first = $request->input('first');
        $quotes->last = $request->input('last');
        $quotes->email = $request->input('email');
        $quotes->phone_number = $request->input('phone');
        $quotes->address_line_1 = $request->input('address1');
        $quotes->address_line_2 = $request->input('address2');
        $quotes->address_line_3 = $request->input('address3');
        $quotes->town = $request->input('town');
        $quotes->postcode = $request->input('postcode');
        $quotes->quote_data  = $options;
        $quotes->quote_option_data  = $optiondata;
        $quotes->followed_up = 0;
        $quotes->won = 0;
        $quotes->inquiry_no = generateInquiryNumber();

        $calcOutput = $this->calculateQuote($options, $optiondata);
        if (isset($calcOutput[0])) {
            $quotes->quoted_products = $calcOutput[0];
        }
        if (isset($calcOutput[1])) {
            $quotes->quoted_price = $calcOutput[1];
        }
        if (isset($calcOutput[2])) {
            $quotes->quoted_calc_total = $calcOutput[2];
        }

        $quotes->displayboost = $calcOutput[3];
        $quotes->save();
        return redirect('/estimate/output/' . $quotes->id);
    }

    public function calculateQuote($options, $optiondata)
    {
        $options = unserialize($options);
        $optiondata = unserialize($optiondata);
        $questions = Questions::orderBy('order', 'ASC')->orderBy('id', 'ASC')->get();

        $questionsArray = [];

        //Put the questions in to a readable array.
        foreach ($questions as $q) {
            $questionsArray[$q->id]['question'] = $q->question;
            $questionsArray[$q->id]['options'] = unserialize($q->options);
        }
        //Price Meta - 1=>'Price Increase',2=>'KW Increase',3=>'KW % Increase',4=>'KW % Decrease'
        $priceIncrease = 0;
        $kwCountIncrease = 0;
        $kwPercentDecrease = 0;
        $kwPercentIncrease = 0;
        $kwTotal = 0;
        $watercylinder = 0;
        $bed = 0;
        $bath = 0;
        $waterCylinderResult = 0;
        //Selecting the option and doing the calucalations in the background on the chosen options/
        foreach ($options as $k => $o) {
            $currentOptionPrice = 0;
            //echo $k.' - '.$o.'<br>';
            if (is_array($options[$k])) {
                foreach ($options[$k] as $quantityO) {
                    $meta = $questionsArray[$k]['options'][$quantityO];
                    $priceoption = $meta['price-option'];

                    $price = $meta['price'];
                    if ($meta['field-type'] == 3 || $meta['field-type'] == 4) {
                        $price = $optiondata[$k][$quantityO] * $price;
                    }
                    switch ($priceoption) {
                        case 1:
                            $priceIncrease = $priceIncrease + $price;
                            $currentOptionPrice += $price;
                            break;
                        case 2:
                            $kwCountIncrease = $kwCountIncrease + $price;
                            break;
                        case 3:
                            $kwPercentIncrease = $kwPercentIncrease + $price;
                            break;
                        case 4:
                            $kwPercentDecrease = $kwPercentDecrease + $price;
                            break;
                    }
                }
            } else {
                // If anser to water cyclinder question does not equal no
                if ($k == 14) {
                    $waterCylinderResult = $o;
                }
                if ($k == 14 && $o == 2) {
                    $watercylinder = 1;
                }
                //Collect in a variable the answer to the number of bedrooms
                if ($k == 3) {
                    $bed = $o;
                }
                //Collect in a variable the answer to the number of bathrooms
                if ($k == 4) {
                    $bath = $o;
                    // if ($o == 3) {
                    //     $priceIncrease = $priceIncrease + 2500;
                    // }
                }

                if ($k == 11 && $o != 0) {
                    $ufh = 1;
                }

                $meta = $questionsArray[$k]['options'][$o];
                $priceoption = $meta['price-option'];

                $price = $meta['price'];
                if ($meta['field-type'] == 3 || $meta['field-type'] == 4) {
                    $price = $optiondata[$k][$o] * $price;
                }
                switch ($priceoption) {
                    case 1:
                        $priceIncrease = $priceIncrease + $price;
                        $currentOptionPrice += $price;
                        break;
                    case 2:
                        $kwCountIncrease = $kwCountIncrease + $price;
                        break;
                    case 3:
                        $kwPercentIncrease = $kwPercentIncrease + $price;
                        break;
                    case 4:
                        $kwPercentDecrease = $kwPercentDecrease + $price;
                        break;
                }
            }
        }

        //KW Total
        $kwTotal = $kwTotal + $kwCountIncrease;
        //KW increase. Total / 100 * increase then added to the total.
        $kwPercentIncrease = ($kwTotal / 100) * $kwPercentIncrease;
        $kwTotal = $kwTotal + $kwPercentIncrease;
        //KW decrease. Total / 100 * decrease then taken away from the total.
        $kwPercentDecrease = ($kwTotal / 100) * $kwPercentDecrease;
        $kwTotal = $kwTotal - $kwPercentDecrease;
        //Find products that have a KW between the two KW brackets
        $products100 = [];
        $products200 = [];
        $products300 = [];
        $products400 = [];
        $products = [];
        $prod = [];
        $hotWaterCylinder = 0;
        if ($waterCylinderResult == 1 || $waterCylinderResult == 3) {
            if ($bath == 0) {
                $prod = $this->getProducts($kwTotal, 1, true);
                //Bath 1','Remove, No'
            }
            if ($bath == 1) {
                //Bath 2', 'Remove, No'
                $prod[] = $this->getProducts($kwTotal, 2, false)[0];
                $prod[] = $this->getProducts($kwTotal, 1, false)[0];
                $prod[] = $this->getProductsMultiple($kwTotal, 2, false);
                $prod[] = $this->getProductsMultiple($kwTotal, 1, false);
            }
            if ($bath == 2 || $bath == 3) {
                //Bath 3,4', 'Remove, No'
                $prod = $this->getProducts($kwTotal, 4, true);
            }
        } else if ($waterCylinderResult == 2) {
            //Any Bath', 'Replace'
            $prod = $this->getProducts($kwTotal, 4, true);
        } else if ($waterCylinderResult == 0) {
            //Any Bath', 'Keep'
            $prod[] = $this->getProducts($kwTotal, 4, false)[0];
            $prod[] = $this->getProducts($kwTotal, 3, false)[0];
            $prod[] = $this->getProductsMultiple($kwTotal, 4, false);
            $prod[] = $this->getProductsMultiple($kwTotal, 3, false);
        }

        if (count($prod) >= 2) {
            $products['default'] = $prod[0];
            $products['recommend'][] = $prod[1];
            if (isset($prod[2])) {
                $products['recommend'][] = $prod[2];
            }
            if (isset($prod[3])) {
                $products['recommend'][] = $prod[3];
            }
        } else $products['default'] = $prod[0];

        if ($watercylinder == 1) {
            //Get the water cylinder
            if ($bath == 0) {
                $hotWaterCylinder = 125;
            }
            if ($bath == 1) {
                $hotWaterCylinder = 170;
            }
            if ($bath == 2) {
                $hotWaterCylinder = 200;
            }
            if ($bath == 3) {
                $hotWaterCylinder = 250;
            }
            $productsCombi = Products::where([['iscombi', '=', 5]])->where('liter', $hotWaterCylinder)->limit(1)->OrderBy('price', 'DESC')->first();
            if (!empty($productsCombi)) {
                $products['water'] = $productsCombi;
            }
        }
        $displayBoost = 0;
        if ($bed >= 3) {
            //Get the boost a main
            $displayBoost = 1;
        }

        if (count($products) > 0) {
            $productOutput = '';
            $productsIDs = [];
            $productTotalPrice = [];
            $prods = [];
            // $productsIDs = $
            foreach ($products as $key => $p) {
                if ($key == 'recommend') {
                    foreach ($p as $pKey => $pValue) {
                        if ($pValue) {
                            $productsIDs[] = $pValue['id'];
                            $prods[$key][] = $pValue['id'];
                            $productTotalPrice[$key][] = $pValue['price'] + $priceIncrease;
                        }
                    }
                } else {
                    $productsIDs[] = $p['id'];
                    $prods[$key] = $p['id'];
                    if ($key != 'water') {
                        $productTotalPrice[$key] = $p['price'] + $priceIncrease;
                    } else $productTotalPrice[$key] = $p['price'];
                }
            }
            return [serialize(['types' => $prods, 'ids' => $productsIDs]), serialize($productTotalPrice), $kwTotal, $displayBoost];
        }
        return '';
    }

    private function getProducts($kwTotal, $combiType, $single = false)
    {
        $products = [];
        if ($single) {

            $products[] = Products::where([['lower_bracket', '<=', $kwTotal], ['upper_bracket', '>=', $kwTotal], ['range', '=', 1], ['iscombi', '=', $combiType]])->orderBy('upper_bracket', 'DESC')->first();
            $products[] = Products::where([['lower_bracket', '<=', $kwTotal], ['upper_bracket', '>=', $kwTotal], ['range', '=', 2], ['iscombi', '=', $combiType]])->orderBy('upper_bracket', 'DESC')->first();
        } else {
            $products = Products::where([['lower_bracket', '<=', $kwTotal], ['upper_bracket', '>=', $kwTotal], ['range', '=', 1], ['iscombi', '=', $combiType]])->orderBy('upper_bracket', 'DESC')->take(1)->get();
            if (count($products) == 0) {
                $products = Products::where([['lower_bracket', '<=', $kwTotal], ['upper_bracket', '>=', $kwTotal], ['range', '=', 2], ['iscombi', '=', $combiType]])->orderBy('upper_bracket', 'DESC')->take(1)->get();
            }
        }
        return $products;
    }
    private function getProductsMultiple($kwTotal, $combiType)
    {
        $products = [];

        $products = Products::where([['lower_bracket', '<=', $kwTotal], ['upper_bracket', '>=', $kwTotal], ['range', '=', 2], ['iscombi', '=', $combiType]])->orderBy('upper_bracket', 'DESC')->first();
        return $products;
    }

    public function display($quoteid, $admin = 0)
    {
        $quote = Quotes::where([['id', '=', $quoteid]])->first();

        if ($quote !== null) {
            $displayBoost = $quote->displayboost;
            $data = unserialize($quote->quote_data);
            $optiondata = unserialize($quote->quote_option_data);
            $products = unserialize($quote->quoted_products);
            $productTypes = $products['types'];
            $products = $products['ids'];
            $price = unserialize($quote->quoted_price);
            $finalDetails = unserialize($quote->final_details);
            $kw = $quote->quoted_calc_total;
            $questions = Questions::orderBy('order', 'ASC')->orderBy('id', 'ASC')->get();
            $questionsArray = [];
            //Put the questions in to a readable array.
            foreach ($questions as $q) {
                $questionsArray[$q->id]['options'] = unserialize($q->options);
            }
            $productOutput = '';
            $productModalOutput = '';
            $totalOutput = '';
            $subTotalRows = '';
            $subTotalRowsRadiators = '';
            $priceIncrease = 0;
            $boostamain = 0;
            $subtotalTotal = 0;
            $totalForBoiler = 0;
            $totalRadiatorValue = 0;
            foreach ($data as $k => $o) {
                if (is_array($data[$k])) {
                    foreach ($data[$k] as $quantityO) {

                        if (isset($questionsArray[$k]['options'][$quantityO])) {
                            $meta = $questionsArray[$k]['options'][$quantityO];
                            $pr = $meta['price'];
                            $extradata = '';
                            if ($meta['field-type'] == 3) {
                                $pr = $optiondata[$k][$quantityO] * $pr;
                                $extradata = ' x ' . $optiondata[$k][$quantityO];
                                if ($k == 19) {

                                    $extradata =  ' ' . $optiondata[$k][$quantityO] . ' m';
                                }
                                if ($k == 13) {
                                    $extradata = ' ' . $optiondata[$k][$quantityO] . ' Sq m';
                                }
                            }
                            if ($meta['field-type'] == 4) {
                                $pr = $optiondata[$k][$quantityO] * $pr;
                                $extradata = ' x ' . $optiondata[$k][$quantityO];
                            }
                            if ($meta['price-option'] == 1) {
                                $subtotalTotal += $pr;
                                $label = $meta['text'];
                                if (isset($meta['estimate-label']) && $meta['estimate-label'] !== null) {
                                    $label = $meta['estimate-label'];
                                }
                                if ($k == 1 || $k == 10 || $k == 15 || $k == 19 || $k == 16) {
                                    $totalForBoiler += $pr;
                                    if ($k == 10) {
                                        $subTotalRows .= '<p class="text-c ">' . $label . $extradata . '</p>';
                                    }
                                } else {
                                    if ($k == 6 || $k == 7 || $k == 8 || $k == 9 || $k == 20 || $k == 21) {
                                        $totalRadiatorValue += $pr;
                                        $subTotalRowsRadiators .= '<p class="text-c ">' . $label . $extradata . '</p>';
                                    } else {
                                        $subTotalRows .= '<p class="text-c ">' . $label . $extradata . '<span class="single-product-price">£' . number_format($pr, 2) . '</span></p>';
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if (isset($questionsArray[$k]['options'][$o])) {
                        $meta = $questionsArray[$k]['options'][$o];
                        $pr = $meta['price'];
                        $extradata = '';
                        if ($meta['field-type'] == 3) {
                            $pr = $optiondata[$k][$o] * $pr;
                            $extradata = ' x ' . $optiondata[$k][$o];
                            if ($k == 19) {
                                $extradata =  ' ' . $optiondata[$k][$o] . ' m';
                            }
                            if ($k == 13) {
                                $extradata = ' ' . $optiondata[$k][$o] . ' Sq m';
                            }
                        }
                        if ($meta['field-type'] == 4) {
                            $pr = $optiondata[$k][$o] * $pr;
                            $extradata = ' x ' . $optiondata[$k][$o];
                        }
                        if ($meta['price-option'] == 1) {
                            $label = $meta['text'];
                            $subtotalTotal += $pr;
                            if (isset($meta['estimate-label']) && $meta['estimate-label'] !== null) {
                                $label = $meta['estimate-label'];
                            }
                            if ($k == 1 || $k == 10 || $k == 15 || $k == 19 || $k == 16) {
                                $totalForBoiler += $pr;
                                if ($k == 10) {
                                    $subTotalRows .= '<p class="text-c ">' . $label . $extradata . '</p>';
                                }
                            } else {
                                if ($k == 14) {
                                    if ($o == 1) {
                                        $subTotalRows .= '<p class="text-c ">' . $label . $extradata .  '<span class="single-product-price">£' . number_format($pr, 2) . '</span></p>';
                                    }
                                } else {
                                    if ($k == 6 || $k == 7 || $k == 8 || $k == 9 || $k == 20 || $k == 21) {
                                        $totalRadiatorValue += $pr;
                                        $subTotalRowsRadiators .= '<p class="text-c ">' . $label . $extradata . '</p>';
                                    } else {
                                        $subTotalRows .= '<p class="text-c ">' . $label . $extradata . '<span class="single-product-price">£' . number_format($pr, 2) . '</span></p>';
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $subTotalRowsRadiatorsTotal = '<p class="text-c "> Total Radiators Amount<span class="single-product-price">£' . number_format($totalRadiatorValue, 2) . '</span></p>';
            $subTotalRows .= $subTotalRowsRadiators . $subTotalRowsRadiatorsTotal;
            //make this conditional.
            $optionals = '';
            $optionalModal = '';
            if ($finalDetails && $finalDetails['addons']) {
                $optionals = '<div class="col mb-1 "><h2>Optional Extras</h2></div><div class="w-100"></div>';
                foreach ($finalDetails['addons'] as $p) {
                    $p = Products::find($p);
                    $image = '<img src="' . url('/') . '/storage/products/' . $p->image . '"/>';
                    $optionals .= '<div class="col text-left optionalExtras quoted-product-wrap option-wrap p-3">
                                    <div class="row">
                                        <div class="col quoted-product-image">
                                            ' . $image . '
                                        </div>
                                        <div class="col">
                                            <h3>' . $p->product_name . '</h3>
                                            <div class="w-100"></div>
                                            <p style="font-size: 0.8rem">' . $p->shortdescription . '<p>
                                            <div class="w-100 my-2"></div>
                                            <div class="btn btn-secondary" data-toggle="modal" data-target="#optional-' . $p->id . '" style="font-size: 0.6em;">More Info</div>
                                            <div class="w-100 my-1"></div>
                                        </div>
                                    </div>
                                </div>';

                    $optionalModal .= '<div class="modal fade" id="optional-' . $p->id . '" tabindex="-1" role="dialog" aria-labelledby="optional-' . $p->id . 'Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body row m-0">
                                                    <h3>' . $p->product_name . '</h3>
                                                    <div class="w-100"></div>
                                                    <p>' . nl2br($p->product_description) . '<p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                }
                $optionals .= '<div class="w-100"></div>';
            } else {
                if ($displayBoost == 1) {
                    $productsBoost = Products::where('iscombi', 6)->OrderBy('id', 'ASC')->get();
                    $optionals = '<div class="col mb-1 "><h2>Optional Extras</h2></div><div class="w-100"></div>';
                    foreach ($productsBoost as $p) {
                        $selected = isset($finalDetails['addons']) && in_array($p->id, $finalDetails['addons']) ? 'true' : '';
                        $image = '<img src="' . url('/') . '/storage/products/' . $p->image . '"/>';
                        $optionals .= '<div class="col text-left optionalExtras quoted-product-wrap option-wrap p-3">
                                    <div class="row">
                                        <div class="col quoted-product-image">
                                            ' . $image . '
                                        </div>
                                        <div class="col">
                                            <h3>' . $p->product_name . '</h3>
                                            <div class="w-100"></div>
                                            <p style="font-size: 0.8rem">' . $p->shortdescription . '<p>
                                            <div class="w-100 my-2"></div>
                                            <div class="btn btn-secondary" data-toggle="modal" data-target="#optional-' . $p->id . '" style="font-size: 0.6em;">More Info</div>
                                            <div class="w-100 my-1"></div>
                                            ';
                        if ($admin && checkPermissions('estimates', 2)) {
                            $optionals .= '<label class="btn btn-primary" style="font-size: 0.8em">Add to your quote? <input type="checkbox" checked="' . $selected . '" class="product-' . $p->id . ' ml-2" name="subtotalcost" value="' . $p->price . '"></label>';
                        }
                        $optionals .= '</div>
                                    </div>
                                </div>';

                        $optionalModal .= '<div class="modal fade" id="optional-' . $p->id . '" tabindex="-1" role="dialog" aria-labelledby="optional-' . $p->id . 'Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body row m-0">
                                                    <h3>' . $p->product_name . '</h3>
                                                    <div class="w-100"></div>
                                                    <p>' . nl2br($p->product_description) . '<p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                    }
                    $optionals .= '<div class="w-100"></div>';
                }
            }
            //$subtotalTotal+= 2500;

            $boostamain = 1;
            $productsBoost = Products::where('iscombi', 6)->OrderBy('id', 'ASC')->get();
            foreach ($productTypes as $key => $value) {
                $productTypes[$key] = Products::find($value);
            }
            if ($admin == 0) {
                return view('estimates.output-new', compact('productTypes', 'productsBoost', 'displayBoost', 'subtotalTotal', 'subTotalRows', 'quote', 'kw', 'totalForBoiler'));
            }

            if ($finalDetails) {
                $p = Products::find($finalDetails['product_id']);
                if ($p) {
                    $image = '<img src="' . url('/') . '/storage/products/' . $p['image'] . '"/>';
                    if ($p['icon'] != null) {
                        $image = '<i class="fas fa-' . $p['icon'] . '"></i>';
                    }

                    $moreInfo = '';
                    $additionalClass = 'additional-product';
                    if ($p['iscombi'] != 5 && $p['iscombi'] != 6) {
                        //$boostamain = 1;
                        $additionalClass = '';
                        $outputPrice = $p->updated_price + $finalDetails['subtotal'];
                        $moreInfo = '<input type="hidden" class="originalprice" value="' . $outputPrice . '"><input type="hidden" id="withExtras" value="0">
                                <div class="btn btn-secondary float-right" data-toggle="modal" data-target="#extraModal" data-productID="' . $p['id'] . '" data-price="' . $p['price'] . '">More Info</div>
                                <div id="seefinanceButton" class="btn btn-link float-right" data-toggle="modal" data-target="#finance-extraModal" data-productID="' . $p['id'] . '" data-price="' . $p['price'] . '">See Finance Options</div>
                                <h3 class="outputprice">£' . $outputPrice . '<span class="incvat">inc vat</span></h3>
                                <div class="w-100 my-4"></div>';
                        if ($admin && checkPermissions('estimates', 2)) {
                            $moreInfo .= '<div class="btn btn-primary float-right mt-4 interestedButton" data-id="' . $p['id'] . '" data-name="' . $p['product_name'] . '"  data-toggle="modal" data-target="#bookModal">Interested? Book your home survey</div>';
                        }
                    } else if ($p['iscombi'] == 5) {
                        $moreInfo = '<div class="btn btn-secondary float-right" data-toggle="modal" data-target="#extraModal" data-productID="' . $p['id'] . '" data-price="' . $p['price'] . '">More Info</div>';
                    }

                    $productOutput .= '<div class="quoted-product-wrap my-1 col product-' . $p['id'] . ' ' . $additionalClass . ' border-bottom">
                                    <div class="row m-0">
                                        <div class="col quoted-product-image">
                                            ' . $image . '
                                        </div>
                                        <div class="col py-4">
                                            <h3>' . $p['product_name'] . '</h3>
                                            <p>' . substr(nl2br($p['shortdescription']), 0, 301) . '...</p>
                                            <div class="w-100 my-1"></div>

                                            <div class="w-100 my-2"></div>
                                            ' . $moreInfo . '
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100"></div>';

                    $productModalOutput .= '<div class="quoted-product-wrap text-left modal-product-wrap p-3 my-1 col product-' . $p['id'] . ' ' . $additionalClass . '">
                                            <div class="row m-0">
                                                <div class="col">
                                                    <h3>' . $p['product_name'] . '</h3>
                                                </div>
                                                <div class="w-100"></div>
                                                <div class="col">
                                                    <p>' . nl2br($p['product_description']) . '</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-100"></div>';
                }
                if (isset($finalDetails['water'])) {
                    $p = Products::find($finalDetails['water']);
                    if ($p) {
                        $image = '<img src="' . url('/') . '/storage/products/' . $p['image'] . '"/>';
                        if ($p['icon'] != null) {
                            $image = '<i class="fas fa-' . $p['icon'] . '"></i>';
                        }

                        $moreInfo = '';
                        $additionalClass = 'additional-product';
                        if ($p['iscombi'] != 5 && $p['iscombi'] != 6) {
                            //$boostamain = 1;
                            $additionalClass = '';
                            $outputPrice = $p['price'];
                            $moreInfo = '<input type="hidden" class="originalprice" value="' . $outputPrice . '"><input type="hidden" id="withExtras" value="0">
                                <div class="btn btn-secondary float-right" data-toggle="modal" data-target="#extraModal" data-productID="' . $p['id'] . '" data-price="' . $p['price'] . '">More Info</div>
                                <div id="seefinanceButton" class="btn btn-link float-right" data-toggle="modal" data-target="#finance-extraModal" data-productID="' . $p['id'] . '" data-price="' . $p['price'] . '">See Finance Options</div>
                                <h3 class="outputprice">£' . $outputPrice . '<span class="incvat">inc vat</span></h3>
                                <div class="w-100 my-4"></div>';
                            if ($admin && checkPermissions('estimates', 2)) {
                                $moreInfo .= '<div class="btn btn-primary float-right mt-4 interestedButton" data-id="' . $p['id'] . '" data-name="' . $p['product_name'] . '"  data-toggle="modal" data-target="#bookModal">Interested? Book your home survey</div>';
                            }
                        } else if ($p['iscombi'] == 5) {
                            $moreInfo = '<div class="btn btn-secondary float-right" data-toggle="modal" data-target="#extraModal" data-productID="' . $p['id'] . '" data-price="' . $p['price'] . '">More Info</div>';
                        }
                        $productOutput .= '<div class="quoted-product-wrap my-1 col product-' . $p['id'] . ' ' . $additionalClass . ' border-bottom">
                                    <div class="row m-0">
                                        <div class="col quoted-product-image">
                                            ' . $image . '
                                        </div>
                                        <div class="col py-4">
                                            <h3>' . $p['product_name'] . '</h3>
                                            <p>' . substr(nl2br($p['shortdescription']), 0, 301) . '...</p>
                                            <div class="w-100 my-1"></div>
                                            <div class="subtotal-wrap">
                                                <div class="row d-flex flex-column"><div class="col-md-12">' . $subTotalRows . '</div></div>
                                            </div>
                                            <div class="w-100 my-2"></div>
                                            ' . $moreInfo . '
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100"></div>';

                        $productModalOutput .= '<div class="quoted-product-wrap text-left modal-product-wrap p-3 my-1 col product-' . $p['id'] . ' ' . $additionalClass . '">
                                            <div class="row m-0">
                                                <div class="col">
                                                    <h3>' . $p['product_name'] . '</h3>
                                                </div>
                                                <div class="w-100"></div>
                                                <div class="col">
                                                    <p>' . nl2br($p['product_description']) . '</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-100"></div>';
                    }
                }
            } else {
                foreach ($products as $prod) {
                    $p = Products::find($prod);
                    if ($p) {
                        $image = '<img src="' . url('/') . '/storage/products/' . $p['image'] . '"/>';
                        if ($p['icon'] != null) {
                            $image = '<i class="fas fa-' . $p['icon'] . '"></i>';
                        }

                        $moreInfo = '';
                        $additionalClass = 'additional-product';
                        if ($p['iscombi'] != 5 && $p['iscombi'] != 6) {
                            //$boostamain = 1;
                            $additionalClass = '';
                            $outputPrice = $p['price'] + $subtotalTotal;
                            $moreInfo = '<input type="hidden" class="originalprice" value="' . $outputPrice . '"><input type="hidden" id="withExtras" value="0">
                                <div class="btn btn-secondary float-right" data-toggle="modal" data-target="#extraModal" data-productID="' . $p['id'] . '" data-price="' . $p['price'] . '">More Info</div>
                                <div id="seefinanceButton" class="btn btn-link float-right" data-toggle="modal" data-target="#finance-extraModal" data-productID="' . $p['id'] . '" data-price="' . $p['price'] . '">See Finance Options</div>
                                <h3 class="outputprice">£' . $outputPrice . '<span class="incvat">inc vat</span></h3>
                                <div class="w-100 my-4"></div>';
                            if ($admin && checkPermissions('estimates', 2)) {
                                $moreInfo .= '<div class="btn btn-primary float-right mt-4 interestedButton" data-id="' . $p['id'] . '" data-name="' . $p['product_name'] . '"  data-toggle="modal" data-target="#bookModal">Interested? Book your home survey</div>';
                            }
                        } else if ($p['iscombi'] == 5) {
                            $moreInfo = '<div class="btn btn-secondary float-right" data-toggle="modal" data-target="#extraModal" data-productID="' . $p['id'] . '" data-price="' . $p['price'] . '">More Info</div>';
                        }
                        $productOutput .= '<div class="quoted-product-wrap my-1 col product-' . $p['id'] . ' ' . $additionalClass . ' border-bottom">
                                    <div class="row m-0">
                                        <div class="col quoted-product-image">
                                            ' . $image . '
                                        </div>
                                        <div class="col py-4">
                                            <h3>' . $p['product_name'] . '</h3>
                                            <p>' . substr(nl2br($p['shortdescription']), 0, 301) . '...</p>
                                            <div class="w-100 my-1"></div>
                                            <div class="subtotal-wrap">
                                                <div class="row d-flex flex-column"><div class="col-md-12">' . $subTotalRows . '</div></div>
                                            </div>
                                            <div class="w-100 my-2"></div>
                                            ' . $moreInfo . '
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100"></div>';

                        $productModalOutput .= '<div class="quoted-product-wrap text-left modal-product-wrap p-3 my-1 col product-' . $p['id'] . ' ' . $additionalClass . '">
                                            <div class="row m-0">
                                                <div class="col">
                                                    <h3>' . $p['product_name'] . '</h3>
                                                </div>
                                                <div class="w-100"></div>
                                                <div class="col">
                                                    <p>' . nl2br($p['product_description']) . '</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-100"></div>';
                    }
                }
            }

            $bookmodal = '<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3>Book your home survey</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body row m-0">
                                            <p>
                                            Book your free consultation, we are the experts so we don\'t expect you to know everything about heating systems and how to choose the right product for best home comfort and efficiency, before we can go any further let us provide you with a free consultation, we can then provide you with a fixed price quotation. To organise a day and time for a home visit. just click the booking button below.  During the home visit an assessment of your property will be made to ensure that this chosen product is actually suitable for your property.
                                            <br><br>During the home visit we will provide you with a fixed priced quotation before going any further.</p>
                                            <form method="POST" action="' . url('submitbooking') . '">
                                                <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                <input type="hidden" name="productchosen" id="productchosen" value="">
                                                <input type="hidden" name="boostamain" id="boostamain" value="">
                                                <input type="hidden" name="accumulator" id="accumulator" value="">
                                                <input type="hidden" name="totalvalue" id="totalvalue" value="">
                                                <input type="hidden" name="quoteid" id="" value="' . $quoteid . '">
                                                <input type="submit" value="Send Booking Request" class="btn btn-primary">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            $productmodal = '<div class="modal fade" id="extraModal" tabindex="-1" role="dialog" aria-labelledby="extraModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body row m-0">
                                            <input type="hidden" name="finance-subtotal-total" id="finance-subtotal-total" value="' . $subtotalTotal . '" class="form-control">
                                            <input type="hidden" name="finance-estimate-total" id="finance-estimate-total" value="" class="form-control">
                                            <input type="hidden" name="remaining-to-finance" id="remaining-to-finance" value="" class="form-control">
                                            ' . $productModalOutput . '
                                            <div class="w-100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            $financeOutput = '<div class="modal fade" id="finance-extraModal" tabindex="-1" role="dialog" aria-labelledby="finance-extraModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Finance Calculator</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div id="finance-calculator" class="modal-body row m-0">
                                                <input type="hidden" name="finance-subtotal-total" id="finance-subtotal-total" value="' . $subtotalTotal . '" class="form-control">
                                                <input type="hidden" name="finance-estimate-total" id="finance-estimate-total" value="" class="form-control">
                                                <input type="hidden" name="remaining-to-finance" id="remaining-to-finance" value="" class="form-control">
                                                <div id="finance-calculator" class="finance-wrap col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col text-left">Deposit</div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1">£</span>
                                                                        </div>
                                                                        <input type="text" name="finance-deposit" id="finance-deposit" value="0" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="w-100 my-1"></div>
                                                            <div class="row">
                                                                <div class="col text-left">Years of Finance</div>
                                                                <div class="col">
                                                                    <select name="finance-years"  id="finance-years" class="form-control">
                                                                        <option value="3">3 Years</option>
                                                                        <option value="4">4 Years</option>
                                                                        <option value="5">5 Years</option>
                                                                        <option value="6">6 Years</option>
                                                                        <option value="7">7 Years</option>
                                                                        <option value="8">8 Years</option>
                                                                        <option value="9">9 Years</option>
                                                                        <option value="10">10 Years</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="w-100 my-1"></div>
                                                            <div id="repayments-wrap" class="row hide">
                                                                <div class="col text-left">Amount on Finance</div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1">£</span>
                                                                        </div>
                                                                        <input type="text" name="amount-on-finance" id="amount-on-finance" value="0" class="form-control" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="w-100 my-1"></div>
                                                                <div class="col text-left">Monthly Repayments</div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1">£</span>
                                                                        </div>
                                                                        <input type="text" name="finance-monthly-repayments" id="finance-monthly-repayments" value="0" class="form-control" disabled>
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text" id="basic-addon1">/month</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="w-100 my-1"></div>
                                                                <div class="col text-left">Total Interest</div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1">£</span>
                                                                        </div>
                                                                        <input type="text" name="total-interest" id="total-interest" value="0" class="form-control" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="w-100 my-1"></div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div id="finance-total-repayment-value" class="btn btn-secondary mt-2 hide">Total Repayment Value: £5,300</div>
                                                                    <div class="w-100"></div>
                                                                    <div id="calculate-finance" class="btn btn-primary mt-2">Calculate</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <p style="font-size: 0.65rem; color: #808080;font-weight: normal; text-align: left;">
                                                                Finance from 3-10 years at 9.9% APR No deposit needed<br><br>
                                                                Example: £4560 over 5 years, total payable £5744.00, £96/month<br><br>
                                                                Total loan amount 4560.00 repayable by 60 monthly repayments of 95.73.Total charge from credit = £1183.97.<br><br>
                                                                Total amount repayable = £5743.97. Representative APR 9.9% APR.<br><br>
                                                                Subject to status.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            $kwoutput = 'KW-' . $kw;
            $output =
                '
                        <div class="w-100"></div>' . $optionals . $optionalModal . $productOutput . $bookmodal . $productmodal . $financeOutput;
        } else {
            $output = '<div class="alert alert-danger">We couldn\'t find an estimation to match your criteria. That doesn\'t mean we can\'t support you. A member of the team will be in touch.</div>';
        }

        if ($admin == 1) {
            return $output;
        }
        return view('estimates.output', compact('products', 'displayBoost', 'output'));
    }

    public function displayAdmin($quoteid)
    {

        $subTotalRows = '';
        $display = $this->display($quoteid, 1);
        $qu = Quotes::where([['id', '=', $quoteid]])->first();

        $questions = Questions::orderBy('order', 'ASC')->orderBy('id', 'ASC')->get();
        $questionsArray = [];
        //Put the questions in to a readable array.
        foreach ($questions as $q) {
            $questionsArray[$q->id]['question'] = $q->question;
            $questionsArray[$q->id]['options'] = unserialize($q->options);
        }

        $data = unserialize($qu->quote_data);
        $optiondata = unserialize($qu->quote_option_data);

        foreach ($data as $k => $o) {
            if (is_array($data[$k])) {
                foreach ($data[$k] as $quantityO) {
                    if (isset($questionsArray[$k]['options'][$quantityO])) {
                        $meta = $questionsArray[$k]['options'][$quantityO];
                        $pr = $meta['price'];
                        $extradata = '';
                        if ($meta['price-option'] == 1) {
                            if ($meta['field-type'] == 3) {
                                $pr = $optiondata[$k][$quantityO] * $pr;
                                $extradata = ' x ' . $optiondata[$k][$quantityO];
                                if ($k == 19) {
                                    $extradata =  ' ' . $optiondata[$k][$quantityO] . ' m';
                                }
                                if ($k == 13) {
                                    $extradata = ' ' . $optiondata[$k][$quantityO] . ' Sq m';
                                }
                            }
                            if ($meta['field-type'] == 4) {
                                $pr = $optiondata[$k][$quantityO] * $pr;
                                $extradata = ' x ' . $optiondata[$k][$quantityO];
                            }
                            $label = $meta['text'];
                            if (isset($meta['estimate-label']) && $meta['estimate-label'] !== null) {
                                $label = $meta['estimate-label'];
                            }
                            $subTotalRows .= '<p><strong>' . $questionsArray[$k]['question'] . ': </strong> ' . $label . $extradata . '</p>';
                        }
                    }
                }
            } else {
                if (isset($questionsArray[$k]['options'][$o])) {
                    $meta = $questionsArray[$k]['options'][$o];
                    $label = $meta['text'];
                    $pr = $meta['price'];
                    $extradata = '';
                    if ($meta['field-type'] == 3) {
                        $pr = $optiondata[$k][$o] * $pr;
                        $extradata = ' x ' . $optiondata[$k][$o];
                        if ($k == 19) {
                            $extradata =  ' ' . $optiondata[$k][$quantityO] . ' m';
                        }
                        if ($k == 13) {
                            $extradata = ' ' . $optiondata[$k][$quantityO] . ' Sq m';
                        }
                    }
                    if ($meta['field-type'] == 4) {
                        $pr = $optiondata[$k][$o] * $pr;
                        $extradata = ' x ' . $optiondata[$k][$o];
                    }
                    if (isset($meta['estimate-label']) && $meta['estimate-label'] !== null) {
                        $label = $meta['estimate-label'];
                    }
                    $subTotalRows .= '<p><strong>' . $questionsArray[$k]['question'] . ': </strong> ' . $label . $extradata . '</p>';
                }
            }
        }

        //echo $subTotalRows;
        return view('estimates.show')->with('output', $display)->with('quote', $qu)->with('qRows', $subTotalRows);
    }

    public function UpdateStatus(Request $request)
    {
        $updateStatus = $request->input('updateStatus');
        $quoteid = $request->input('quoteid');
        //0 => 'New!', 1 => 'Followed Up', 2 => 'Won', 3 => 'Lost'

        $qu = Quotes::find($quoteid);
        $qu->followed_up = $updateStatus;
        $qu->won = $updateStatus;
        $qu->save();

        return redirect('estimate/output/admin/' . $quoteid)->with('success', 'Status Updated');
    }

    public function SubmitBook(Request $request)
    {
        $quote = Quotes::where('id', $request->input('quoteid'))->first();
        $quote->followed_up = 1;

        $questions = Questions::orderBy('order', 'ASC')->orderBy('id', 'ASC')->get();
        $questionsArray = [];
        $data = unserialize($quote->quote_data);
        $optiondata = unserialize($quote->quote_option_data);
        $subTotalRows = '';
        $subTotalRowsRadiators = '';
        $totalForBoiler = 0;
        $totalRadiatorValue = 0;

        foreach ($questions as $q) {
            $questionsArray[$q->id]['options'] = unserialize($q->options);
        }
        foreach ($data as $k => $o) {
            if (is_array($data[$k])) {
                foreach ($data[$k] as $quantityO) {

                    if (isset($questionsArray[$k]['options'][$quantityO])) {
                        $meta = $questionsArray[$k]['options'][$quantityO];
                        $pr = $meta['price'];
                        $extradata = '';
                        if ($meta['field-type'] == 3) {
                            $pr = $optiondata[$k][$quantityO] * $pr;
                            $extradata = ' x ' . $optiondata[$k][$quantityO];
                            if ($k == 19) {

                                $extradata = ' ' . $optiondata[$k][$quantityO] . ' m';
                            }
                            if ($k == 13) {
                                $extradata = ' ' . $optiondata[$k][$quantityO] . ' Sq m';
                            }
                        }
                        if ($meta['field-type'] == 4) {
                            $pr = $optiondata[$k][$quantityO] * $pr;
                            $extradata = ' x ' . $optiondata[$k][$quantityO];
                        }
                        if ($meta['price-option'] == 1) {
                            $label = $meta['text'];
                            if (isset($meta['estimate-label']) && $meta['estimate-label'] !== null) {
                                $label = $meta['estimate-label'];
                            }
                            if ($k == 1 || $k == 10 || $k == 15 || $k == 19 || $k == 16) {
                                $totalForBoiler += $pr;
                                if ($k == 10) {
                                    $subTotalRows .= '<p class="text-c ">' . $label . $extradata . '</p>';
                                }
                            } else {
                                if ($k == 6 || $k == 7 || $k == 8 || $k == 9 || $k == 20 || $k == 21) {
                                    $totalRadiatorValue += $pr;
                                    $subTotalRowsRadiators .= '<p class="text-c ">' . $label . $extradata . '</p>';
                                } else {
                                    $subTotalRows .= '<p class="text-c ">' . $label . $extradata . '<span style="float:right" class="single-product-price">£' . $pr . '</span></p>';
                                }
                            }
                        }
                    }
                }
            } else {
                if (isset($questionsArray[$k]['options'][$o])) {
                    $meta = $questionsArray[$k]['options'][$o];
                    $pr = $meta['price'];
                    $extradata = '';
                    if ($meta['field-type'] == 3) {
                        $pr = $optiondata[$k][$o] * $pr;
                        $extradata = ' x ' . $optiondata[$k][$o];
                        if ($k == 19) {

                            $extradata = ' ' . $optiondata[$k][$o] . ' m';
                        }
                        if ($k == 13) {
                            $extradata = ' ' . $optiondata[$k][$o] . ' Sq m';
                        }
                    }
                    if ($meta['field-type'] == 4) {
                        $pr = $optiondata[$k][$o] * $pr;
                        $extradata = ' x ' . $optiondata[$k][$o];
                    }
                    if ($meta['price-option'] == 1) {
                        $label = $meta['text'];
                        if (isset($meta['estimate-label']) && $meta['estimate-label'] !== null) {
                            $label = $meta['estimate-label'];
                        }
                        if ($k == 1 || $k == 10 || $k == 15 || $k == 19 || $k == 16) {
                            $totalForBoiler += $pr;
                            if ($k == 10) {
                                $subTotalRows .= '<p class="text-c ">' . $label . $extradata . '</p>';
                            }
                        } else {
                            if ($k == 14) {
                                if ($o == 1) {
                                    $subTotalRows .= '<p class="text-c ">' . $label . $extradata .  '<span style="float:right" class="single-product-price">£' . $pr . '</span></p>';
                                }
                            } else {
                                if ($k == 6 || $k == 7 || $k == 8 || $k == 9 || $k == 20 || $k == 21) {
                                    $totalRadiatorValue += $pr;
                                    $subTotalRowsRadiators .= '<p class="text-c ">' . $label . $extradata . '</p>';
                                } else {
                                    $subTotalRows .= '<p class="text-c ">' . $label . $extradata . '<span style="float:right" class="single-product-price">£' . $pr . '</span></p>';
                                }
                            }
                        }
                    }
                }
            }
        }
        $subTotalRowsRadiatorsTotal = '<p class="text-c "> Total Radiators Amount<span style="float:right" class="single-product-price">£' . $totalRadiatorValue . '</span></p>';
        $subTotalRows .= $subTotalRowsRadiators . $subTotalRowsRadiatorsTotal;
        $quote->final_details = serialize(['product_id' => $request->productchosen, 'water' => $request->water, 'addons' => $request->addons ? $request->addons : [], 'totalvalue' => $request->totalvalue, 'subTotalRows' => $subTotalRows, 'subtotal' => $request->subtotal, 'totalForBoiler' => $totalForBoiler]);
        $quote->quoted_price = serialize([$request->totalvalue]);
        $quote->save();
        Mail::to($quote->email)->send(
            new BookAppointment($quote, 'newBookAppoitment')
        );
        Mail::to('info@chelmsfordgas.co.uk')->send(
            new BookAppointment($quote, 'NewAppointment-new')
        );

        return redirect('thank-you?estimates=1');
    }

    public function saveFormSession(Request $request)
    {
        if (!empty($request->address)) {
            return response()->json(['error' => 'Address found']);
        }
        $postCode = PostCode::where('quotes', true)->where(function ($q) use ($request) {
            for ($i = strlen($request->post_code); $i >= 2; $i--) {
                $q->orWhere('name', substr($request->post_code, 0, $i));
            }
        })->exists();
        if ($request->post_code && !$request->email && !$postCode) {
            return response()->json(['success' => false]);
        }
        if ($request->post_code && $request->email && !$postCode) {
            $validator = Validator::make($request->all(), [
                'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'error' =>  $validator->errors()], 400);
            }
            Mail::to($request->email)->send(new PostCodeEmail(false));
            Mail::to('info@chelmsfordgas.co.uk')->send(new PostCodeEmail(true));
            return response()->json(['success' => true, 'type' => 'email']);
        }



        $mail = false;
        if (!$form  = FormSession::where('session_id', session('sessionId'))->first()) {
            $form = new FormSession();
            $form->session_id = session('sessionId');
            $mail = $form->mail_sent;
        }
        if ($request->post_code) {
            $form->post_code = $request->post_code;
        }
        if ($request->email) {
            $form->email = $request->email;
        }
        if (!$request->post_code) {
            $form->form_data = json_encode($request->all());
            $mail = true;
        }
        if ($form->save()) {
            if (!$request->post_code &&  $request->has('first')) {
                $form->mail_sent = true;
                $form->save();
                $formUrl = url('/') . '?sessionId=' . $form->session_id;
                Mail::to($form->email)->send(new FormSessionMail($request->all(), true, $formUrl));
            }
            return response()->json(['success' => true, 'type' => 'session']);
        }
    }
}
