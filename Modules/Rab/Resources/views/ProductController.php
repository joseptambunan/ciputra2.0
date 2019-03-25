<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Genders;
use Modules\Admin\Entities\Categories;
use Modules\Admin\Entities\Products;
use Modules\Admin\Entities\ProductFavorites;
use Modules\Admin\Entities\Countries;
use Modules\Admin\Entities\ProductHighlights;
use Modules\Admin\Entities\Brand;
use PDFMerger;
use Bitly;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $products = Products::get();
        $arrayresult = array();
        foreach ($products as $key => $value) {
            $category = "";
            $brand = "";
            $gender = "";
            $pdf = "";
            $icon = "";
            $brand_logo = "";
            $category_url = "";

            if ( $value->categories != "" ){
                $category = $value->categories->name;
                $category_url =  "http://".$_SERVER['HTTP_HOST'].'/product/categories/detail/?id='.$value->categories->id;
            }

            if ( $value->brand != "" ){
                $brand = $value->brand->name;
                $brand_logo = "";
                if ( $value->brand->logo != ""){
                    $tmp_logo = explode("/",$value->brand->logo);
                    if ( count($tmp_logo) > 3 ){
                        $logo = $tmp_logo[3];
                        $brand_logo = "http://".$_SERVER['HTTP_HOST']."/storage/public/files/brands/".$logo;
                    }
                }
                
            }

            if ( $value->gender != "" ){
                $gender = $value->gender->name;
            }

            if ( $value->pdf != "" ){
                $tmp_pdf = explode("/", $value->pdf );
                if ( count($tmp_pdf) > 3 ){
                    $pdf = $tmp_pdf[3];                    
                }
            }

            if ( $value->icon != "" ){
                $tmp_icon = explode("/", $value->icon );
                if ( count($tmp_icon) > 3 ){
                    $icon = $tmp_icon[3];
                }
            }

            $arrayresult[$key] = array(
                "name" => $value->nama,
                "brand" => $brand,
                "category" => $category,
                "gender" => $gender,
                "pdf" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->id.'/'.$pdf,
                "image" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->id.'/'.$icon,
                "id" => $value->id,
                "url" => "http://".$_SERVER['HTTP_HOST']."/product/detail?id=".$value->id,
                "price" => number_format($value->price),
                "brand_logo" => $brand_logo,
                "category_url" => $category_url,
                "size" => $value->size,
                "weight" => $value->weight,
                "sku" => $value->sku,
                "dimension" => $value->dimension
            );
        }
        return response()->json(["products" => $arrayresult]);
        //return view('product::index',compact("gende"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function latest(Request $request)
    {
        $product = Products::take(5)->orderBy("id","desc")->get();
        return response()->json(["product" => $product]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function gender(Request $request)
    {
        $gender = Genders::find($request->id);
        $product = $gender->product;
        return response()->json(['category' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function category(Request $request){
        $categories = Categories::get();
		$arrayresult = array();
		foreach ( $categories as $key => $value ) {
			$arrayresult[$key] = array(
                "id" => $value->id,
                "name" => $value->name,
                "url" => "http://".$_SERVER['HTTP_HOST'].'/product/categories/detail/?id='.$value->id
            );
		}
        return response()->json(["categories" => $arrayresult]);
    }

    public function detailcategory(Request $request){
        $categories = Categories::find($request->id);
        $arrayresult = array();
        foreach ( $categories->products as $key => $value ) {
            $category = "";
            $brand = "";
            $gender = "";
            $pdf = "";
            $icon = "";
            $brand_logo = "";
            $category_url = "";

            if ( $value->categories != "" ){
                $category = $value->categories->name;
                $category_url =  "http://".$_SERVER['HTTP_HOST'].'/product/categories/detail/?id='.$value->categories->id;
            }

            if ( $value->brand != "" ){
                $brand = $value->brand->name;
                $brand_logo = "";
                if ( $value->brand->logo != ""){
                    $tmp_logo = explode("/",$value->brand->logo);
                    if ( count($tmp_logo) > 3 ){
                        $logo = $tmp_logo[3];
                        $brand_logo = "http://".$_SERVER['HTTP_HOST']."/storage/public/files/brands/".$logo;
                    }
                }
                
            }


            if ( $value->gender != "" ){
                $gender = $value->gender->name;
            }

            if ( $value->pdf != "" ){
                $tmp_pdf = explode("/", $value->pdf );
                if ( count($tmp_pdf) > 3 ){
                    $pdf = $tmp_pdf[3];                    
                }
            }

            if ( $value->icon != "" ){
                $tmp_icon = explode("/", $value->icon );
                if ( count($tmp_icon) > 3 ){
                    $icon = $tmp_icon[3];
                }
            }


            $arrayresult[$key] = array(
                "name" => $value->nama,
                "brand" => $brand,
                "category" => $category,
                "gender" => $gender,
                "pdf" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->id.'/'.$pdf,
                "image" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->id.'/'.$icon,
                "id" => $value->id,
                "url" => "http://".$_SERVER['HTTP_HOST']."/product/detail?id=".$value->id,
                "price" => number_format($value->price),
                "brand_logo" => $brand_logo,
                "category_url" => $category_url,
                "size" => $value->size,
                "weight" => $value->weight,
                "sku" => $value->sku,
                "dimension" => $value->dimension,
                "description" => $value->description
            );
        }
        return response()->json(["products" => $arrayresult]);
    }

    public function show(Request $request)
    {
        $product = Products::find($request->id);

        if ( $product->gender != "" ){
            $gender = $product->gender->name;
        }

        if ( $product->pdf != "" ){
            $tmp_pdf = explode("/", $product->pdf );
            if ( count($tmp_pdf) > 3 ){
                $pdf = $tmp_pdf[3];                    
            }
        }

        if ( $product->icon != "" ){
            $tmp_icon = explode("/", $product->icon );
            if ( count($tmp_icon) > 3 ){
                $icon = $tmp_icon[3];
            }
        }

        if ( $product->categories != "" ){
            $category = $product->categories->name;
            $category_url =  "http://".$_SERVER['HTTP_HOST'].'/product/categories/detail/?id='.$product->categories->id;
        }

        if ( $product->brand != "" ){
            $brand = $product->brand->name;
            $brand_logo = "";
            if ( $product->brand->logo != ""){
                $tmp_logo = explode("/",$product->brand->logo);
                if ( count($tmp_logo) > 3 ){
                    $logo = $tmp_logo[3];
                    $brand_logo = "http://".$_SERVER['HTTP_HOST']."/storage/public/files/brands/".$logo;
                }
            }
            
        }

        //Bitly
        $url_bitly = "https://api-ssl.bitly.com/v3/shorten?login=joseptambunan&apiKey=R_db1c61c5aa614c0893ae5c3d292fe857&longUrl=http://".$_SERVER['HTTP_HOST']."/product/detail?id=".$product->id."&format=json";

        $ch = curl_init($url_bitly);
        curl_setopt($ch,CURLOPT_URL,$url_bitly);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,50);
        $data = curl_exec($ch);
        $json = json_decode($data);
        $bitly = $json->data->url;

        $arrayresult[0] = array(
            "name" => $product->nama,
            "brand" => $brand,
            "category" => $category,
            "gender" => $gender,
            "pdf" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$product->id.'/'.$pdf,
            "image" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$product->id.'/'.$icon,
            "id" => $product->id,
            "url" => "http://".$_SERVER['HTTP_HOST']."/product/detail?id=".$product->id,
            "price" => number_format($product->price),
            "brand_logo" => $brand_logo,
            "category_url" => $category_url,
            "size" => $product->size,
            "weight" => $product->weight,
            "sku" => $product->sku,
            "dimension" => $product->dimension,
            "description" => $product->description,
            "bitly" => $bitly,
            "share_fb" => "https://www.facebook.com/sharer/sharer.php?u=".$bitly,
            "share_tw" => "http://www.twitter.com/share?url=".$bitly
        );

        return response()->json(['product' => $arrayresult]);
    }

    public function favorites(Request $request){
        $user = \App\User::find($request->user_id);
        $favorites = $user->favorites;
        $arrayresult = array();
        $brand = "";
        $start = 0;
        foreach ($favorites as $key => $value) {

            if ( $value->product != ""){
                if ( $value->product->pdf != "" ){
                    $tmp_pdf = explode("/", $value->product->pdf );
                    if ( count($tmp_pdf) > 3 ){
                        $pdf = $tmp_pdf[3];
                    }
                }else{
                    $pdf = "";
                }

                if ( $value->product->icon != "" ){
                    $tmp_icon = explode("/", $value->product->icon );
                    if ( count($tmp_icon) > 3 ){
                        $icon = $tmp_icon[3];
                    }
                }else{
                    $icon = "";
                }

                if ( $value->product->brand != ""){
                    $brand = $value->product->brand->name;
                }


                $arrayresult[$start] = array(
                    "id" => $value->product->id,
                    "name" => $value->product->nama,
                    "brand" => $brand,
                    "description" => $value->product->description,
                    "pdf" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->product->id.'/'.$pdf,
                    "image" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->product->id.'/'.$icon,
                    "size" => $value->product->size,
                    "weight" => $value->product->weight,
                    "sku" => $value->product->sku,
                    "dimension" => $value->product->dimension,
                    "price" => $value->product->price,
                    "favorites_id" => $value->id,
                    "description" => $value->product->description
                );
                $start++;
            }
        }
        return response()->json(["result" => $arrayresult]);
    }

    public function savefavorites(Request $request){
        $product_favorites = new ProductFavorites;
        $product_favorites->product_id = $request->product_id;
        $product_favorites->user_id = $request->user_id;
        $product_favorites->created_by = $request->user_id;
        $product_favorites->save();
        return response()->json(["status" => "0"]);
    }

    public function highlights(Request $request){
        $arrayresult = array();
        $product = ProductHighlights::get();
        $brand = "";
        $start = 0;
        foreach ($product as $key => $value) {
            if ( $value->product->pdf != "" ){
                $tmp_pdf = explode("/", $value->product->pdf );
                if ( count($tmp_pdf) > 3){
                    $pdf = $tmp_pdf[3];
                }
            }else{
                $pdf = "";
            }

            if ( $value->product->icon != "" ){
                $tmp_icon = explode("/", $value->product->icon );
                if ( count($tmp_icon) > 3){
                    $icon = $tmp_icon[3];
                }
            }else{
                $icon = "";
            }

            if ( $value->product->brand != ""){
                $brand = $value->product->brand->name;
            }

            if ( $value->banner != "" ){
                $tmp_banner = explode("/", $value->banner );
                if ( count($tmp_banner) > 3 ){
                    $banner = $tmp_banner[3];
                }
            }else{
                $banner = "";
            }


            if ( $value->deleted_at == "" ){
                $arrayresult[$start] = array(
                    "id" => $value->product->id,
                    "name" => $value->product->nama,
                    "brand" => $brand,
                    "description" => $value->product->description,
                    "pdf" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->product->id.'/'.$pdf,
                    "icon" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->product->id.'/'.$icon,
                    "banner" => "http://".$_SERVER['HTTP_HOST']. "/storage/public/files/banner/". $banner
                );
                $start++;
            }
        }
        return response()->json(["result" => $arrayresult]);
    }

    public function allgender(){
        $gender = Genders::get();
        return response()->json(["result" => $gender]);
    }

    public function countries(){
        $countries = Countries::get();
        return response()->json(["result" => $countries]);
    }

    public function brands(){
        $brands = Brand::get();
        $arrayresult = array();
        foreach ($brands as $key => $value) {
            $logo = "";
            if ( $value->logo != ""){
                $tmp_logo = explode("/",$value->logo);
                if ( count($tmp_logo) > 3 ){
                    $logo = $tmp_logo[3];
                }
            }
            $arrayresult[$key] = array(
                "nama" => $value->name,
                "image" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/brands/".$logo,
                "id" => $value->id,
                "url" => "http://".$_SERVER['HTTP_HOST']."/product/detailbrand/?id=".$value->id
            );
        }
        return response()->json(["result" => $arrayresult]);
    }

    public function detailbrand(Request $request){
        $brands = Brand::find($request->id);
        $arrayresult = array();
        $start = 0;
        foreach ($brands->product as $key => $value) {
            $category = "";
            $brand = "";
            $gender = "";
            $pdf = "";
            $icon = "";
            $brand_logo = "";
            $category_url = "";

            if ( $value->categories != "" ){
                $category = $value->categories->name;
                $category_url =  "http://".$_SERVER['HTTP_HOST'].'/product/categories/detail/?id='.$value->categories->id;
            }

            if ( $value->brand != "" ){
                $brand = $value->brand->name;
                $brand_logo = "http://".$_SERVER['HTTP_HOST']."/storage/public/files/brands/".$value->brand->logo;
            }

            if ( $value->gender != "" ){
                $gender = $value->gender->name;
            }

            if ( $value->pdf != "" ){
                $tmp_pdf = explode("/", $value->pdf );
                if ( count($tmp_pdf) > 3 ){
                    $pdf = $tmp_pdf[3];                    
                }
            }

            if ( $value->icon != "" ){
                $tmp_icon = explode("/", $value->icon );
                if ( count($tmp_icon) > 3 ){
                    $icon = $tmp_icon[3];
                }
            }


            $arrayresult[$start] = array(
                "name" => $value->nama,
                "brand" => $brand,
                "category" => $category,
                "gender" => $gender,
                "pdf" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->id.'/'.$pdf,
                "image" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->id.'/'.$icon,
                "id" => $value->id,
                "url" => "http://".$_SERVER['HTTP_HOST']."/product/detail?id=".$value->id,
                "price" => number_format($value->price),
                "brand_logo" => $brand_logo,
                "category_url" => $category_url,
                "size" => $value->size,
                "weight" => $value->weight,
                "sku" => $value->sku,
                "dimension" => $value->dimension,
                "description" => $value->description
            );
            $start++;
        }
        return response()->json(["arrayresult" => $arrayresult]);
    }

    public function deletefavorites(Request $request){
        $favorites = ProductFavorites::find($request->favorites_id);
        $status = $favorites->delete();
        if ( $status ){
            return response()->json(["status" => "0"]);
        }else{
            return response()->json(["status" => "1"]);
        }
    }

    public function productcountries(Request $request){
    	$countries = Countries::find($request->id);
    	$arrayresult = array();
    	$start = 0;
    	foreach ($countries->product as $key => $value) {
    		$category = "";
            $brand = "";
            $gender = "";
            $pdf = "";
            $icon = "";
            $brand_logo = "";
            $category_url = "";

            if ( $value->categories != "" ){
                $category = $value->categories->name;
                $category_url =  "http://".$_SERVER['HTTP_HOST'].'/product/categories/detail/?id='.$value->categories->id;
            }

            if ( $value->brand != "" ){
                $brand = $value->brand->name;
                $brand_logo = "http://".$_SERVER['HTTP_HOST']."/storage/".$value->brand->logo;
            }

            if ( $value->gender != "" ){
                $gender = $value->gender->name;
            }

            if ( $value->pdf != "" ){
                $tmp_pdf = explode("/", $value->pdf );
                if ( count($tmp_pdf) > 3 ){
                    $pdf = $tmp_pdf[3];                    
                }
            }

            if ( $value->icon != "" ){
                $tmp_icon = explode("/", $value->icon );
                if ( count($tmp_icon) > 3 ){
                    $icon = $tmp_icon[3];
                }
            }


            $arrayresult[$start] = array(
                "name" => $value->nama,
                "brand" => $brand,
                "category" => $category,
                "gender" => $gender,
                "pdf" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->id.'/'.$pdf,
                "image" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->id.'/'.$icon,
                "id" => $value->id,
                "url" => "http://".$_SERVER['HTTP_HOST']."/product/detail?id=".$value->id,
                "price" => number_format($value->price),
                "brand_logo" => $brand_logo,
                "category_url" => $category_url,
                "size" => $value->size,
                "weight" => $value->weight,
                "sku" => $value->sku,
                "dimension" => $value->dimension,
                "description" => $value->description
            );
            $start++;
    	}
    	return response()->json(["arrayresult" => $arrayresult]);
    }

    public function countryhighlights(Request $request){
        $country = Countries::find($request->id);
        $start = 0;
        $arrayresult = array();
        foreach ( $country->highlights as $key => $value ){
            if ( $value->product != "" ){
                if ( $value->product->pdf != "" ){
                    $tmp_pdf = explode("/", $value->product->pdf );
                    if ( count($tmp_pdf) > 3){
                        $pdf = $tmp_pdf[3];
                    }
                }else{
                    $pdf = "";
                }

                if ( $value->product->icon != "" ){
                    $tmp_icon = explode("/", $value->product->icon );
                    if ( count($tmp_icon) > 3){
                        $icon = $tmp_icon[3];
                    }
                }else{
                    $icon = "";
                }

                if ( $value->product->brand != ""){
                    $brand = $value->product->brand->name;
                }

                if ( $value->banner != "" ){
                    $tmp_banner = explode("/", $value->banner );
                    if ( count($tmp_banner) > 3 ){
                        $banner = $tmp_banner[3];
                    }
                }else{
                    $banner = "";
                }


                if ( $value->deleted_at == "" ){
                    $arrayresult[$start] = array(
                        "id" => $value->product->id,
                        "name" => $value->product->nama,
                        "brand" => $brand,
                        "description" => $value->product->description,
                        "pdf" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->product->id.'/'.$pdf,
                        "icon" => "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$value->product->id.'/'.$icon,
                        "banner" => "http://".$_SERVER['HTTP_HOST']. "/storage/public/files/banner/". $banner
                    );
                    $start++;
                }
            }            
        }
        return response()->json(["result" => $arrayresult]);
    }

    public function downloadpdf(Request $request){
        $array = array("2","3","4");
        $download_pdf = new PDFMerger;
        $name = "";
        foreach ($array as $key => $value) {            
            $product = Products::find($value);
            $name .= $product->nama."_";
            if ( $product->pdf != "" ){
                $tmp_pdf = explode("/", $product->pdf );
                if ( count($tmp_pdf) > 3){
                    $pdf = $tmp_pdf[3];
                }
            }else{
                $pdf = "";
            }
            $public_path = public_path().'/storage/public/files/'.$value.'/'.$pdf;
            $download_pdf->addPDF($public_path, 'all');
        }
        $download_pdf->merge('download', $name."_".strtotime("now")."_.pdf");

    }

    public function testarray(Request $request){
        foreach ($request as $key => $value) {
            echo $value;
            echo "<br/>";
        }
    }

    public function share(Request $request){
        $product = Products::find($request->id);
        if ( $product->icon != "" ){
            $tmp_icon = explode("/", $product->icon );
            if ( count($tmp_icon) > 3 ){
                $icon = $tmp_icon[3];
            }
        }

        $image = "http://".$_SERVER['HTTP_HOST']."/storage/public/files/".$product->id.'/'.$icon;
        $nama = $product->nama;
        $description = $product->description;
        return view("product::index",compact("product","image","nama","description"));
    }
}
