@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Product
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Product Form -->
                    <form action="{{ url('product') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Product Name -->
                        <div class="form-group">
                            <label for="product-name" class="col-sm-3 control-label">Product</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="product-name" class="form-control" value="{{ old('product') }}">
                            </div>
                        </div>

                        <!-- Product Quantity -->
                        <div class="form-group">
                            <label for="product-quantity" class="col-sm-3 control-label">Quantity in stock</label>

                            <div class="col-sm-6">
                                <input type="text" name="quantity" id="product-quantity" class="form-control" value="{{ old('product') }}">
                            </div>
                        </div>

                        <!-- Product Price -->
                        <div class="form-group">
                            <label for="product-price" class="col-sm-3 control-label">Price per item</label>

                            <div class="col-sm-6">
                                <input type="text" name="price" id="product-price" class="form-control" value="{{ old('product') }}">
                            </div>
                        </div>

                        <!-- Add Product Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Products -->
            @if (count($products) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Products
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped product-table">
                            <thead>
                                <th>Product</th>
                                <th>Quantity in stock</th>
                                <th>Price per item</th>
                                <th>Date</th>
                                <th>Total value number</th>
                                <th>Download</th>
                                
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="table-text"><div>{{ $product->name }}</div></td>
                                        <td class="table-text"><div>{{ $product->quantity }}</div></td>
                                        <td class="table-text"><div>{{ $product->price }}</div></td>
                                        <td class="table-text"><div>{{ $product->created_at }}</div></td>
                                        <td class="table-text"><div>{{ $product->price * $product->quantity }}</div></td>
                                        <td class="table-text"><div><a href="{{url('product/' . $product->id)}}">{{ $product->name }}.json</a></div></td>

                                        <!-- Product Delete Button -->
                                        <td>
                                            <form action="{{url('product/' . $product->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-product-{{ $product->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection