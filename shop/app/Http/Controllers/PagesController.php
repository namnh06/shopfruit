<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use App\NewsModel;
use App\ProductModel;
use App\CategoryNewsModel;
use Illuminate\Http\Request;

class PagesController extends Controller
{

	function __construct(){
		$products = ProductModel::all();
		view()->share('products',$products);
		$categories = CategoryModel::orderBy('name_category')->get();
		view()->share('categories',$categories);
		$categoriesNews = CategoryNewsModel::all();
		view()->share('categoriesNews',$categoriesNews);
	}
    //template
	function template(){

		return view('front.template.template-front');
	}

	//home
	function index(){
		$promotionProducts = ProductModel::orderByDesc('percent_discount_product')->take(5)->get();
		$bestSellerProducts = ProductModel::orderByDesc('name_en_product')->take(5)->get();
		$comingProducts = ProductModel::orderByDesc('created_at')->take(5)->get();

		return view('front.index-front',['promotionProducts'=>$promotionProducts,'bestSellerProducts'=>$bestSellerProducts,'comingProducts'=>$comingProducts]);
	}

	//product detail
	function productDetail($id){
		$product = ProductModel::find($id);
		$similarProducts = ProductModel::where('id_category_in_product',$product->id_category_in_product)->take(3)->get();
		$bestSellerProducts = ProductModel::orderByDesc('name_en_product')->take(3)->get();
		return view('front.product-detail',['product'=>$product,'similarProducts'=>$similarProducts,'bestSellerProducts'=>$bestSellerProducts]);
	}

	//category
	function category($id){
		$categoryDetail = CategoryModel::find($id);
		$productsCategory = ProductModel::where('id_category_in_product',$id)->paginate(3);
		return view('front.category-front',['categoryDetail'=>$categoryDetail,'productsCategory'=>$productsCategory]);
	}

	//category news
	function categoryNews($id){
		$categoryNews = CategoryNewsModel::find($id);
		$allNews = NewsModel::where('id_category_in_news',$id)->paginate(3);
		return view('front.category-news-front',['categoryNews'=>$categoryNews,'allNews'=>$allNews]);
	}

	//news
	function news($id){
		$news = NewsModel::find($id);
		return view('front.news-front',['news'=>$news]);
	}

	//policy
	function policy()
	{
		return view('front.policy');
	}
		//about us
	function about()
	{
		return view('front.about');
	}
		//contact
	function contact()
	{
		return view('front.contact');
	}
}
