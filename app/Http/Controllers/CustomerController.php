<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller{
    public function index(){
        $query = Customer::query();

        if (request('search')) {
            $query->search(request('search'));
        }

        $customers = $query->orderBy('last_name')->paginate(15);

        return view('customers.index', compact('customers'));
    }

    public function create(){
        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request){
        Customer::create($request->validated());
 
        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer){
        $customer->load('orders');

        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer){
        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer){
        $customer->update($request->validated());

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer){
        if ($customer->orders()->exists()) {
            return redirect()->route('customers.index')
                ->with('error', 'Cannot delete customer with existing orders.');
        }

        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}