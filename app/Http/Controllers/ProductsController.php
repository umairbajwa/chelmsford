<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use Illuminate\Http\Request;
use App\Products;
use Auth;
use Image;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = AdminSetting::orderBy('created_at', 'DESC')->first();
        if (!$setting) {
            $setting = new AdminSetting();
            $setting->kw = true;
            $setting->save();
        }

        $products = Products::where('account_id', Auth::user()->account_id)->orderBy('iscombi')->get();
        $globalPriceValue = 0;
        $globalValueType = 'Increase';
        $globalValueExpiry = '';
        $globalPDF = '';
        if (count($products)) {
            $globalPriceValue = $products[0]->global_value_percentage ? $products[0]->global_value_percentage : 0;
            $globalValueType = $products[0]->global_value_type;
            $globalValueExpiry = $products[0]->global_value_expiry;
            $globalPDF = $products[0]->global_pdf;
        }
        return view('products.index')->with('products', $products)->with('globalPriceValue', $globalPriceValue)->with('globalValueType', $globalValueType)->with('globalPDF', $globalPDF)->with('globalValueExpiry', $globalValueExpiry)
            ->with('setting', $setting);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'shortdescription' => 'required',
            'product_price' => 'required',
            'image' => 'image|max:20000',
            'pdf' => 'mimes:pdf|max:20000',
            'lower' => 'required',
            'upper' => 'required'
        ]);

        $imageFileToStore = '';
        $pdfFileToStore = '';
        //Handle file upload
        if ($request->hasFile('image')) {
            //Get file with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            //Get Just File Name
            $fileName =  pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $fileNameExt = $request->file('image')->getClientOriginalExtension();
            //FileName to store
            $imageFileToStore = $fileName . '_' . time() . '.' . $fileNameExt;
            $imageFileToStore = str_replace(' ', '_', $imageFileToStore);

            $img = Image::make($request->file('image'))->orientate();
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save('storage/products/' . $imageFileToStore, 80, $fileNameExt);
        }
        if ($request->hasFile('pdf')) {
            //Get file with extension
            $fileNameWithExt = $request->file('pdf')->getClientOriginalName();
            //Get Just File Name
            $fileName =  pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $fileNameExt = $request->file('pdf')->getClientOriginalExtension();
            //FileName to store
            $pdfFileToStore = $fileName . '_' . time() . '.' . $fileNameExt;
            $pdfFileToStore = str_replace(' ', '_', $pdfFileToStore);

            $request->file('pdf')->move('storage/products/', $pdfFileToStore);
        }

        /*$criteria = serialize([
            'hometype' => $request->input('hometype'),
            'bedrooms' => $request->input('bedrooms'),
            'bathrooms' => $request->input('bathrooms'),
            'radiators' => $request->input('radiators'),
            'towel' => $request->input('towel'),
            'underfloor' => $request->input('underfloor')
        ]);*/

        $products = new Products;
        $products->account_id = Auth::user()->account_id;
        $products->user_id = Auth::user()->id;
        $products->product_name = $request->input('name');
        $products->shortdescription = $request->input('shortdescription');
        $products->value_percentage = $request->input('value_percentage');
        $products->value_type = $request->input('value_type');
        $products->liter = $request->input('liter');
        $products->image = $imageFileToStore;
        $products->pdf = $pdfFileToStore;
        $products->price = $request->input('materials') + $request->input('labour');
        $products->product_price = $request->input('product_price');
        $products->materials = $request->input('materials');
        $products->labour = $request->input('labour');
        //$products->criteria = $criteria;
        $products->lower_bracket = $request->input('lower');
        $products->upper_bracket = $request->input('upper');
        $products->iscombi = $request->input('combi');
        $products->range = $request->input('range');
        $products->save();


        return redirect('/products')->with("success", "Product added successfully !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = Products::find($id);
        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'shortdescription' => 'required',
            'price' => 'required',
            'image' => 'image|max:20000',
            'pdf' => 'mimes:pdf|max:20000',
            'lower' => 'required',
            'upper' => 'required'
        ]);

        $imageFileToStore = '';
        $pdfFileToStore = '';
        //Handle file upload
        if ($request->hasFile('image')) {
            //Get file with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            //Get Just File Name
            $fileName =  pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $fileNameExt = $request->file('image')->getClientOriginalExtension();
            //FileName to store
            $imageFileToStore = $fileName . '_' . time() . '.' . $fileNameExt;
            $imageFileToStore = str_replace(' ', '_', $imageFileToStore);

            $img = Image::make($request->file('image'))->orientate();
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save('storage/products/' . $imageFileToStore, 80, $fileNameExt);
        }
        if ($request->hasFile('pdf')) {
            //Get file with extension
            $fileNameWithExt = $request->file('pdf')->getClientOriginalName();
            //Get Just File Name
            $fileName =  pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $fileNameExt = $request->file('pdf')->getClientOriginalExtension();
            //FileName to store
            $pdfFileToStore = $fileName . '_' . time() . '.' . $fileNameExt;
            $pdfFileToStore = str_replace(' ', '_', $pdfFileToStore);

            $request->file('pdf')->move('storage/products/', $pdfFileToStore);
        }

        /*$criteria = serialize([
            'hometype' => $request->input('hometype'),
            'bedrooms' => $request->input('bedrooms'),
            'bathrooms' => $request->input('bathrooms'),
            'radiators' => $request->input('radiators'),
            'towel' => $request->input('towel'),
            'underfloor' => $request->input('underfloor')
        ]);*/

        $products = Products::find($id);
        $products->account_id = Auth::user()->account_id;
        $products->user_id = Auth::user()->id;
        $products->product_name = $request->input('name');
        $products->product_description = $request->input('description');
        $products->shortdescription = $request->input('shortdescription');
        $products->value_percentage = $request->input('value_percentage');
        $products->materials = $request->input('materials');
        $products->labour = $request->input('labour');
        $products->product_price = $request->input('product_price');
        $products->value_type = $request->input('value_type');
        $products->liter = $request->input('liter');
        if ($request->hasFile('image')) {
            $products->image = $imageFileToStore;
        }
        if ($request->hasFile('pdf')) {
            $products->pdf = $pdfFileToStore;
        }
        $products->price = $request->input('materials') + $request->input('labour');
        //$products->criteria = $criteria;
        $products->lower_bracket = $request->input('lower');
        $products->upper_bracket = $request->input('upper');
        $products->iscombi = $request->input('combi');
        $products->range = $request->input('range');
        $products->save();

        if ($request->next == '1') {
            $next = Products::where('id', '>', $products->id)->orderBy('id')->first();
            if ($next)
                return redirect("/products/" . ($next->id) . "/edit")->with("success", "Product updated successfully !");
        }
        return redirect('/products')->with("success", "Product updated successfully !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function globalPrice(Request $request)
    {
        Products::where('id', '>', 0)->update(['global_value_percentage' => $request->global_value_percentage, 'global_value_type' => $request->global_value_type, 'global_value_expiry' => $request->global_value_expiry]);
        return redirect('/products')->with("success", "Price updated successfully !");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function globalPDFDelete(Request $request)
    {
        $product = Products::where('account_id', Auth::user()->account_id)->first();
        if (!$product) {
            return redirect('/products')->with("error", "Generic PDF does not exists!");
        }
        if (is_file('storage/products/' . $product->global_pdf)) {
            unlink('storage/products/' . $product->global_pdf);
            Products::where('id', '>', 0)->update(['global_pdf' => '']);
        }
        return redirect('/products')->with("success", "Generic PDF removed successfully !");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function globalPDF(Request $request)
    {
        $this->validate($request, [
            'global_pdf' => 'mimes:pdf|max:20000',
        ]);

        $pdfFileToStore = '';
        if ($request->hasFile('global_pdf')) {
            //Get file with extension
            $fileNameWithExt = $request->file('global_pdf')->getClientOriginalName();
            //Get Just File Name
            $fileName =  pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $fileNameExt = $request->file('global_pdf')->getClientOriginalExtension();
            //FileName to store
            $pdfFileToStore = $fileName . '_' . time() . '.' . $fileNameExt;
            $pdfFileToStore = str_replace(' ', '_', $pdfFileToStore);

            $request->file('global_pdf')->move('storage/products/', $pdfFileToStore);
        }

        Products::where('id', '>', 0)->update(['global_pdf' => $pdfFileToStore]);
        return redirect('/products')->with("success", "PDF uploaded successfully !");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wkUpdate(Request $request)
    {
        $this->validate($request, [
            'kw' => 'required|bool',
        ]);

        $setting = AdminSetting::orderBy('created_at', 'DESC')->first();
        $setting->kw = $request->kw;
        $setting->save();
        $message = $request->kw ? 'enabled' : 'disabled';
        return redirect('/products')->with("success", "KW Option {$message} successfully !");
    }
}
