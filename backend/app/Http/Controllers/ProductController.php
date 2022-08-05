<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getProduct($id)
    {
        $product = Product::where('id', $id)->where('user_id', Auth::id())->first();

        if ($product) {
            return response()->json([
                'product' => $product,
            ], 200);
        } else {
            return response()->json([
                'error' => 'Produto não encontrado',
            ], 404);
        }
    }

    public function getProducts(Request $request)
    {
        $products = Product::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(20);

        if ($products) {
            return response()->json([
                'products' => $products,
            ], 200);
        } else {
            return response()->json([
                'error' => 'Produto não encontrado',
            ], 404);
        }
    }

    public function createProduct(ProductRequest $request)
    {
        $dados = $request->only(['name', 'description', 'price']);

        $product = Product::create([
            'name' => ucwords($dados['name']),
            'description' => $dados['description'],
            'price' => $dados['price'],
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Produto criado com sucesso',
            'product' => $product,
        ], 201);
    }

    public function updateProduct(Request $request, $id)
    {
        $name = $request->only(['name']);
        $description = $request->only(['description']);
        $price = $request->only(['price']);

        $product = Product::where('id', $id)->where('user_id', Auth::id())->first();

        if ($product) {

            if ($name && $name['name']) {
                $request->validate([
                    'name' => 'required|string|min:3|max:255',
                ]);
                $product->name = ucwords($name['name']);
            }

            if ($description && $description['description']) {
                $request->validate([
                    'description' => 'required|string|min:3|max:255',
                ]);
                $product->description = $description['description'];
            }

            if ($price && $price['price']) {
                $request->validate([
                    'price' => 'required|numeric|min:1',
                ]);

                $product->price = $price['price'];
            }

            $product->save();

            return response()->json([
                'message' => 'Produto atualizado com sucesso',
                'product' => $product,
            ], 200);
        } else {
            return response()->json([
                'error' => 'Produto não encontrado',
            ], 404);
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::where('id', $id)->where('user_id', Auth::id())->first();

        if ($product) {
            $product->delete();

            return response()->json([
                'message' => 'Produto deletado com sucesso',
            ], 200);
        } else {
            return response()->json([
                'error' => 'Produto não encontrado',
            ], 404);
        }
    }
}
