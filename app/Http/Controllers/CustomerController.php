<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(10);

        // Lấy chỉ số của bản ghi đầu tiên (trong trường hợp bạn cần hiển thị)
        $firstItem = $customers->firstItem();
    
        return view('customers.index', compact('customers'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $validated = $request->validate([
        'email' => 'required|email|unique:customers,email',
        'password' => 'required|string',
        'status' => 'nullable|string',
        'account_type' => 'nullable|string',
        'last_login' => 'required|date',
    ]);

    $validated['password'] = bcrypt($request->password);


    Customer::create([
        'email' => $validated['email'],
        'password' => $validated['password'],
        'status' => $validated['status'],
        'account_type' => $validated['account_type'],
        'last_login' => $validated['last_login'],
    ]);


    return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, string $id)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'email' => 'required|email|unique:customers,email,' . $id,  // Exclude current customer from unique check
        'password' => 'nullable|string|min:8',  // Allow password to be optional
        'status' => 'nullable|string',
        'account_type' => 'nullable|string',
        'last_login' => 'required|date',
    ]);

    // Find the customer by ID
    $customer = Customer::findOrFail($id);

    // Update the password if provided
    if ($request->filled('password')) {
        $validatedData['password'] = bcrypt($request->password);  // Hash the new password
    } else {
        // If no new password, remove it from the validated data
        unset($validatedData['password']);
    }

    // Update the customer with the validated data
    $customer->update($validatedData);

    // Redirect back to the customer show page with success message
    return redirect()->route('customers.index', $id)->with('success', 'Customer updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        Customer::destroy($id);
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }
}
