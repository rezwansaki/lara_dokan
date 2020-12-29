@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark">All Customers</h1>
                <p class="m-0 text-dark">The customer and the member are the same. Every customer has a member role.</p>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>Total Customers: {{count($total_customers)}}</h5>
            <span class="badge badge-pill badge-primary">{{date('d-M-Y h:i a', strtotime(now()))}}</span>
        </div>
        <!-- main card-body -->
        <div class="card-body">
            <!-- Table Start -->
            <table id="example2" class="table table-bordered table-hover text-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Cust_ID</th>
                        <th>Cust_Name</th>
                        <th>Cust_Contact</th>
                        <th>Cust_Email</th>
                        <th>Cust_Roles</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($all_customers as $customer)
                    <tr>
                        <td class="text-center">{{$customer->id}}</td>
                        <td><a href="{{$customer->id}}">{{$customer->name}}</a></td>
                        <td>{{$customer->contact}}</td>
                        <td>{{$customer->email}}</td>
                        <td>
                            @foreach($customer->getRoleNames() as $userrole)
                            @if($userrole == 'superadmin')
                            <span class="right badge badge-pill badge-danger">
                                {{ $userrole }}
                            </span>
                            @endif
                            @if($userrole == 'admin')
                            <span class="right badge badge-pill badge-warning">
                                {{ $userrole }}
                            </span>
                            @endif
                            @if($userrole == 'editor')
                            <span class="right badge badge-pill badge-primary">
                                {{ $userrole }}
                            </span>
                            @endif
                            @if($userrole == 'salesman')
                            <span class="right badge badge-pill badge-info">
                                {{ $userrole }}
                            </span>
                            @endif
                            @if($userrole == 'member')
                            <span class="right badge badge-pill badge-success">
                                {{ $userrole }}
                            </span>
                            @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="/user/customer/edit/{{$customer->id}}" class="btn btn-primary btn-xs btn-block">Edit</a>
                            <a href="/user/customer/delete/{{$customer->id}}" class="btn btn-danger btn-xs btn-block" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /Table End -->

            <!-- pagination -->
            <div class="col-md-12 mt-2 mb-4">
                {{ $all_customers->links() }}
            </div>
            <!-- /end of pagination -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection