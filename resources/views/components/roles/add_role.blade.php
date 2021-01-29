@extends('advantageacl::layouts.admin-app')
@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{ __('acl-roles.add_role') }} </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-'.$msg))
                                        <p class="alert alert-{{ $msg }}">{{ Session('alert-'.$msg) }}</p>
                                    @endif
                                @endforeach
                            </div>
                            <form method="POST" action="{{ url('/admin/roles/store')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="roleName" class="col-sm-2 col-form-label">{{ __('acl-roles.role_name') }}*</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="{{ __('acl-roles.role_name') }}" id="roleName" name="role_name" value="{{old('role_name')}}" class="form-control{{ $errors->has('role_name') ? ' is-invalid' : '' }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="roleDescription" class="col-sm-2 col-form-label">{{ __('acl-roles.role_description') }}</label>
                                    <div class="col-sm-10">
                                        <textarea id="roleDescription" name="role_description" class="form-control{{ $errors->has('role_description') ? ' is-invalid' : '' }}"  type="text" placeholder="{{ __('acl-roles.role_description') }}">{{old('role_description')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <label for="status" class="col-sm-2 col-form-label">{{ __('acl-modules.status') }}</label>
                                        <input type="checkbox" @if(old('status')=='Active') checked="checked" @endif name="status">
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <h3>Permissions</h3>
                                            <ul id="tree1">
                                                @foreach($aclModules as $module)
                                                    <li>
                                                        <input type="checkbox" id="{{$module['module_name']}}" value="{{$module['id']}}" class="main-checkbox">
                                                        {{$module['module_name']}}

                                                    @if(count($module->modules_route))
                                                            <ul>
                                                                @foreach($module->modules_route as $moduleRoute)
                                                                    <li>
                                                                        @if(substr_count($moduleRoute['route'], "/") == 1 || strpos($moduleRoute['route'], "add") !== false || strpos($moduleRoute['route'], "edit") !== false || strpos($moduleRoute['route'], "destroy") !== false)
                                                                            <input type="checkbox" name="permission[]" id="{{$moduleRoute['id']}}" value="{{$moduleRoute['id']}}">
                                                                            @if(strpos($moduleRoute['route'], "add"))
                                                                                <label for="{{$moduleRoute['id']}}">Add {{ substr($module['module_name'], 0, -1)}}</label>
                                                                            @elseif(strpos($moduleRoute['route'], "edit"))
                                                                                <label for="{{$moduleRoute['id']}}">Edit {{ substr($module['module_name'], 0, -1)}}</label>
                                                                            @elseif(strpos($moduleRoute['route'], "destroy"))
                                                                                <label for="{{$moduleRoute['id']}}">Delete {{ substr($module['module_name'], 0, -1)}}</label>
                                                                            @else
                                                                                <label for="{{$moduleRoute['id']}}">List {{ substr($module['module_name'], 0, -1)}}</label>
                                                                            @endif

                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button class="btn btn-success mb-2" type="submit">{{ __('Save') }}</button>
                                        <a href="{{ route('admin.aclrole.list') }}" class="btn btn-secondary mb-2">{{ __('Return') }}</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

