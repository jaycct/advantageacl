@extends('advantageacl::layouts.admin-app')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>{{ __('Modules') }}
                            @if(PermissionHelper::__checkPermission('admin/acl-modules/add'))
                                <div class="m-portlet__head-tools float-right">
                                    <a class="btn btn-success" routerlink="add" routerlinkactive="active" style="margin-right:10px;" ng-reflect-router-link="add" ng-reflect-router-link-active="active" href="{{ route('admin.aclmodules.add') }}">
                                        <span><i class="la la-plus"></i><span>{{ __('acl-modules.add_module') }}</span></span>
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
                        <form class="form-inline" action="{{route('admin.aclmodules')}}" method="GET">

                            <div class="form-group mx-sm-3 mb-2">
                                <label for="moduleName" class="sr-only">{{ __('acl-modules.module_name') }}</label>
                                <input type="text" placeholder="{{ __('acl-modules.module_name') }}" id="moduleName" name="module_name" value="{{ old('module_name') }}" class="form-control" >
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <a href="{{ route('admin.aclmodules') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>
                        <div class="card-body">

                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th>{!! SortingHelper::instance()->sort('module_name',__('acl-modules.module_name'))  !!}</th>
                                    <th> {!! SortingHelper::instance()->sort('module_path',__('acl-modules.module_path'))  !!}</th>
                                    <th>{!! SortingHelper::instance()->sort('created_at',__('acl-modules.created_at'))  !!}</th>
                                    <th>{!! SortingHelper::instance()->sort('status',__('acl-modules.status'))  !!}</th>
                                    <th>Action</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($aclModules)
                                    @foreach($aclModules as $module)
                                        <tr>
                                            <td>{{ $module->module_name }}</td>
                                            <td>{{ $module->module_path }}</td>
                                            <td>{{ $module->created_at }}</td>
                                            <td>{{ $module->status }}</td>
                                            <td>
                                                @if(PermissionHelper::__checkPermission('admin/acl-modules/edit/{id}'))
                                                    <a href="{{ url('admin/acl-modules/edit/'.$module->id) }}" class="btn btn-info">{{ __('acl-modules.edit')}}</a>
                                                @endif
                                                @if(PermissionHelper::__checkPermission('admin/acl-modules/destroy/{id}'))
                                                    <a class="btn btn-danger" onclick="deletePopup('{{ url('admin/acl-modules/destroy/'.$module->id) }}')" href="javascript:void(0)" data-toggle="modal" data-target="#delete_data_modal">
                                                        {{ __('acl-modules.delete')}}
                                                    </a>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td></td>
                                        <td>{{ __('acl-modules.no_record_found')}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <div class="index-pagination">
                                {{ $aclModules->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('advantageacl::includes.partials.delete_popup',['message' => $message])

@endsection


@section('javascript')

@endsection

