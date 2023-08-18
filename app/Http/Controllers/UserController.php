<?php

namespace App\Http\Controllers;
use App\Models\Users;
use DB;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getDashboard(){
        $Dashboard = DB::table('categories')->join('expenses', 'categories.category', '=', 'expenses.expense')->get(['categories.*', 'expenses.amount']);

        return response()
        ->json([
          'dashboard' => $Dashboard,
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'Success',
        ]);
    }

    public function getUsers(){
        $users = Users::all();

        return response()
        ->json([
          'users' => $users,
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'Success',
        ]);
    }

    public function addUser(Request $request){
         Users::insert([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => 'password',
            'created_at' => $request->date,
        ]);  

        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'User Add Success',
          'message' => 'User Add Success',
        ]);

    }

    public function editUser(Request $request){

         $user=Users::where('id',$request->index)
         ->update(['name' => $request->name, 'email' => $request->email, 'role' => $request->role, 'created_at' => $request->date]);
         
        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'User Update Success',
        ]);

    }

    public function deleteUser(Request $request){
         $user=Users::where('email',$request->email)->delete();

        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'User Delete Success',
        ]);

    }

    public function getRoles(){
        $Roles = DB::connection('mysql')
                ->table('roles')
                ->select('*')
                ->get();

        return response()
        ->json([
          'Roles' => $Roles,
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'Success',
        ]);
    }

    public function addRole(Request $request){
        DB::connection('mysql')
                ->table('roles')
                ->insert([
            'role' => $request->role,
            'description' => $request->description,
            'created_at' => $request->date,
            ]);  

        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'Role Add Success',
          'message' => 'Role Add Success',
        ]);

    }

    public function editRole(Request $request){
        DB::connection('mysql')
                ->table('roles')
                ->where('id',$request->index)
                ->update(['role' => $request->role,'description' => $request->description, 'created_at' => $request->date]);
         
        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'Role Update Success',
        ]);

    }

    public function deleteRole(Request $request){
         $Role=DB::connection('mysql')
                ->table('roles')
                ->where('role',$request->role)->delete();

        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'Role Delete Success',
        ]);

    }

    //

    public function getExpenses(){
        $Expenses = DB::connection('mysql')
                ->table('expenses')
                ->select('*')
                ->get();

        return response()
        ->json([
          'Expenses' => $Expenses,
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'Success',
        ]);
    }

    public function addExpense(Request $request){
        DB::connection('mysql')
                ->table('expenses')
                ->insert([
            'expense' => $request->expense,
            'amount' => $request->amount,
            'created_at' => $request->date,
            ]);  

        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'Expense Add Success',
          'message' => 'Expense Add Success',
        ]);

    }

    public function editExpense(Request $request){
        DB::connection('mysql')
                ->table('expenses')
                ->where('id',$request->index)
                ->update(['expense' => $request->expense,'amount' => $request->amount, 'created_at' => $request->date]);
         
        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'Expense Update Success',
        ]);

    }

    public function deleteExpense(Request $request){
         $Expense=DB::connection('mysql')
                ->table('expenses')
                ->where('expense',$request->expense)->delete();

        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'Expense Delete Success',
        ]);

    }


    //

    public function getCategories(){
        $Categories = DB::connection('mysql')
                ->table('categories')
                ->select('*')
                ->get();

        return response()
        ->json([
          'categories' => $Categories,
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'Success',
        ]);
    }

    public function addCategory(Request $request){
        DB::connection('mysql')
                ->table('categories')
                ->insert([
            'category' => $request->category,
            'description' => $request->description,
            'created_at' => $request->date,
            ]);  

        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'category Add Success',
          'message' => 'category Add Success',
        ]);

    }

    public function editCategory(Request $request){
        DB::connection('mysql')
                ->table('categories')
                ->where('id',$request->index)
                ->update(['category' => $request->category,'description' => $request->description, 'created_at' => $request->date]);
         
        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'category Update Success',
        ]);

    }

    public function deleteCategory(Request $request){
         $category=DB::connection('mysql')
                ->table('categories')
                ->where('category',$request->category)->delete();

        return response()
        ->json([
          'statusCode' => 200,
          'result' => 'Success',
          'message' => 'category Delete Success',
        ]);

    }

 }
