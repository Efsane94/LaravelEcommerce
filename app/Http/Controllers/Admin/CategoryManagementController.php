<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryManagementController extends Controller
{
    public function index(){
        if(request()->filled('wanted') || request()->filled('sup_id'))
        {
            //Search buttonuna basilan zaman bunu yazmayanda input icerisindeki axtarilan soz silinirdi.
            //Bunu ona gore yaziriq ki,flash() session icinde hemin sozu saxlayir ve buttona basilanda
            //axtarilan soz itmir.
            request()->flash();
            $wanted=request('wanted');
            $sup_id=request('sup_id');

            //Burda with(sup_category)-ni eager loading ucun yaziriq daha cox yuklenmenin qarsisini almaq
            //ucun. Category-ni supcategory-leri ile birlikde cekirik db-den.
            $list=Category::with('sup_category')
                ->where('name','like', "%$wanted%")
                ->where('sup_categoryId',$sup_id)
                ->orderbydesc('id')
                ->paginate(4)
                ->appends(['wanted'=>$wanted, 'sup_id'=>$sup_id]);
        }
        else{
            //Axtaris olmayan zaman selectboxu temizlemek ucundur. Eks halda temizle butonuna basilsa bele
            //selectboxun ici temizlenmir.
            request()->flush();
            $list=Category::with('sup_category')->orderbydesc('id')->paginate(8);
        }

        $sup_categories=Category::whereRaw('sup_categoryId is null')->get();

        return view('admin.Category.index', compact('list','sup_categories'));
    }

    public function form($id = 0)
    {
        $category=new Category();

        if($id>0){
            $category=Category::find($id);
        }

        $categories=Category::all();
        return view('admin.category.form', compact('category','categories'));
    }

    public function save($id = 0)
    {
        //Xanalar doludurmu deye yoxlayiriq...
        $this->validate(request(),[
            'name'=>'required',
            'slug'=>request('original_slug')!= request('slug') ? 'unique:category,slug' : ' '
        ]);

        $data=request()->only('name','slug','sup_categoryId');

        if(!request()->filled('slug')){
            $data['slug']=Str::slug(request('name'));

            if(Category::whereslug($data['slug'])->count()>0){
                return back()->withInput()->withErrors(['slug' => 'Slug already has been taken.']);
            }
        }
        //Eger Update prosesidirse id gelecek yeni >0 olacaq.
        if($id>0){
            $category=Category::find($id);
            $category->update($data);
        }
        //eks halda id gelmir deye create prosesi olur.
        else{
            $category=Category::create($data);
        }
        return redirect()->route('admin.category.update',$category->id)
            ->with('message_type','success')
            ->with('message','New category has been created.');


    }

    public function delete($id){
        //attach detach --Many to many data add etmek ve delete etmek ucundur.

        $category=Category::find($id);

        $category->products()->detach();
        Category::destroy($id);

        return redirect()->route('admin.category')
            ->with('message_type','success')
            ->with('message','Category has been deleted.');

    }
}
