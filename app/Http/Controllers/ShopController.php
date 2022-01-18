<?php

namespace App\Http\Controllers;

use App\Models\Prodcut;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Exception;
use Illuminate\Pagination\Paginator;

class ShopController extends Controller
{

    public function index()
    {
        Paginator::useBootstrap();
        $categories = Category::all();
        $brands = Brand::all();
        $prodcuts = Prodcut::paginate(9);
        $top_prodcuts = Prodcut::topProdcuts();
        return view('shop.index', ['categories' => $categories, 'prodcuts' => $prodcuts, 'brands' => $brands, 'topProdcuts' => $top_prodcuts]);
    }

    public function filter(Request $request)
    {
        try {
            if ($request->ajax()) {
                if ($request->category_id) {
                    $prodcuts = Prodcut::where('category_id', $request->category_id)->get();
                } else {
                    $prodcuts = Prodcut::where('brand_id', $request->brand_id)->get();
                }

                $html = view('render.prodcut-filter', ['prodcuts' => $prodcuts])->render();

                if (request()->ajax()) {
                    return response()->json([
                        'html' => $html
                    ]);
                }
            }
        } catch (Exception $e) {
            return $e;
            return response()->json([
                'err' => 'an error occurred',
            ]);
        }
    }
}
