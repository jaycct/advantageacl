@extends('advantageacl::layouts.admin-app')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>{{ __('acl-roles.roles') }}

                            @if(PermissionHelper::__checkPermission('admin/roles/add'))
                                <div class="m-portlet__head-tools float-right">
                                    <a class="btn btn-success" routerlink="add" routerlinkactive="active" style="margin-right:10px;" ng-reflect-router-link="add" ng-reflect-router-link-active="active" href="{{ route('admin.aclrole.add') }}">
                                        <span><i class="cil-user-plus"></i><span>{{ __('acl-roles.add_role') }}</span></span>
                                    </a>
                                </div>
                            @endif

                        </div>

                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-'.$msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session('alert-'.$msg) }}</p>
                                @endif
                            @endforeach
                        </div>
                        <br>
                        <form class="form-inline" action="{{route('admin.aclrole.list')}}" method="GET">

                            <div class="form-group mx-sm-3 mb-2">
                                <label for="Name" class="sr-only">{{ __('acl-roles.role_name') }}</label>
                                <input type="text" id="name" name="name" value="{{ Request::get('name') }}" placeholder="{{ __('acl-roles.role_name') }}" class="form-control" >
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <a href="{{ route('admin.aclrole.list') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>
                        <div class="card-body">

                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th>{!! SortingHelper::instance()->sort('role_name',__('acl-roles.role_name'))  !!}</th>
                                    <th>{!! SortingHelper::instance()->sort('created_at',__('acl-roles.created_at'))  !!}</th>
                                    <th>{!! SortingHelper::instance()->sort('status',__('acl-roles.status'))  !!}</th>
                                    <th>Action</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($aclRoles)
                                    @foreach($aclRoles as $role)
                                        <tr>
                                            <td>{{ $role->role_name }}</td>
                                            <td>{{ $role->created_at }}</td>
                                            <td>{{ $role->status }}</td>
                                            <td>
                                                {{--@if(PermissionHelper::__checkPermission('admin/roles/edit/{id}'))--}}
                                                <a href="{{ url('admin/roles/edit/'.$role->id) }}" class="btn btn-info">{{ __('acl-roles.edit')}}</a>
                                                {{--@endif--}}
                                                @if(PermissionHelper::__checkPermission('admin/roles/destroy/{id}'))
                                                    <a class="btn btn-danger" onclick="deletePopup('{{ url('admin/roles/destroy/'.$role->id) }}')" href="javascript:void(0)" data-toggle="modal" data-target="#delete_data_modal">
                                                        {{ __('acl-roles.delete')}}
                                                    </a>
                                                @endif


                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td></td>
                                        <td>{{ __('acl-roles.no_record_found')}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <div class="index-pagination">
                                {{ $aclRoles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.includes.partials.delete_popup',['message' => $message])

@endsection


@section('javascript')

@endsection

