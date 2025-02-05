<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    // Create: 新しいカテゴリーを保存
    public function store(Request $request)
    {
        try {
            Log::info('Creating category', ['name' => $request->category_name]);
            
            $category = Category::create([
                'category_name' => $request->category_name
            ]);

            return response()->json([
                'success' => true,
                'message' => 'カテゴリーが作成されました'
            ]);
        } catch (\Exception $e) {
            Log::error('Category creation failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Update: カテゴリー名を更新
    public function update(Request $request, $id)
    {
        try {
            Log::info('Updating category', ['id' => $id, 'name' => $request->category_name]);
            
            $category = Category::findOrFail($id);
            $category->category_name = $request->category_name;
            $category->save();

            return response()->json([
                'success' => true,
                'message' => 'カテゴリーが更新されました'
            ]);
        } catch (\Exception $e) {
            Log::error('Category update failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Delete: カテゴリーを削除
    public function destroy($id)
    {
        try {
            Log::info('Deleting category', ['id' => $id]);
            
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'カテゴリーが削除されました'
            ]);
        } catch (\Exception $e) {
            Log::error('Category deletion failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}