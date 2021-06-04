<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;
use Illuminate\Support\Str;

class ProductManagementController extends Controller
{
    public function index(){
        if(!empty(request('wanted')))
        {
            //Search buttonuna basilan zaman bunu yazmayanda input icerisindeki axtarilan soz silinirdi.
            //Bunu ona gore yaziriq ki,flash() session icinde hemin sozu saxlayir ve buttona basilanda
            //axtarilan soz itmir.
            request()->flash();
            $wanted=request('wanted');
            $list=Product::where('name','like', "%$wanted%")
                ->orwhere('slug','like',"%$wanted%")
                ->orderbydesc('created_at')
                ->paginate(8)
                ->appends('wanted',$wanted);
        }
        else{
            $list=Product::orderbydesc('created_at')->paginate(8);
        }

        return view('admin.product.index', compact('list'));
    }

    public function form($id = 0)
    {
        $product=new Product();
        $product_categories=[];

        //pluck('id') methodu categoryler icerisinden producta aid olanlarin id-lerini getirir ancaq.
        if($id>0){
            $product=Product::find($id);
            $product_categories=$product->categories()->pluck('category_id')->all();
        }
        $categories=Category::all();
        return view('admin.product.form', compact('product', 'categories','product_categories'));
    }

    public function save($id = 0)
    {
        $data=request()->only('name','slug','details','price');
        $data_detail=request()->only('show_slider', 'opportunity_day',
            'stand_out', 'selling_lot', 'show_sales');

        //Xanalar doludurmu deye yoxlayiriq...
        $this->validate(request(),[
            'name'=>'required',
            'price'=>'required',
            'details'=>'required',
            'slug'=>request('original_slug')!= request('slug') ? 'unique:product,slug' : ' '
        ]);

        $categories=request('categories');

        if(!request()->filled('slug')){
            $data['slug']=Str::slug(request('name'));

            if(Product::whereslug($data['slug'])->count()>0){
                return back()->withInput()->withErrors(['slug' => 'Slug already has been taken.']);
            }
        }
        //Eger Update prosesidirse id gelecek yeni >0 olacaq.
        if($id>0){
            $product=Product::find($id);
            $product->update($data);
            $product->detail()->update($data_detail);
            //sync methodu database-deki categoryleri silir, selectboxdaki categorileri elave edir
            // hemin product ucun.
            $product->categories()->sync($categories);
        }
        //eks halda id gelmir deye create prosesi olur.
        else{
            $product=Product::create($data);
            $product->detail()->create($data_detail);

            //attach methodu vasitesiyle many to many table-a selectden gelen category->id-lerimizi
            // add edirik.
            $product->categories()->attach($categories);
        }

        //File Upload
        if(request()->hasFile('product_img'))
        {
            $this->validate(request(),[
                'product_img' =>'image|mimes:jpg,png,jpeg,gif|max:2048'
            ]);

            $product_img=request()->file('product_img');
            $file_name=$product->id . '-' . time() . '.'. $product_img->extension();

            if($product_img->isValid()){
                $product_img->move('uploads/products', $file_name);
                ProductDetail::updateorCreate(
                    ['product_id'=>$product->id],
                    ['product_img'=>$file_name]);
            }
        }
        return redirect()->route('admin.product.update',$product->id)
            ->with('message_type','success')
            ->with('message','New product has been created.');

    }

    public function delete($id){
        if($id!=null){
            $product=Product::find($id);
            //many to many oldugu ucun silmede detach funk-ni isledirik.
            $product->categories()->detach();
            //one to one oldugu ucun delete funk-ni isledirik.
            //$product->detail()->delete();
            $product->delete();

            return redirect()->route('admin.product')
                ->with('message_type','success')
                ->with('message','Product has been deleted.');
        }
        return redirect()->route('admin.product')
            ->with('message_type','danger')
            ->with('message','Product is not found.');
    }
}
