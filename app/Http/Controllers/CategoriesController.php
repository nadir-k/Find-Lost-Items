<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoriesController extends Controller
{
    //Returns the page where the categories have to be added from first
    public function category(){
        return view('category.category');
    }

    //Handles the adding category to table category
    public function addCategory(Request $request){

        //validates that only 'pet', 'phone' or 'jewellery' was entered
        $this->validate($request, [
            'type' => 'in:pet,phone,jewellery',
        ]);

        //Creates a Category
        $category = new Category();

        //Gets input from the category type inputted from view 'category.category'
        $category->type = $request->input('type');

        //Checks if a category already exists e.g. 'pet' may be inputted in the database so it cannot be added again as a category
        if(Category::where("type", "=", $category->type)->first() == null){

            //sends category to database
            $category->save();

            //returns success if the category didn't exist as it is now added
            return redirect('/category')->with('success', 'Success! The category was added.');
        } else{

            //returns error if the category did exist as it has already been added
            return redirect('/category')->with('error', 'Sorry this category already exists');
        }
    }

}